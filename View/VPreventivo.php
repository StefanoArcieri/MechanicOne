<?php

require_once __DIR__ . '/View.php';

class VPreventivo extends View {
    private function formatPreventivi(array $preventivi): array {
        return array_map(function ($preventivo) {
            if (is_array($preventivo)) {
                $id = $preventivo['idPrev'] ?? '';
                $stato = $preventivo['stato'] ?? '';
                $descrizione = $preventivo['descrizione'] ?? '';
            } elseif (is_object($preventivo)) {
                $id = method_exists($preventivo, 'getIdPrev') ? $preventivo->getIdPrev() : '';
                $stato = method_exists($preventivo, 'getStato') ? $preventivo->getStato() : '';
                $descrizione = method_exists($preventivo, 'getDescrizione') ? $preventivo->getDescrizione() : '';
            } else {
                return (string) $preventivo;
            }

            return trim(sprintf('#%s: %s - %s', $id, $stato, $descrizione));
        }, $preventivi);
    }

    public function mostraLista($preventivi, $errore = '') {
        $this->renderTemplate('preventivo.tpl', [
            'titolo'     => 'Preventivi',
            'preventivi' => $this->formatPreventivi($preventivi),
            'tipo'       => 'lista',
            'errore'     => $errore,
        ]);
    }

    public function mostraDettaglio($preventivo) {
        $this->renderTemplate('preventivo.tpl', [
            'titolo' => 'Dettaglio preventivo',
            'preventivo' => $preventivo,
            'tipo' => 'dettaglio'
        ]);
    }
}
