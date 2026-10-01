<?php

function currentUser() {
    static $user = null;
    if ($user === null && !empty($_SESSION['user_id'])) {
        global $pdo;
        if ($pdo) {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch();
        }
    }
    return $user;
}

function logout() {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    @session_destroy();
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    flash('success', 'You have been logged out successfully.');
    header('Location: ?route=login');
    exit;
}
