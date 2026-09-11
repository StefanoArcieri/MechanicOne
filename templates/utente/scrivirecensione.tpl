<section class="review-write" id="recensioni">
    <h2>Lascia una recensione</h2>
    {if $isLogged}
        <form class="form" action="/MechanicOne/recensione/scrivi" method="post">
            {*scelta del meccanico*}
            <div class="form-field">
                <label class="form-label" for="idM">Meccanico</label>
                <select class="form-input" id="idM" name="idM">
                    {foreach $meccanici as $m}
                        <option value="{$m.idM}">{$m.nomeCompleto}</option>
                    {/foreach}
                </select>
            </div>
            {*scelta del voto*}
            <div class="form-field">
                <label class="form-label" for="voto">Voto</label>
                <select class="form-input" id="voto" name="voto" required>
                    <option value="5">5 - Eccellente</option>
                    <option value="4">4 - Molto buono</option>
                    <option value="3">3 - Buono</option>
                    <option value="2">2 - Sufficiente</option>
                    <option value="1">1 - Scarso</option>
                </select>
            </div>
            {*scrittura commento*}
            <div class="form-field form-field--last">
                <label class="form-label" for="commento">Commento</label>
                <textarea class="form-input" id="commento" name="commento" rows="3" required></textarea>
            </div>
            <button class="form-submit form-submit--primary" type="submit">Pubblica recensione</button>
        </form>
    {else}
        <p class="auth-text"><a class="form-link" href="/MechanicOne/utente/login">Accedi</a> per lasciare una recensione.</p>
    {/if}
</section>
