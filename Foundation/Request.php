<?php

/**
 * Incapsula l'accesso a $_POST, $_GET, $_FILES e $_SERVER: nessun controller tocca
 * direttamente le superglobali, passa sempre da qui.
 */
class Request {

    public static function post($key, $default = null) {
        return $_POST[$key] ?? $default;
    }

    // una voce di $_FILES (array con error/tmp_name/size/...), oppure null se il campo non esiste
    public static function file($key) {
        return $_FILES[$key] ?? null;
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
