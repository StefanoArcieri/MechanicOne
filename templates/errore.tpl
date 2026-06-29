{extends file='layouts/base.tpl'}

{block name='title'}Errore {$codice} - MechanicOne{/block}

{block name='content'}
<div class="error-panel">
    <h2 class="error-title">🔧 Ops! Problema ai motori di MechanicOne 🔧</h2>
    <h1 class="error-code">Errore {$codice}</h1>
    <p class="error-message">{$messaggio}</p>
    <hr class="error-divider">
    <p><a class="error-link" href="/MechanicOne/">Torna alla Homepage</a></p>
</div>
{/block}