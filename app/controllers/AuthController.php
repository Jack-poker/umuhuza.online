<?php

class AuthController {
    public function register($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$pdo) {
                flash('error', 'Database connection unavailable. Please ensure MySQL server is running.');
                header('Location: ?route=register');
                exit;
            }
            // Verify CSRF token
            if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                flash('error', 'Security token invalid. Please try again.');
                header('Location: ?route=register');
                exit;
            }
            
            $data = [
                'full_name' => sanitize($_POST['full_name'] ?? ''),
                'username' => sanitize($_POST['username'] ?? ''),
                'phone' => sanitize($_POST['phone'] ?? ''),
                'whatsapp' => sanitize($_POST['whatsapp'] ?? ''),
                'email' => sanitize($_POST['email'] ?? ''),
                'province' => sanitize($_POST['province'] ?? ''),
                'district' => sanitize($_POST['district'] ?? ''),
                'sector' => sanitize($_POST['sector'] ?? ''),
                'cell' => sanitize($_POST['cell'] ?? ''),
                'village' => sanitize($_POST['village'] ?? ''),
                'password' => $_POST['password'] ?? '',
                'confirm' => $_POST['confirm_password'] ?? '',
                'role' => 'provider',
                'account_type' => sanitize($_POST['account_type'] ?? 'agent'),
                'service_category' => sanitize($_POST['service_category'] ?? null),
                'profile_image' => null,
                'service_areas' => preg_split('/[;,]+/', sanitize($_POST['service_areas'] ?? ''), -1, PREG_SPLIT_NO_EMPTY),
            ];
            
            // Validate password length
            if (strlen($data['password']) < 8) {
                flash('error', 'Password must be at least 8 characters long.');
                header('Location: ?route=register');
                exit;
            }
            
            // Validate username length
            if (strlen($data['username']) < 3) {
                flash('error', 'Username must be at least 3 characters long.');
                header('Location: ?route=register');
                exit;
            }
            if ($data['password'] !== $data['confirm']) {
                flash('error', 'Passwords do not match.');
                header('Location: ?route=register');
                exit;
            }
            
            // Validate email format
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                flash('error', 'Please enter a valid email address.');
                header('Location: ?route=register');
                exit;
            }
            
            // Validate phone format (basic check for Rwandan format)
            if (!preg_match('/^(\+?250|0)?[0-9]{9,12}$/', $data['phone'])) {
                flash('error', 'Please enter a valid phone number.');
                header('Location: ?route=register');
                exit;
            }
            
            if (isset($_FILES['profile_image']) && ($_FILES['profile_image']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
                $uploadResult = handleUploadDetailed($_FILES['profile_image']);
                if (!$uploadResult['success']) {
                    flash('error', $uploadResult['error']);
                    header('Location: ?route=register');
                    exit;
                }
                $data['profile_image'] = $uploadResult['path'];
            }
            if (User::findByEmail($pdo, $data['email'])) {
                flash('error', 'Email already exists.');
                header('Location: ?route=register');
                exit;
            }
            $userId = User::create($pdo, [
                'full_name' => $data['full_name'],
                'username' => $data['username'],
                'phone' => $data['phone'],
                'whatsapp' => $data['whatsapp'],
                'email' => $data['email'],
                'password_hash' => hashPassword($data['password']),
                'role' => $data['role'],
                'account_type' => $data['account_type'],
                'service_category' => $data['service_category'],
                'province' => $data['province'],
                'district' => $data['district'],
                'sector' => $data['sector'],
                'cell' => $data['cell'],
                'village' => $data['village'],
                'profile_image' => $data['profile_image'],
            ]);
            if ($userId) {
                ServiceArea::saveMany($pdo, $userId, $data['service_areas'] ?? []);
            }
            flash('success', 'Registration successful. Please login.');
            header('Location: ?route=login');
            exit;
        }
    }

    public function login($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$pdo) {
                flash('error', 'Database connection unavailable. Please ensure MySQL server is running.');
                header('Location: ?route=login');
                exit;
            }
            
            // Get client IP
            $ip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
            
            // Check if IP is permanently locked in database
            $stmt = $pdo->prepare("SELECT failed_count, locked_until FROM login_attempts WHERE ip_address = ?");
            $stmt->execute([$ip]);
            $attemptRecord = $stmt->fetch();
            
            if ($attemptRecord && $attemptRecord['locked_until'] && strtotime($attemptRecord['locked_until']) > time()) {
                flash('error', 'Your IP address has been blocked due to multiple failed login attempts. Try again tomorrow.');
                header('Location: ?route=login');
                exit;
            }

            // Verify CSRF token
            if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                flash('error', 'Security token invalid. Please try again.');
                header('Location: ?route=login');
                exit;
            }
            
            $identifier = sanitize($_POST['identifier'] ?? '');
            $password = $_POST['password'] ?? '';
            $user = User::findByEmail($pdo, $identifier);
            if (!$user) {
                $user = User::findByPhone($pdo, $identifier);
            }
            if (!$user) {
                $user = User::findByUsername($pdo, $identifier);
            }
            
            if ($user && verifyPassword($password, $user['password_hash'])) {
                // Login successful -> clear failed attempts
                $pdo->prepare("DELETE FROM login_attempts WHERE ip_address = ?")->execute([$ip]);
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                flash('success', 'Welcome back.');
                if ($user['role'] === 'admin') {
                    header('Location: ?route=admin-dashboard');
                } else {
                    header('Location: ?route=provider-dashboard');
                }
                exit;
            }
            
            // Login failed -> increment tracking
            if ($attemptRecord) {
                $failedCount = $attemptRecord['failed_count'] + 1;
                if ($failedCount >= 5) {
                    // Lock out for 24 hours
                    $pdo->prepare("UPDATE login_attempts SET failed_count = ?, locked_until = DATE_ADD(NOW(), INTERVAL 24 HOUR) WHERE ip_address = ?")->execute([$failedCount, $ip]);
                    // Notify Admin (User ID 1)
                    require_once __DIR__ . '/../models/Notification.php';
                    NotificationModel::create($pdo, 1, "SECURITY ALERT: IP address {$ip} has been blocked for 24 hours due to 5 consecutive failed login attempts.");
                } else {
                    $pdo->prepare("UPDATE login_attempts SET failed_count = ? WHERE ip_address = ?")->execute([$failedCount, $ip]);
                }
            } else {
                $pdo->prepare("INSERT INTO login_attempts (ip_address, failed_count) VALUES (?, 1)")->execute([$ip]);
            }

            flash('error', 'Invalid credentials.');
            header('Location: ?route=login');
            exit;
        }
    }

    public function forgotPassword($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifier = sanitize($_POST['identifier'] ?? '');
            if (!empty($identifier)) {
                flash('success', 'If an account exists for ' . e($identifier) . ', reset instructions have been sent.');
            } else {
                flash('error', 'Please enter your phone number or email.');
            }
            header('Location: ?route=forgot-password');
            exit;
        }
    }
}
