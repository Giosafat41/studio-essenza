<!-- File: Smarty/templates/home.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="hero-section" style="text-align: center; padding: 60px 20px; background: white; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin: 40px auto; max-width: 800px;">
    <h1 style="color: #7b8b6f; font-size: 36px; margin-bottom: 15px;">Studio Essenza</h1>
    <p style="font-size: 18px; color: #666; margin-bottom: 35px;">{$messaggio_benvenuto}</p>
    
    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="index.php?controller=info&action=tariffe" class="btn-primary" style="background-color: #7b8b6f; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px;">Scopri le Tariffe</a>
        <a href="index.php?controller=utente&action=login" class="btn-primary" style="background-color: #4a4a4a; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px;">Accedi / Prenota</a>
    </div>
</div>

<div class="grid-tariffe" style="margin-bottom: 40px;">
    <div class="card-tariffa">
        <h3>Pilates Reformer</h3>
        <p class="desc">Allenamento completo sui macchinari in piccoli gruppi per la massima precisione posturale.</p>
    </div>
    <div class="card-tariffa">
        <h3>Pilates Matwork</h3>
        <p class="desc">Esercizi a corpo libero sul tappetino per sviluppare forza nel core, flessibilità e controllo.</p>
    </div>
    <div class="card-tariffa">
        <h3>Lezioni Individuali</h3>
        <p class="desc">Percorsi personalizzati cuciti sulle tue esigenze fisiche e sui tuoi obiettivi.</p>
    </div>
</div>
{/block}