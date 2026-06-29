<?php

require_once __DIR__ . '/View.php';

class VMeccanico extends View {
    private function formatProfilo($profilo): string {
        if (is_array($profilo)) {
            $id = $profilo['idM'] ?? '';
            $nome = $profilo['nome'] ?? '';
            $cognome = $profilo['cognome'] ?? '';
            $specializzazione = $profilo['specializzazione'] ?? '';
            $status = $profilo['status'] ?? $profilo['stato'] ?? '';
            return trim("#{$id} {$nome} {$cognome} - {$specializzazione} ({$status})");
        }

        if (is_object($profilo)) {
            $id = method_exists($profilo, 'getIdMeccanico') ? $profilo->getIdMeccanico() : '';
            $nome = method_exists($profilo, 'getNome') ? $profilo->getNome() : '';
            $cognome = method_exists($profilo, 'getCognome') ? $profilo->getCognome() : '';
            $specializzazione = method_exists($profilo, 'getSpecializzazione') ? $profilo->getSpecializzazione() : '';
            $status = method_exists($profilo, 'getStatus') ? $profilo->getStatus() : '';
            return trim("#{$id} {$nome} {$cognome} - {$specializzazione} ({$status})");
        }

        return (string) $profilo;
    }

    private function formatMeccanici(array $meccanici): array {
        return array_map(function ($meccanico) {
            if (is_array($meccanico)) {
                $id = $meccanico['idM'] ?? '';
                $nome = $meccanico['nome'] ?? '';
                $cognome = $meccanico['cognome'] ?? '';
                $specializzazione = $meccanico['specializzazione'] ?? '';
                $status = $meccanico['status'] ?? $meccanico['stato'] ?? '';
            } else {
                $id = method_exists($meccanico, 'getIdMeccanico') ? $meccanico->getIdMeccanico() : '';
                $nome = method_exists($meccanico, 'getNome') ? $meccanico->getNome() : '';
                $cognome = method_exists($meccanico, 'getCognome') ? $meccanico->getCognome() : '';
                $specializzazione = method_exists($meccanico, 'getSpecializzazione') ? $meccanico->getSpecializzazione() : '';
                $status = method_exists($meccanico, 'getStatus') ? $meccanico->getStatus() : '';
            }

            return trim(sprintf('#%s %s %s - %s (%s)', $id, $nome, $cognome, $specializzazione, $status));
        }, $meccanici);
    }

    public function mostraProfilo($profilo) {
        $this->renderTemplate('meccanico.tpl', [
            'titolo' => 'Profilo meccanico',
            'profilo' => $profilo,
            'dettaglioProfilo' => $this->formatProfilo($profilo),
            'tipo' => 'profilo'
        ]);
    }

    public function mostraLista($meccanici) {
        $this->renderTemplate('meccanico.tpl', [
            'titolo' => 'Elenco meccanici',
            'meccanici' => $this->formatMeccanici($meccanici),
            'tipo' => 'lista'
        ]);
    }

    public function mostraAreaTeam() {
        $this->renderTemplate('meccanico.tpl', [
            'titolo' => 'Area Meccanico',
            'tipo' => 'team',
            'messaggio' => 'Vuoi far parte del team? Inviaci il curriculum.'
        ]);
    }
}
