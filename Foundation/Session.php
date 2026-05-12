<?php
class Session {
    //start() è chiamato in header.php, 
    // quindi non serve chiamarlo in ogni pagina
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Metodi per gestire i dati di sessione
    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    // Il get ritorna null se la chiave non esiste, 
    // così evitiamo errori di "undefined index"
    public static function get($key) {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    // has() è utile per verificare se una chiave esiste senza doverla leggere
    public static function has($key) {
        self::start();
        return isset($_SESSION[$key]);
    }

    // Rimuove una chiave specifica dalla sessione
    public static function remove($key) {
        self::start();
        unset($_SESSION[$key]);
    }

    // Distrugge completamente la sessione, usato per il logout
    public static function destroy() {
        self::start();
        session_destroy();
    }
}
?>