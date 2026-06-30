{extends file='layouts/base.tpl'}

{block name='title'}Registrazione - MechanicOne{/block}

{block name='content'}
<div class="form-panel form-panel--register">
    <div class="form-header">
        <h2 class="form-title">🔧 Unisciti a MechanicOne</h2>
        <p class="form-subtitle">Crea il tuo profilo per gestire i tuoi veicoli e richiedere preventivi</p>
    </div>

    {* Se il controllore CUtente ci passa un messaggio d'errore via Smarty, lo stampiamo qui *}
    {if $errore}
        <div class="form-alert">
            <strong>❌ Errore:</strong> {$errore}
        </div>
    {/if}

    {* L'azione punta dritta alla rotta del Front Controller gestita dal metodo 'registrazione' *}
    <form action="/MechanicOne/utente/registrazione" method="POST" class="form">
        <div class="form-field">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" required placeholder="Inserisci il tuo nome" class="form-input">
        </div>

        <div class="form-field">
            <label for="cognome" class="form-label">Cognome</label>
            <input type="text" id="cognome" name="cognome" required placeholder="Inserisci il tuo cognome" class="form-input">
        </div>

        <div class="form-field">
            <label for="email" class="form-label">Indirizzo Email</label>
            <input type="email" id="email" name="email" required placeholder="esempio@email.it" class="form-input">
        </div>

        <div class="form-field">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" required placeholder="Scegli una password sicura" class="form-input">
        </div>

        <div class="form-field">
            <label for="ruolo" class="form-label">Tipo di account</label>
            <select id="ruolo" name="ruolo" class="form-input" onchange="toggleSpecializzazione(this.value)">
                <option value="cliente">Cliente</option>
                <option value="meccanico">Meccanico</option>
            </select>
        </div>

        <div class="form-field form-field--last" id="campo-specializzazione" style="display:none;">
            <label for="specializzazione" class="form-label">Specializzazione</label>
            <input type="text" id="specializzazione" name="specializzazione" placeholder="Es. Elettrauto, Carrozzeria..." class="form-input">
        </div>

        <button type="submit" class="form-submit form-submit--primary">
            Registrati e Accedi
        </button>
    </form>

    <div class="form-footer">
        <p class="form-help">
            Hai già un account? <a href="/MechanicOne/utente/login" class="form-link">Torna al Login</a>
        </p>
    </div>
</div>
<script>
function toggleSpecializzazione(ruolo) {
    var campo = document.getElementById('campo-specializzazione');
    campo.style.display = ruolo === 'meccanico' ? 'block' : 'none';
}
</script>
{/block}