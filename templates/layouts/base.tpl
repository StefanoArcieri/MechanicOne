<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{block name="title"}MechanicOne{/block}</title>
    <link rel="stylesheet" href="/MechanicOne/templates/css/style.css?v=3">
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
                        {if $isLogged}
                            {if $userRole == 'meccanico'}
                                <a href="/MechanicOne/profilomeccanico/profilo">Il mio profilo</a>
                                <a href="/MechanicOne/gestiscipreventivi/lista">Preventivi da gestire</a>
                                <a href="/MechanicOne/gestisciprenotazioni/lista">Prenotazioni da gestire</a>
                            {elseif $userRole == 'admin'}
                                <a href="/MechanicOne/gestiscimeccanici/lista">Gestisci meccanici</a>
                                <a href="/MechanicOne/gestisciservizi/lista">Gestisci servizi</a>
                                <a href="/MechanicOne/gestiscipreventivi/lista">Preventivi da gestire</a>
                                <a href="/MechanicOne/gestisciprenotazioni/lista">Prenotazioni da gestire</a>
                            {else}
                                <a href="/MechanicOne/profilomeccanico/area">Area Meccanico</a>
                                <a href="/MechanicOne/richiedipreventivo/nuovo">Richiedi un preventivo</a>
                                <a href="/MechanicOne/visualizzapreventivi/lista">Visualizza i tuoi preventivi</a>
                                <a href="/MechanicOne/richiediprenotazione/nuovo">Richiedi una prenotazione</a>
                                <a href="/MechanicOne/visualizzaprenotazioni/lista">Visualizza le tue prenotazioni</a>
                                <a href="/MechanicOne/aggiungiveicolo/nuovo">Aggiungi un veicolo</a>
                                <a href="/MechanicOne/garage/lista">Visualizza il tuo garage</a>
                            {/if}
                            <a href="/MechanicOne/utente/logout" class="profile-menu__logout">Esci</a>
                        {else}
                            <a href="/MechanicOne/utente/login">Accedi</a>
                            <a href="/MechanicOne/utente/registrazione">Registrati</a>
                        {/if}
                    </div>
                </details>
            </div>
        </header>

        <main class="page-layout">
            {if $messaggioSuccesso}
                <div class="flash-success">{$messaggioSuccesso}</div>
            {/if}
            {block name="content"}{/block}
        </main>

        <footer class="site-footer">
            <p>© 2026 MechanicOne - Officina meccanica di fiducia</p>
        </footer>
    </div>
</body>
</html>
