<?php
// app/helpers/i18n.php
// Simple translation helper for SMARTMARKET
// Usage: __('key') returns string based on current language

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Allow language override via GET (e.g., ?lang=fr)
if (isset($_GET['lang'])) {
    $allowed = ['en', 'fr', 'rw'];
    $requested = $_GET['lang'];
    if (in_array($requested, $allowed, true)) {
        setLang($requested);
        // Redirect to remove the query param for clean URLs
        $url = strtok($_SERVER["REQUEST_URI"], '?');
        header('Location: ' . $url);
        exit;
    }
}

// Default language if not set
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

function setLang(string $lang): void {
    $allowed = ['en', 'fr', 'rw'];
    if (in_array($lang, $allowed, true)) {
        $_SESSION['lang'] = $lang;
        // Also set a cookie for persistence (30 days)
        setcookie('lang', $lang, time() + 30 * 24 * 60 * 60, '/');
    }
}

function currentLang(): string {
    return $_SESSION['lang'] ?? 'en';
}

function loadTranslations(string $lang): array {
    $file = __DIR__ . '/../../lang/' . $lang . '.php';
    if (file_exists($file)) {
        return include $file; // returns associative array
    }
    // fallback to English
    return include __DIR__ . '/../../lang/en.php';
}

function __($key, array $replace = []): string {
    static $translations = null;
    if ($translations === null) {
        $lang = currentLang();
        $translations = loadTranslations($lang);
    }
    $text = $translations[$key] ?? $key; // fallback to key if missing
    if (!empty($replace)) {
        foreach ($replace as $search => $value) {
            $text = str_replace($search, $value, $text);
        }
    }
    return $text;
}
?>
