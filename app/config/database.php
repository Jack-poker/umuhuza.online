<?php

/**
 * Database configuration — production
 * Self-contained: loads .env, auto-detects PDO drivers, handles port.
 */

// ---------- 1. Load .env (next to this file) ----------
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') continue;
        if (strpos($line, '=') === false) continue;
        [$k, $v] = explode('=', $line, 2);
        $k = trim($k);
        $v = trim($v, " \t\n\r\0\x0B\"'");
        if (getenv($k) === false) {
            putenv("$k=$v");
            $_ENV[$k] = $v;
        }
    }
}

// ---------- 2. Read config ----------
$DB_HOST = getenv('DB_HOST') ?: '167.86.94.189';
$DB_PORT = getenv('DB_PORT') ?: '3451';
$DB_NAME = getenv('DB_NAME') ?: 'default';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASS = getenv('DB_PASS') ?: 'mW8cdTXa8TXU1uKe1NPoFq82NMmz0blR44hfWjxZMGGXhMNUtKq9c0KzkVnF31a9';

// ---------- 3. Check PDO MySQL driver BEFORE trying to connect ----------
$pdo = null;
$pdoError = null;

if (!extension_loaded('pdo')) {
    $pdoError = "PHP extension 'pdo' is not loaded.";
} elseif (!in_array('mysql', PDO::getAvailableDrivers(), true)) {
    $pdoError = "PDO MySQL driver is missing. Install 'pdo_mysql' in the PHP runtime. "
              . "Available drivers: " . implode(', ', PDO::getAvailableDrivers());
}

if ($pdoError !== null) {
    error_log("Database unavailable: " . $pdoError);
    // $pdo stays null; the app must handle a null $pdo gracefully.
} else {
    // ---------- 4. Connect ----------
    $dsn      = "mysql:host={$DB_HOST};port={$DB_PORT};dbname={$DB_NAME};charset=utf8mb4";
    $dsnTemp  = "mysql:host={$DB_HOST};port={$DB_PORT};charset=utf8mb4";

    $pdoOptions = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT            => 5,
    ];

    try {
        $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $pdoOptions);
    } catch (PDOException $e) {
        error_log("Primary DB connect failed: " . $e->getMessage());

        try {
            // Try without dbname, then create DB + load schema
            $pdo_temp = new PDO($dsnTemp, $DB_USER, $DB_PASS, $pdoOptions);

            $schema_path = __DIR__ . '/../../database/schema.sql';
            if (file_exists($schema_path)) {
                $schema = file_get_contents($schema_path);
                $statements = array_filter(
                    array_map('trim', explode(';', $schema)),
                    fn($s) => $s !== '' && substr($s, 0, 2) !== '--'
                );
                foreach ($statements as $statement) {
                    try {
                        $pdo_temp->exec($statement . ';');
                    } catch (PDOException $stmtError) {
                        error_log("Schema stmt error: " . $stmtError->getMessage()
                                . " | " . substr($statement, 0, 100));
                    }
                }
            }

            $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $pdoOptions);
        } catch (PDOException $e2) {
            error_log("Database initialization failed: " . $e2->getMessage());
            $pdo = null;
        }
    }
}

// ---------- 5. Auto-migration (only if we have a connection) ----------
$migrationMarker = __DIR__ . '/../../public/assets/.migrated';

