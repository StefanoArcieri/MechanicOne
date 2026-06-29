<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{block name="title"}MechanicOne{/block}</title>
    <link rel="stylesheet" href="/MechanicOne/templates/css/style.css">
</head>
<body class="page-shell">
    <div class="page-wrapper">
        <header class="site-header">
            <a class="site-brand" href="/MechanicOne">MechanicOne</a>

            <div class="header-user">
                {if $isLogged}
                    <span class="header-greeting">Benvenuto, {$nomeUtente}</span>
                {else}
                    <a class="header-login-link" href="/MechanicOne/utente/login">Benvenuto, clicca qui per accedere</a>
                {/if}

                <details class="profile-menu">
                    <summary class="profile-menu__trigger" aria-label="Menu profilo">👤</summary>
                    <div class="profile-menu__panel">
                        <a href="/MechanicOne/meccanico/area">Area Meccanico</a>
                        <a href="/MechanicOne/preventivo/richiedi"> Richiedi un preventivo</a>
                        <a href="/MechanicOne/preventivo/lista"> Visualizza i tuoi preventivi</a>
                        <a href="/MechanicOne/prenotazione/prenota"> Richiedi una prenotazione</a>
                        <a href="/MechanicOne/prenotazione/lista"> Visualizza le tue prenotazioni</a>
                        <a href="/MechanicOne/veicolo/aggiungiVeicolo"> Aggiungi un veicolo</a>
                        <a href="/MechanicOne/veicolo/getVeicoliPersonali"> Visualizza il tuo garage</a>
                    </div>
                </details>
            </div>
        </header>

        <main class="page-layout">
            {block name="content"}{/block}
        </main>

        <footer class="site-footer">
            <p>© 2026 MechanicOne - Officina meccanica di fiducia</p>
        </footer>
    </div>
</body>
</html>
