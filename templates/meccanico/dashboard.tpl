{extends file='layouts/base.tpl'}

{block name='title'}Dashboard Meccanico - MechanicOne{/block}

{block name='content'}
<div class="auth-panel auth-panel--mechanic">
    {if $errore}
        <div class="form-alert"><strong>Errore:</strong> {$errore}</div>
    {/if}

    {if $profilo}
        <div class="dashboard-hero">
            {if $profilo.foto_profilo}
                <img class="profile-photo" src="/MechanicOne/uploads/meccanici/{$profilo.foto_profilo}" alt="Foto profilo di {$profilo.nome} {$profilo.cognome}">
            {else}
                <div class="dashboard-hero__avatar-placeholder">{$profilo.iniziale}</div>
            {/if}
            <h2>{$profilo.nome} {$profilo.cognome}</h2>
            <p class="auth-text">{$profilo.specializzazione|default:'Nessuna specializzazione indicata'}</p>
        </div>

        <hr class="auth-divider">

        <h3 class="auth-title auth-title--small">Situazione generale</h3>
        <div class="stat-grid">
            <div class="stat-card">
                <span class="stat-card__numero">{$stats.daAccettare}</span>
                <span class="stat-card__etichetta">Prenotazioni disponibili</span>
            </div>
            <div class="stat-card">
                <span class="stat-card__numero">{$stats.inCorso}</span>
                <span class="stat-card__etichetta">In carico a te</span>
            </div>
            <div class="stat-card">
                <span class="stat-card__numero">{$stats.concluse}</span>
                <span class="stat-card__etichetta">Interventi conclusi da te</span>
            </div>
        </div>

        <hr class="auth-divider">

        <h3 class="auth-title auth-title--small">Cosa vuoi fare?</h3>
        <div class="home-grid">
            <div class="home-card">
                <h3>Il mio profilo</h3>
                <p>Modifica la tua specializzazione, la foto profilo o la password.</p>
                <a class="home-link home-link--orange" href="/MechanicOne/profilomeccanico/profilo">Vai al profilo</a>
            </div>
            <div class="home-card">
                <h3>Prenotazioni</h3>
                <p>Prendi in carico nuovi interventi e gestisci quelli già assegnati a te.</p>
                <a class="home-link home-link--green" href="/MechanicOne/gestisciprenotazioni/lista">Gestisci prenotazioni</a>
            </div>
        </div>

        <hr class="auth-divider">
        <a class="btn btn--danger" href="/MechanicOne/utente/logout">Esci / Logout</a>
    {else}
        <p class="auth-text">Profilo non disponibile.</p>
    {/if}
</div>
{/block}
