<?php

/**
 * Incapsula l'accesso a $_POST, $_GET e $_SERVER: nessun controller tocca
 * direttamente le superglobali, passa sempre da qui.
 */
class Request {

    public static function post($key, $default = null) {
        return $_POST[$key] ?? $default;
    }

    public static function get($key, $default = null) {
        return $_GET[$key] ?? $default;
    }

    public static function hasPost(...$keys) {
        foreach ($keys as $key) {
            if (!isset($_POST[$key])) {
                return false;
            }
        }
        return true;
    }

    public static function method() {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public static function isPost() {
        return self::method() === 'POST';
    }
}
?>
