<?php

/**
 * Upload di immagini verso /uploads. Non ci si fida mai del nome file o del Content-Type
 * dichiarati dal browser (un file .php rinominato in .jpg avrebbe comunque quell'estensione):
 * il tipo reale si legge dai byte del file con finfo, e il nome con cui viene salvato è
 * generato qui, mai quello scelto dall'utente.
 */
class Upload {

    private static $tipiConsentiti = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
        'image/gif'  => 'gif',
    ];

    /**
     * @param array|null $file  una voce di $_FILES (da Request::file())
     * @param string     $cartella  sottocartella di /uploads in cui salvare (es. 'meccanici')
     * @param int        $dimensioneMassimaMB
     * @return string|null  il nome del file salvato, o null se non era stato scelto alcun file
     * @throws Exception  con un messaggio già presentabile all'utente
     */
    public static function immagine($file, $cartella, $dimensioneMassimaMB = 3) {
        if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if ($file['error'] === UPLOAD_ERR_INI_SIZE || $file['error'] === UPLOAD_ERR_FORM_SIZE) {
            throw new Exception("Il file è troppo grande.");
        }
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Errore durante il caricamento del file.");
        }
        if (!is_uploaded_file($file['tmp_name'])) {
            throw new Exception("Caricamento non valido.");
        }
        if ($file['size'] > $dimensioneMassimaMB * 1024 * 1024) {
            throw new Exception("Il file supera i {$dimensioneMassimaMB} MB consentiti.");
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!isset(self::$tipiConsentiti[$mime])) {
            throw new Exception("Formato immagine non supportato: usa JPG, PNG, WEBP o GIF.");
        }

        $estensione = self::$tipiConsentiti[$mime];
        $nomeFile = bin2hex(random_bytes(16)) . '.' . $estensione;

        $cartellaCompleta = self::percorsoCartella($cartella);
        if (!is_dir($cartellaCompleta) && !mkdir($cartellaCompleta, 0755, true) && !is_dir($cartellaCompleta)) {
            throw new Exception("Impossibile preparare la cartella di destinazione.");
        }

        if (!move_uploaded_file($file['tmp_name'], $cartellaCompleta . $nomeFile)) {
            throw new Exception("Impossibile salvare il file caricato.");
        }

        return $nomeFile;
    }

    // rimuove un file caricato in precedenza (es. la vecchia foto, quando se ne carica una nuova)
    public static function elimina($cartella, $nomeFile) {
        if (!$nomeFile) return;
        $path = self::percorsoCartella($cartella) . basename($nomeFile);
        if (is_file($path)) {
            @unlink($path);
        }
    }

    private static function percorsoCartella($cartella) {
        return __DIR__ . '/../uploads/' . $cartella . '/';
    }
}
?>
