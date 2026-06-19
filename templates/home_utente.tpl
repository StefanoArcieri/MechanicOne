<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Area Cliente - MechanicOne</title>
</head>
<body style="background-color: #f9f9fb; font-family: Arial, sans-serif; margin: 0; padding: 20px;">
    <div style="max-width: 800px; margin: 30px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <h1 style="color: #2c3e50;">Benvenuto a bordo, {$nome}! 🚗</h1>
        <p style="color: #7f8c8d;">Questa è la tua area privata in MechanicOne. Da qui puoi gestire i tuoi motori.</p>
        
        <div style="margin-top: 30px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div style="border: 1fr solid #eee; padding: 20px; border-radius: 6px; background-color: #fcfcfc;">
                <h3>Garage Personale 🛠️</h3>
                <p>Visualizza le auto che hai registrato nell'officina o aggiungi un nuovo veicolo.</p>
                <a href="/MechanicOne/veicolo/nuovo" style="color: #e67e22; font-weight: bold; text-decoration: none;">Gestisci Veicoli &rarr;</a>
            </div>
            <div style="border: 1fr solid #eee; padding: 20px; border-radius: 6px; background-color: #fcfcfc;">
                <h3>Preventivi e Prenotazioni 📝</h3>
                <p>Controlla lo stato dei tuoi preventivi o prenota un appuntamento sul ponte.</p>
                <a href="/MechanicOne/preventivo/lista" style="color: #2980b9; font-weight: bold; text-decoration: none;">Vedi Richieste &rarr;</a>
            </div>
        </div>
        
        <hr style="margin: 40px 0; border: 0; border-top: 1px solid #eee;">
        <a href="/MechanicOne/utente/logout" style="color: #c0392b; font-weight: bold; text-decoration: none;">Esci dall'Officina</a>
    </div>
</body>
</html>