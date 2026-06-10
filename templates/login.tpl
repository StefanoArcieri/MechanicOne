<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login - MechanicOne</title>
</head>
<body style="background-color: #fafaf9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0;">

    <div style="max-width: 450px; margin: 80px auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 5px solid #e67e22;">
        
        <div style="text-align: center; margin-bottom: 25px;">
            <h2 style="color: #2c3e50; margin: 0 0 10px 0; font-size: 24px;">🔧 Officina MechanicOne</h2>
            <p style="color: #7f8c8d; margin: 0; font-size: 14px;">Inserisci le tue credenziali per accedere al sistema</p>
        </div>

        {* Gestione degli errori nativa in Smarty: se la variabile $errore non è vuota, mostra il box *}
        {if $errore}
            <div style="background-color: #fadbd8; border: 1px solid #f5b7b1; color: #78281f; padding: 12px; margin-bottom: 20px; border-radius: 4px; font-size: 14px; display: block;">
                <strong>❌ Errore:</strong> {$errore}
            </div>
        {/if}

        {* L'azione del form punta direttamente alla rotta del Front Controller *}
        <form action="/MechanicOne/utente/login" method="POST">
            
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; color: #34495e; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Indirizzo Email</label>
                <input type="email" id="email" name="email" required placeholder="esempio@meccanico.it" 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; outline: none;">
            </div>

            <div style="margin-bottom: 25px;">
                <label for="password" style="display: block; color: #34495e; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••" 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; outline: none;">
            </div>

            <button type="submit" name="login" 
                    style="width: 100%; background-color: #e67e22; color: white; border: none; padding: 12px; font-size: 16px; font-weight: bold; border-radius: 4px; cursor: pointer; transition: background 0.2s;">
                Entra in Officina
            </button>
            
        </form>

        <div style="margin-top: 20px; text-align: center; border-top: 1px solid #ecf0f1; padding-top: 15px;">
            <p style="margin: 0; font-size: 13px; color: #95a5a6;">
                Non sei registrato? Contatta l'amministratore di MechanicOne.
            </p>
        </div>

    </div>

</body>
</html>