{extends file='layouts/base.tpl'}

{block name='title'}Meccanici - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>Meccanici</h1>
            <p>Il team di MechanicOne.</p>
        </div>
    </header>

    {if $errore}
        <div class="form-alert">{$errore}</div>
    {/if}

    {if $credenzialiGenerate}
        <div class="credentials-box">
            <h3 class="credentials-box__title">✅ Account meccanico creato</h3>
            <p>Consegna queste credenziali al collaboratore: <strong>non verranno mostrate di nuovo</strong>.</p>
            <div class="credentials-box__row">
                <span class="credentials-box__label">Email</span>
                <code class="credentials-box__value">{$credenzialiGenerate.email}</code>
            </div>
            <div class="credentials-box__row">
                <span class="credentials-box__label">Password provvisoria</span>
                <code class="credentials-box__value">{$credenzialiGenerate.password}</code>
            </div>
        </div>
    {/if}

    {if $userRole == 'admin'}
        <section class="status-section">
            <h2 class="status-section__title">Crea nuovo meccanico</h2>
            <div class="form-panel" style="width:auto; box-shadow:none; padding:0;">
                <form class="form" action="/MechanicOne/gestiscimeccanici/creaMeccanico" method="post">
                    <div class="form-field">
                        <label class="form-label" for="nome">Nome</label>
                        <input class="form-input" type="text" id="nome" name="nome" required>
                    </div>
                    <div class="form-field">
                        <label class="form-label" for="cognome">Cognome</label>
                        <input class="form-input" type="text" id="cognome" name="cognome" required>
                    </div>
                    <div class="form-field">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-input" type="email" id="email" name="email" required>
                    </div>
                    <div class="form-field form-field--last">
                        <label class="form-label" for="specializzazione">Specializzazione</label>
                        <input class="form-input" type="text" id="specializzazione" name="specializzazione" placeholder="Es. Elettrauto, Carrozzeria...">
                    </div>
                    <p class="form-hint">La password viene generata automaticamente: comparirà qui sopra subito dopo la creazione, pronta da copiare.</p>
                    <button class="form-submit form-submit--primary" type="submit">Crea account meccanico</button>
                </form>
            </div>
        </section>
    {/if}

    {if $meccanici|@count == 0}
        <p class="auth-text">Nessun meccanico registrato.</p>
    {else}
        <div class="cards">
            {foreach $meccanici as $m}
                <article class="card">
                    <h3>{$m.nome} {$m.cognome}</h3>
                    <p>{$m.specializzazione|default:'Nessuna specializzazione indicata'}</p>
                    {if $userRole == 'admin'}
                        <div class="auth-actions">
                            <form action="/MechanicOne/gestiscimeccanici/eliminaMeccanico/{$m.idM}" method="post" onsubmit="return confirm('Eliminare questo meccanico?');">
                                <button class="btn btn--danger" type="submit">Elimina</button>
                            </form>
                        </div>
                    {/if}
                </article>
            {/foreach}
        </div>
    {/if}
</div>
{/block}
