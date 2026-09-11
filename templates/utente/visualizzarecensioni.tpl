<section class="review-list">
    <h2>Cosa dicono i nostri clienti</h2>

    <div class="rating-summary">
        <span class="rating-summary__value">{$mediaStelle}</span>
        <span class="stars">{$stelleMedia}</span>
        <span class="status-note">({$numeroRecensioni} recensioni)</span>
    </div>

    {if $recensioni|@count == 0}
        <p class="auth-text">Nessuna recensione pubblicata finora.</p>
    {else}
        <div class="cards">
            {foreach $recensioni as $r}
                <article class="review-card" id="recensione-{$r.idR}">
                    <div class="review-card__meta">
                        <span>{$r.nomeMeccanico} <span class="stars stars--inline">{$r.stelleVoto}</span></span>
                        <span>{$r.data_recensione|date_format:"%d/%m/%Y"}</span>
                    </div>
                    <p class="review-card__commento">{$r.commento}</p>
                    <p class="status-note">— {$r.nomeAutore}</p>
                </article>
            {/foreach}
        </div>
    {/if}
</section>
