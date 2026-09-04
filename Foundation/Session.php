<?php
class Session {
    
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    public static function has($key) {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove($key) {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function destroy() {
        self::start();
        session_destroy();
    }

    // Da chiamare subito dopo un login riuscito: cambia l'id di sessione mantenendo i dati,
    // così un id di sessione noto/impostato prima del login (session fixation) smette di
    // valere per la sessione autenticata che segue.
    public static function regenerate() {
        self::start();
        session_regenerate_id(true);
    }
}
?>