if ($pdo && !file_exists($migrationMarker)) {
    try {
        $stmt = $pdo->query("SHOW TABLES");
        $existingTables = array_column($stmt->fetchAll(PDO::FETCH_NUM), 0);

        $requiredTables = [
            'plans', 'users', 'user_plans', 'categories', 'provinces',
            'districts', 'sectors', 'cells', 'service_areas', 'listings',
            'listing_images', 'requests', 'request_matches', 'listing_views',
            'listing_contacts', 'payments', 'notifications', 'verification_requests',
            'admin_logs'
        ];

        $hasMissingTable = false;
        foreach ($requiredTables as $reqTable) {
            if (!in_array($reqTable, $existingTables, true)) {
                $hasMissingTable = true;
                break;
            }
        }

        if ($hasMissingTable) {
            $schema_path = __DIR__ . '/../../database/schema.sql';
            if (file_exists($schema_path)) {
                $schema = file_get_contents($schema_path);
                $statements = array_filter(
                    array_map('trim', explode(';', $schema)),
                    fn($s) => $s !== '' && substr($s, 0, 2) !== '--'
                );
                foreach ($statements as $statement) {
                    try {
                        $pdo->exec($statement . ';');
                    } catch (PDOException $ignored) {
                        // Duplicate / non-critical during creation
                    }
                }
            }
        }

        // --- Column migrations ---
        $stmt = $pdo->query("DESCRIBE payments");
        $existingPaymentsCols = array_column($stmt->fetchAll(), 'Field');
        $expectedPaymentsCols = [
            'transaction_id' => "ALTER TABLE payments ADD COLUMN transaction_id VARCHAR(100) NULL AFTER plan_id",
            'sender_name'    => "ALTER TABLE payments ADD COLUMN sender_name VARCHAR(120) NULL AFTER transaction_id",
            'sender_phone'   => "ALTER TABLE payments ADD COLUMN sender_phone VARCHAR(30) NULL AFTER sender_name",
            'method'         => "ALTER TABLE payments ADD COLUMN method VARCHAR(50) NOT NULL AFTER status",
            'approved_at'    => "ALTER TABLE payments ADD COLUMN approved_at TIMESTAMP NULL AFTER created_at",
        ];
        foreach ($expectedPaymentsCols as $col => $sql) {
            if (!in_array($col, $existingPaymentsCols, true)) {
                $pdo->exec($sql);
            }
        }

        $stmt = $pdo->query("DESCRIBE user_plans");
        $existingUserPlansCols = array_column($stmt->fetchAll(), 'Field');
        if (!in_array('status', $existingUserPlansCols, true)) {
            $pdo->exec("ALTER TABLE user_plans ADD COLUMN status VARCHAR(30) NOT NULL DEFAULT 'active'");
        }

        $stmt = $pdo->query("DESCRIBE users");
        $existingUsersCols = array_column($stmt->fetchAll(), 'Field');
        if (!in_array('service_category', $existingUsersCols, true)) {
            $pdo->exec("ALTER TABLE users ADD COLUMN service_category VARCHAR(100) NULL AFTER account_type");
        }

        $stmt = $pdo->query("DESCRIBE requests");
        $existingRequestsCols = array_column($stmt->fetchAll(), 'Field');
        if (!in_array('cell', $existingRequestsCols, true)) {
            $pdo->exec("ALTER TABLE requests ADD COLUMN cell VARCHAR(100) NULL AFTER sector");
        }

        $stmt = $pdo->query("DESCRIBE request_matches");
        $existingMatchesCols = array_column($stmt->fetchAll(), 'Field');
        if (!in_array('status', $existingMatchesCols, true)) {
            $pdo->exec("ALTER TABLE request_matches ADD COLUMN status VARCHAR(30) NOT NULL DEFAULT 'delivered'");
        }
        if (!in_array('delivered_at', $existingMatchesCols, true)) {
            $pdo->exec("ALTER TABLE request_matches ADD COLUMN delivered_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP");
        }

        $stmt = $pdo->query("DESCRIBE notifications");
        $existingNotifCols = array_column($stmt->fetchAll(), 'Field');
        if (!in_array('request_id', $existingNotifCols, true)) {
            $pdo->exec("ALTER TABLE notifications ADD COLUMN request_id INT NULL AFTER user_id");
        }
        if (!in_array('is_archived', $existingNotifCols, true)) {
            $pdo->exec("ALTER TABLE notifications ADD COLUMN is_archived TINYINT(1) NOT NULL DEFAULT 0 AFTER is_read");
        }

        // --- Generate notification WAV files ---
        $audioDir = __DIR__ . '/../../public/assets/audio';
        if (!is_dir($audioDir)) {
            @mkdir($audioDir, 0755, true);
        }
        $sounds = ['request.wav' => 587.33, 'success.wav' => 880.00, 'listing.wav' => 698.46];
        foreach ($sounds as $filename => $freq) {
            $soundPath = $audioDir . '/' . $filename;
            if (!file_exists($soundPath)) {
                $sampleRate  = 11025;
                $duration    = 0.8;
                $numSamples  = $sampleRate * $duration;
                $data = '';
                for ($i = 0; $i < $numSamples; $i++) {
                    $t = $i / $sampleRate;
                    $amplitude = exp(-5 * $t);
                    $val = 128 + 127 * $amplitude * sin(2 * M_PI * $freq * $t);
                    $data .= chr((int)round($val));
                }
                $header = 'RIFF' . pack('V', 36 + strlen($data)) . 'WAVEfmt '
                        . pack('V', 16) . pack('v', 1) . pack('v', 1)
                        . pack('V', $sampleRate) . pack('V', $sampleRate)
                        . pack('v', 1) . pack('v', 8)
                        . 'data' . pack('V', strlen($data));
                @file_put_contents($soundPath, $header . $data);
            }
        }

        // --- Cleanup test accounts + set plan prices ---
        try {
            $pdo->exec("DELETE FROM users WHERE LOWER(full_name) LIKE '%test%' OR LOWER(full_name) LIKE '%qa%' OR LOWER(username) LIKE '%test%' OR LOWER(full_name) LIKE '%crud%' OR LOWER(username) LIKE '%crud%'");
            $pdo->exec("UPDATE plans SET price = 3000 WHERE id = 2 OR LOWER(name) LIKE '%premium%'");
            $pdo->exec("UPDATE plans SET price = 5000 WHERE id = 3 OR LOWER(name) LIKE '%super%'");
        } catch (PDOException $e) {
            // ignore
        }

        @touch($migrationMarker);
    } catch (PDOException $migrationError) {
        error_log("Failed to auto-migrate database: " . $migrationError->getMessage());
    }
}

// ---------- 6. Release expired pending request matches ----------
if ($pdo) {
    try {
        $stmt = $pdo->prepare('
            SELECT rm.*, r.province, r.district, r.sector, r.type
            FROM request_matches rm
            JOIN requests r ON r.id = rm.request_id
            WHERE rm.status = "pending" AND rm.delivered_at <= NOW()
        ');
        $stmt->execute();
        $pendingRelease = $stmt->fetchAll();

        if (!empty($pendingRelease) && class_exists('NotificationModel')) {
            $updateStmt = $pdo->prepare('UPDATE request_matches SET status = "delivered" WHERE id = ?');
            foreach ($pendingRelease as $match) {
                $updateStmt->execute([$match['id']]);
                NotificationModel::create(
                    $pdo,
                    (int)$match['provider_id'],
                    'New request in ' . trim(($match['district'] ?: $match['province']) . ' / ' . ($match['sector'] ?: '')) . ': ' . sanitize($match['type'] ?? 'service'),
                    (int)$match['request_id']
                );
            }
        }
    } catch (PDOException $e) {
        error_log("Failed to release pending request matches: " . $e->getMessage());
    }
}
