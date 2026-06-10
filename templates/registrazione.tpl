<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione - MechanicOne</title>
</head>
<body style="background-color: #fafaf9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0;">

    <div style="max-width: 500px; margin: 60px auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 5px solid #2980b9;">
        
        <div style="text-align: center; margin-bottom: 25px;">
            <h2 style="color: #2c3e50; margin: 0 0 10px 0; font-size: 24px;">🔧 Unisciti a MechanicOne</h2>
            <p style="color: #7f8c8d; margin: 0; font-size: 14px;">Crea il tuo profilo per gestire i tuoi veicoli e richiedere preventivi</p>
        </div>

        {* Se il controllore CUtente ci passa un messaggio d'errore via Smarty, lo stampiamo qui *}
        {if $errore}
            <div style="background-color: #fadbd8; border: 1px solid #f5b7b1; color: #78281f; padding: 12px; margin-bottom: 20px; border-radius: 4px; font-size: 14px;">
                <strong>❌ Errore:</strong> {$errore}
            </div>
        {/if}

        {* L'azione punta dritta alla rotta del Front Controller gestita dal metodo 'registrazione' *}
        <form action="/MechanicOne/utente/registrazione" method="POST">
            
            <div style="margin-bottom: 15px;">
                <label for="nome" style="display: block; color: #34495e; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Nome</label>
                <input type="text" id="nome" name="nome" required placeholder="Inserisci il tuo nome" 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; outline: none;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="cognome" style="display: block; color: #34495e; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Cognome</label>
                <input type="text" id="cognome" name="cognome" required placeholder="Inserisci il tuo cognome" 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; outline: none;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; color: #34495e; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Indirizzo Email</label>
                <input type="email" id="email" name="email" required placeholder="esempio@email.it" 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; outline: none;">
            </div>

            <div style="margin-bottom: 25px;">
                <label for="password" style="display: block; color: #34495e; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Password</label>
                <input type="password" id="password" name="password" required placeholder="Scegli una password sicura" 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; outline: none;">
            </div>

            {* Pulsante di submit esplicito per far scattare l'invio del form via POST *}
            <button type="submit" 
                    style="width: 100%; background-color: #2980b9; color: white; border: none; padding: 12px; font-size: 16px; font-weight: bold; border-radius: 4px; cursor: pointer; transition: background 0.2s;">
                Registrati e Accedi
            </button>
            
        </form>

        <div style="margin-top: 20px; text-align: center; border-top: 1px solid #ecf0f1; padding-top: 15px;">
            <p style="margin: 0; font-size: 13px; color: #95a5a6;">
                Hai già un account? <a href="/MechanicOne/utente/login" style="color: #e67e22; text-decoration: none; font-weight: bold;">Torna al Login</a>
            </p>
        </div>

    </div>

</body>
</html>