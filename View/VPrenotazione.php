<?php

require_once __DIR__ . '/View.php';

class VPrenotazione extends View {
    private function formatPrenotazioni(array $prenotazioni): array {
        return array_map(function ($prenotazione) {
            if (is_array($prenotazione)) {
                $id = $prenotazione['idPren'] ?? '';
                $data = $prenotazione['data'] ?? '';
                $ora = $prenotazione['ora'] ?? '';
            } elseif (is_object($prenotazione)) {
                $id = method_exists($prenotazione, 'getIdPren') ? $prenotazione->getIdPren() : '';
                $data = method_exists($prenotazione, 'getData') ? $prenotazione->getData() : '';
                $ora = method_exists($prenotazione, 'getOra') ? $prenotazione->getOra() : '';
            } else {
                return (string) $prenotazione;
            }

            return trim(sprintf('#%s: %s %s', $id, $data, $ora));
        }, $prenotazioni);
    }

    public function mostraLista($prenotazioni) {
        $this->renderTemplate('prenotazione.tpl', [
            'titolo' => 'Prenotazioni',
            'prenotazioni' => $this->formatPrenotazioni($prenotazioni),
            'tipo' => 'lista'
        ]);
    }

    public function mostraDettaglio($prenotazione) {
        $this->renderTemplate('prenotazione.tpl', [
            'titolo' => 'Dettaglio prenotazione',
            'prenotazione' => $prenotazione,
            'tipo' => 'dettaglio'
        ]);
    }
}
