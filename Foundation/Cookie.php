<?php

/**
 * Incapsula l'accesso a $_COOKIE e la creazione dei cookie: nessun controller tocca
 * direttamente la superglobale, passa sempre da qui (stesso principio di Request.php
 * per $_POST/$_GET/$_SERVER).
 */
class Cookie {

    public static function get($key, $default = null) {
        return $_COOKIE[$key] ?? $default;
    }

    public static function has($key) {
        return isset($_COOKIE[$key]);
    }

    /**
     * @param string $key
     * @param string $value
     * @param int $days giorni di validità del cookie (default 30)
     */
    public static function set($key, $value, $days = 30) {
        setcookie($key, $value, [
            'expires'  => time() + ($days * 24 * 60 * 60),
            'path'     => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        $_COOKIE[$key] = $value;
    }

    public static function delete($key) {
        setcookie($key, '', [
            'expires'  => time() - 3600,
            'path'     => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        unset($_COOKIE[$key]);
    }
}
?>
