<?php

class User {
    public static function providers($pdo) {
        if (!$pdo) return [];
        $stmt = $pdo->query('SELECT * FROM users WHERE role = "provider" AND (status = "active" OR status IS NULL) AND LOWER(full_name) NOT LIKE "%test%" AND LOWER(full_name) NOT LIKE "%qa%" AND LOWER(full_name) NOT LIKE "%crud%" AND LOWER(username) NOT LIKE "%test%" AND LOWER(username) NOT LIKE "%crud%" ORDER BY created_at DESC LIMIT 12');
        return $stmt ? $stmt->fetchAll() : [];
    }

    public static function create($pdo, $data) {
        if (!$pdo) return false;
        $stmt = $pdo->prepare('INSERT INTO users (full_name, username, phone, whatsapp, email, password_hash, role, account_type, service_category, province, district, sector, cell, village, profile_image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "active")');
        $ok = $stmt->execute([
            $data['full_name'],
            $data['username'],
            $data['phone'],
            $data['whatsapp'],
            $data['email'],
            $data['password_hash'],
            $data['role'],
            $data['account_type'] ?? 'agent',
            $data['service_category'] ?? null,
            $data['province'] ?? null,
            $data['district'] ?? null,
            $data['sector'] ?? null,
            $data['cell'] ?? null,
            $data['village'] ?? null,
            $data['profile_image'] ?? null,
        ]);
        return $ok ? (int) $pdo->lastInsertId() : false;
    }

    public static function findByEmail($pdo, $email) {
        if (!$pdo) return false;
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public static function findByPhone($pdo, $phone) {
        if (!$pdo) return false;
        $stmt = $pdo->prepare('SELECT * FROM users WHERE phone = ?');
        $stmt->execute([$phone]);
        return $stmt->fetch();
    }

    public static function findByUsername($pdo, $username) {
        if (!$pdo) return false;
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public static function findById($pdo, $id) {
        if (!$pdo) return false;
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function updateStatus($pdo, $id, $status) {
        if (!$pdo) return false;
        $stmt = $pdo->prepare('UPDATE users SET status = ? WHERE id = ?');
        return $stmt->execute([$status, (int) $id]);
    }

    public static function updateRole($pdo, $id, $role) {
        if (!$pdo) return false;
        $stmt = $pdo->prepare('UPDATE users SET role = ? WHERE id = ?');
        return $stmt->execute([$role, (int) $id]);
    }

    public static function updateProfile($pdo, $id, $data) {
        if (!$pdo) return false;
        $fields = [];
        $params = [];

        if (isset($data['full_name'])) { $fields[] = 'full_name = ?'; $params[] = trim($data['full_name']); }
        if (isset($data['username'])) { $fields[] = 'username = ?'; $params[] = trim($data['username']); }
        if (isset($data['phone'])) { $fields[] = 'phone = ?'; $params[] = trim($data['phone']); }
        if (isset($data['whatsapp'])) { $fields[] = 'whatsapp = ?'; $params[] = trim($data['whatsapp']); }
        if (isset($data['email'])) { $fields[] = 'email = ?'; $params[] = trim($data['email']); }
        if (isset($data['account_type'])) { $fields[] = 'account_type = ?'; $params[] = trim($data['account_type']); }
        if (isset($data['service_category'])) { $fields[] = 'service_category = ?'; $params[] = trim($data['service_category']); }
        if (isset($data['province'])) { $fields[] = 'province = ?'; $params[] = trim($data['province']); }
        if (isset($data['district'])) { $fields[] = 'district = ?'; $params[] = trim($data['district']); }
        if (isset($data['sector'])) { $fields[] = 'sector = ?'; $params[] = trim($data['sector']); }
        if (!empty($data['profile_image'])) { $fields[] = 'profile_image = ?'; $params[] = trim($data['profile_image']); }
        if (!empty($data['password_hash'])) { $fields[] = 'password_hash = ?'; $params[] = $data['password_hash']; }

        if (empty($fields)) {
            return true;
        }

        $params[] = (int)$id;
        $sql = 'UPDATE users SET ' . implode(', ', $fields) . ' WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
