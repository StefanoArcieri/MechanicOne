<?php

require_once __DIR__ . '/../fpdf/fpdf.php';
require_once __DIR__ . '/PersistentManager.php';

/**
 * Genera il PDF della richiesta di preventivo, salvato in /uploads/preventivi.
 * Usa FPDF (vendorizzata in /fpdf, stesso approccio "niente Composer" già usato per Smarty):
 * un solo file php più le metriche dei font di base.
 */
class PdfPreventivo {

    // I font di base di FPDF lavorano in CP1252, non UTF-8: senza questa conversione
    // le lettere accentate italiane uscirebbero come caratteri a caso nel PDF.
    // Deliberatamente mb_convert_encoding() e non iconv(...//TRANSLIT...): quest'ultima dipende
    // dal locale di sistema (setlocale) e su Windows può restituire silenziosamente false quando
    // gira sotto mod_php/Apache pur funzionando identica da riga di comando, perdendo il testo
    // senza nessun errore visibile. mb_convert_encoding non ha questa dipendenza.
    private static function testo($stringa) {
        $convertito = mb_convert_encoding((string) $stringa, 'CP1252', 'UTF-8');
        return $convertito !== false ? $convertito : (string) $stringa;
    }

    // Genera il PDF per un preventivo già salvato (serve il suo id) e ne ritorna il nome file,
    // da agganciare alla colonna 'pdf' della riga. Non tocca il database: lo fa chi chiama.
    public static function genera($preventivo) {
        $pm = PersistentManager::getInstance();

        $cliente  = $pm->load('EUtente', 'idU', $preventivo->getIdUtente());
        $veicolo  = $pm->load('EVeicolo', 'idV', $preventivo->getIdVeicolo());
        $servizio = $pm->load('EServizio', 'idS', $preventivo->getIdServizio());

        $pdf = new FPDF();
        $pdf->SetMargins(20, 20, 20);
        $pdf->SetAutoPageBreak(true, 25);
        $pdf->AddPage();

        $pdf->SetFont('Helvetica', 'B', 20);
        $pdf->Cell(0, 12, self::testo('MechanicOne'), 0, 1);

        $pdf->SetFont('Helvetica', '', 10);
        $pdf->SetTextColor(110, 110, 110);
        $pdf->Cell(0, 6, self::testo('Officina meccanica di fiducia'), 0, 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(6);

        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->Cell(0, 10, self::testo('Richiesta di preventivo #' . $preventivo->getIdPreventivo()), 0, 1);
        $pdf->Ln(2);

        $righe = [
            'Data richiesta'     => date('d/m/Y H:i', strtotime($preventivo->getDataRichiesta())),
            'Cliente'            => $cliente ? trim($cliente->getNome() . ' ' . $cliente->getCognome()) : '—',
            'Email'              => $cliente ? $cliente->getEmail() : '—',
            'Veicolo'            => $veicolo ? $veicolo->getMarca() . ' ' . $veicolo->getModello() . ' (' . $veicolo->getTarga() . ')' : '—',
            'Servizio richiesto' => $servizio ? $servizio->getTitolo() : '—',
            'Stato'              => ucfirst($preventivo->getStato()),
        ];
        foreach ($righe as $etichetta => $valore) {
            $pdf->SetFont('Helvetica', 'B', 11);
            $pdf->Cell(48, 8, self::testo($etichetta . ':'), 0, 0);
            $pdf->SetFont('Helvetica', '', 11);
            $pdf->Cell(0, 8, self::testo($valore), 0, 1);
        }

        $pdf->Ln(4);
        $pdf->SetFont('Helvetica', 'B', 11);
        $pdf->Cell(0, 8, self::testo('Descrizione del problema / intervento richiesto:'), 0, 1);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->MultiCell(0, 6, self::testo($preventivo->getDescrizione()));

        if ($preventivo->getCosto() !== null) {
            $pdf->Ln(4);
            $pdf->SetFont('Helvetica', 'B', 13);
            $pdf->Cell(0, 8, self::testo('Prezzo: ' . number_format((float) $preventivo->getCosto(), 2, ',', '.') . ' €'), 0, 1);
        }

        // il footer si piazza a mano in un punto fisso vicino al fondo pagina: l'auto-page-break
        // va disattivato qui, altrimenti l'altezza della sua stessa cella basta a far scattare
        // un'inutile pagina 2 (la soglia e la posizione del footer sono quasi la stessa cosa).
        $pdf->SetAutoPageBreak(false);
        $pdf->SetY(-25);
        $pdf->SetFont('Helvetica', 'I', 8);
        $pdf->SetTextColor(140, 140, 140);
        $pdf->Cell(0, 10, self::testo('Documento generato automaticamente da MechanicOne il ' . date('d/m/Y H:i')), 0, 0, 'C');

        $cartella = __DIR__ . '/../uploads/preventivi/';
        if (!is_dir($cartella) && !mkdir($cartella, 0755, true) && !is_dir($cartella)) {
            throw new Exception("Impossibile preparare la cartella per il PDF.");
        }

        // niente nome prevedibile: id + qualche byte casuale, così non si indovina l'url di un altro
        $nomeFile = 'preventivo_' . $preventivo->getIdPreventivo() . '_' . bin2hex(random_bytes(4)) . '.pdf';
        $pdf->Output('F', $cartella . $nomeFile);

        return $nomeFile;
    }
}
?>
