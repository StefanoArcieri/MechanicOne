{extends file='layouts/base.tpl'}

{block name='title'}Prenotazioni da gestire - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>{$titolo|default:'Prenotazioni da gestire'}</h1>
            <p>Conferma gli appuntamenti in attesa e segna quelli conclusi.</p>
        </div>
    </header>

    {if $errore}
        <div class="form-alert">{$errore}</div>
    {/if}

    {foreach $sezioni as $sezione}
        <section class="status-section">
            <h2 class="status-section__title">{$sezione.label} <span class="status-count">{$sezione.items|@count}</span></h2>
            {if $sezione.items|@count == 0}
                <p class="auth-text">{$sezione.vuoto}</p>
            {else}
                <div class="cards">
                    {foreach $sezione.items as $p}
                        <article class="card status-card status-card--{$sezione.classe}">
                            <h3>Prenotazione #{$p.idPren}</h3>
                            <p class="status-note">{$p.clienteLabel} — {$p.veicoloLabel}</p>
                            <p>{$p.data|date_format:"%d/%m/%Y"} alle {$p.ora}</p>
                            {if $p.data_proposta}
                                <p class="status-note">Modifica proposta dal cliente: <em>{$p.data_proposta|date_format:"%d/%m/%Y"} alle {$p.ora_proposta}</em></p>
                            {/if}
                            {if $p.meccanicoLabel}
                                <p class="status-note">Meccanico assegnato: {$p.meccanicoLabel}</p>
                            {/if}

                            {if $sezione.classe == 'in-attesa'}
                                <form action="/MechanicOne/gestisciprenotazioni/accetta/{$p.idPren}" method="post">
                                    <button class="btn btn--success" type="submit">Conferma</button>
                                </form>
                                <form action="/MechanicOne/gestisciprenotazioni/cancella/{$p.idPren}" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
                                    <button class="btn btn--danger" type="submit">Cancella</button>
                                </form>
                            {elseif $sezione.classe == 'accettata'}
                                <form action="/MechanicOne/gestisciprenotazioni/concludi/{$p.idPren}" method="post">
                                    <button class="btn btn--success" type="submit">Segna come conclusa</button>
                                </form>
                                <form action="/MechanicOne/gestisciprenotazioni/cancella/{$p.idPren}" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
                                    <button class="btn btn--danger" type="submit">Cancella</button>
                                </form>
                            {/if}
                        </article>
                    {/foreach}
                </div>
            {/if}
        </section>
    {/foreach}
</div>
{/block}
