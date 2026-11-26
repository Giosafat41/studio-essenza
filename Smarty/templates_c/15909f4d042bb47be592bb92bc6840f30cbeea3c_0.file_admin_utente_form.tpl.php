<?php
/* Smarty version 5.8.5, created on 2026-11-26 17:41:33
  from 'file:admin_utente_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b08613ddb95e5_35482476',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15909f4d042bb47be592bb92bc6840f30cbeea3c' => 
    array (
      0 => 'admin_utente_form.tpl',
      1 => 1795710685,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b08613ddb95e5_35482476 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_utente_form.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17726073676b08613dd9a347_52076864', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_17726073676b08613dd9a347_52076864 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container admin-form-page py-2 py-md-3">

    <!-- Link ritorno alla Lista -->
    <div class="mb-3">
        <a href="index.php?controller=<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('controller_base') ?? null)===null||$tmp==='' ? 'admin' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&action=utenti" class="calendar-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Torna alla <?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('label_lista') ?? null)===null||$tmp==='' ? 'Lista Utenti' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</span>
        </a>
    </div>

    <section class="dashboard-card">
        <div class="mb-4">
            <span class="auth-badge mb-2"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('badge_sezione') ?? null)===null||$tmp==='' ? 'Anagrafica Studio' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</span>
            <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>
                <h1 class="dashboard-title">Modifica Profilo</h1>
                <p class="dashboard-subtitle">
                    Aggiorna i dati del profilo di <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getNome(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getCognome(), ENT_QUOTES, 'UTF-8', true);?>
</strong>.
                </p>
            <?php } else { ?>
                <h1 class="dashboard-title">Crea Nuovo Profilo</h1>
                <p class="dashboard-subtitle">
                    <?php if (((($tmp = $_smarty_tpl->getValue('controller_base') ?? null)===null||$tmp==='' ? 'admin' ?? null : $tmp)) == 'admin') {?>
                        Registra un nuovo segretario o istruttore nel sistema di Studio Essenza.
                    <?php } else { ?>
                        Registra un nuovo allievo o istruttore nel sistema di Studio Essenza.
                    <?php }?>
                </p>
            <?php }?>
        </div>

        <?php if ((true && ($_smarty_tpl->hasVariable('messaggio_errore') && null !== ($_smarty_tpl->getValue('messaggio_errore') ?? null)))) {?>
            <div class="alert auth-alert-error fade show d-flex align-items-center justify-content-between gap-2 mb-4" role="alert">
                <span><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('messaggio_errore'), ENT_QUOTES, 'UTF-8', true);?>
</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
            </div>
        <?php }?>

        <form action="index.php?controller=<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('controller_base') ?? null)===null||$tmp==='' ? 'admin' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&action=<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>modificaUtente<?php } else { ?>creaUtente<?php }?>" method="POST" enctype="multipart/form-data">

            <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('utente')->getId();?>
">
            <?php }?>

            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <label for="nome" class="form-label auth-label">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control admin-input" required data-msg-required="Inserisci il nome." value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getNome(), ENT_QUOTES, 'UTF-8', true);
}?>">
                </div>

                <div class="col-12 col-sm-6">
                    <label for="cognome" class="form-label auth-label">Cognome</label>
                    <input type="text" id="cognome" name="cognome" class="form-control admin-input" required data-msg-required="Inserisci il cognome." value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getCognome(), ENT_QUOTES, 'UTF-8', true);
}?>">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <label for="email" class="form-label auth-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control admin-input" required data-msg-required="Inserisci l'indirizzo email." data-msg-type="Inserisci un indirizzo email valido (es. nome@esempio.it)." value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getEmail(), ENT_QUOTES, 'UTF-8', true);
}?>">
                </div>

                <div class="col-12 col-sm-6">
                    <label for="telefono" class="form-label auth-label">Telefono <span class="auth-optional">(opzionale)</span></label>
                    <input type="tel" id="telefono" name="telefono" class="form-control admin-input" value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getTelefono(), ENT_QUOTES, 'UTF-8', true);
}?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="data_nascita" class="form-label auth-label">Data di nascita <span class="auth-optional">(opzionale)</span></label>
                <input
                    type="date"
                    id="data_nascita"
                    name="data_nascita"
                    class="form-control admin-input"
                    max="<?php echo (($tmp = $_smarty_tpl->getValue('oggi_input') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"
                    data-msg-max="La data di nascita non può essere nel futuro."
                    value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getDataNascita(), ENT_QUOTES, 'UTF-8', true);
}?>"
                >
            </div>

            <?php if (!(true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>
                <div class="mb-3">
                    <label for="password" class="form-label auth-label">Password Iniziale</label>
                    <div class="d-flex flex-column flex-sm-row gap-2 align-items-stretch">
                        <div class="auth-input-group flex-grow-1">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control admin-input auth-input-password admin-input-readonly"
                                required
                                data-msg-required="Inserisci una password iniziale per il profilo."
                                readonly
                                autocomplete="new-password"
                                placeholder="nome.cognome"
                            >
                            <button
                                type="button"
                                class="auth-toggle-password"
                                id="togglePassword"
                                aria-label="Mostra password"
                                aria-pressed="false"
                                title="Mostra o nascondi password"
                            >
                                <svg class="icon-eye" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg class="icon-eye-off d-none" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                    <line x1="2" y1="2" x2="22" y2="22"></line>
                                </svg>
                            </button>
                        </div>
                        <button
                            type="button"
                            id="btnModificaPassword"
                            class="btn btn-outline-essenza admin-action-btn text-nowrap px-3"
                        >
                            Modifica
                        </button>
                    </div>
                    <div class="form-text mt-1" id="passwordHelperText">
                        Generata automaticamente come <strong>nome.cognome</strong>. Clicca su "Modifica" per personalizzarla.
                    </div>
                </div>
            <?php }?>

            <div class="mb-3">
                <label for="ruolo" class="form-label auth-label">Ruolo nel Sistema</label>
                <?php $_smarty_tpl->assign('ruolo_corrente', (($tmp = $_smarty_tpl->getValue('ruolo_default') ?? null)===null||$tmp==='' ? 'allievo' ?? null : $tmp), false, NULL);?>
                <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>
                    <?php $_smarty_tpl->assign('ruolo_corrente', $_smarty_tpl->getValue('utente')->getRuolo(), false, NULL);?>
                <?php }?>
                <select id="ruolo" name="ruolo" class="form-select admin-select" required data-msg-required="Seleziona un ruolo dal menù a tendina.">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('ruoli_consentiti'), 'label', false, 'val');
$foreach8DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('val')->value => $_smarty_tpl->getVariable('label')->value) {
$foreach8DoElse = false;
?>
                        <option value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('val'), ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->getValue('ruolo_corrente') == $_smarty_tpl->getValue('val')) {?>selected<?php }?>><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('label'), ENT_QUOTES, 'UTF-8', true);?>
</option>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </select>
            </div>

            <?php $_smarty_tpl->assign('mostra_campi_allievo', ($_smarty_tpl->getValue('ruolo_corrente') == 'allievo'), false, NULL);?>
            <?php $_smarty_tpl->assign('mostra_campo_istruttore', ($_smarty_tpl->getValue('ruolo_corrente') == 'istruttore'), false, NULL);?>
            <div id="campi-allievo" class="row g-3 mb-4<?php if (!$_smarty_tpl->getValue('mostra_campi_allievo')) {?> d-none<?php }?>">
                <div class="col-12 col-sm-6">
                    <label for="crediti_residui" class="form-label auth-label">Crediti Residui</label>
                    <input
                        type="number"
                        id="crediti_residui"
                        name="crediti_residui"
                        class="form-control admin-input"
                        min="0"
                        data-msg-required="Inserisci il numero di crediti residui."
                        data-msg-min="I crediti residui non possono essere negativi."
                        value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo $_smarty_tpl->getValue('utente')->getCreditiResidui();
} else { ?>0<?php }?>"
                        <?php if ($_smarty_tpl->getValue('mostra_campi_allievo')) {?>required<?php } else { ?>disabled<?php }?>
                    >
                </div>

                <div class="col-12 col-sm-6">
                    <label for="scadenza_certificato" class="form-label auth-label">Scadenza Certificato Medico <span class="auth-optional">(opzionale)</span></label>
                    <input
                        type="date"
                        id="scadenza_certificato"
                        name="scadenza_certificato"
                        class="form-control admin-input"
                        value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getScadenzaCertificato(), ENT_QUOTES, 'UTF-8', true);
}?>"
                        <?php if (!$_smarty_tpl->getValue('mostra_campi_allievo')) {?>disabled<?php }?>
                    >
                    <div class="form-text mt-1">Lascia vuoto se non ancora consegnato.</div>
                </div>
            </div>

            <div id="campo-istruttore" class="mb-4<?php if (!$_smarty_tpl->getValue('mostra_campo_istruttore')) {?> d-none<?php }?>">
                <div class="mb-3">
                    <label for="immagine_profilo" class="form-label auth-label">Immagine Profilo Istruttore <span class="auth-optional">(opzionale)</span></label>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="admin-avatar-preview" id="admin-avatar-preview">
                            <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null))) && $_smarty_tpl->getValue('utente')->getImmagineProfilo()) {?>
                                <img src="/studio-essenza/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getImmagineProfilo(), ENT_QUOTES, 'UTF-8', true);?>
" alt="Immagine profilo">
                            <?php } else { ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            <?php }?>
                        </div>
                        <div class="flex-grow-1">
                            <input
                                type="file"
                                id="immagine_profilo"
                                name="immagine_profilo"
                                class="form-control admin-input"
                                accept="image/jpeg,image/png,image/webp,image/gif"
                                <?php if (!$_smarty_tpl->getValue('mostra_campo_istruttore')) {?>disabled<?php }?>
                            >
                            <div class="form-text mt-1">Formati consentiti: JPG, PNG, WEBP, GIF (max 5 MB).</div>
                            <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null))) && $_smarty_tpl->getValue('utente')->getImmagineProfilo()) {?>
                                <div class="form-check mt-2">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        value="1"
                                        id="rimuovi_immagine"
                                        name="rimuovi_immagine"
                                        <?php if (!$_smarty_tpl->getValue('mostra_campo_istruttore')) {?>disabled<?php }?>
                                    >
                                    <label class="form-check-label small text-danger" for="rimuovi_immagine">
                                        Rimuovi immagine profilo attuale
                                    </label>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tariffa_individuale" class="form-label auth-label">Tariffa Lezione Individuale (&euro;/ora) <span class="auth-optional">(opzionale)</span></label>
                    <input
                        type="number"
                        id="tariffa_individuale"
                        name="tariffa_individuale"
                        class="form-control admin-input"
                        min="1"
                        max="9999.99"
                        step="0.50"
                        data-msg-min="La tariffa individuale deve essere almeno 1 €."
                        data-msg-max="La tariffa individuale non può superare 9999,99 €."
                        placeholder="Es. 45"
                        value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null))) && $_smarty_tpl->getValue('utente')->getTariffaIndividuale() !== null) {
echo $_smarty_tpl->getValue('utente')->getTariffaIndividuale();
}?>"
                        <?php if (!$_smarty_tpl->getValue('mostra_campo_istruttore')) {?>disabled<?php }?>
                    >
                    <div class="form-text mt-1">L'istruttore potrà modificarla in autonomia dalla propria dashboard.</div>
                </div>

                <div>
                    <label for="descrizione" class="form-label auth-label">Descrizione Istruttore <span class="auth-optional">(visibile nella Home)</span></label>
                    <textarea
                        id="descrizione"
                        name="descrizione"
                        class="form-control admin-input"
                        rows="3"
                        maxlength="300"
                        placeholder="Es. Specialista in Pilates Reformer, Matwork e percorsi posturali personalizzati..."
                        <?php if (!$_smarty_tpl->getValue('mostra_campo_istruttore')) {?>disabled<?php }?>
                    ><?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getDescrizione(), ENT_QUOTES, 'UTF-8', true);
}?></textarea>
                    <div class="form-text mt-1">Breve presentazione che comparirà nel carosello degli istruttori in homepage (max 300 caratteri).</div>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-primary admin-action-btn px-4">
                    <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>Salva Modifiche<?php } else { ?>Crea Profilo<?php }?>
                </button>
                <a href="index.php?controller=<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('controller_base') ?? null)===null||$tmp==='' ? 'admin' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&action=utenti" class="btn btn-outline-essenza admin-action-btn px-4">
                    Annulla
                </a>
            </div>
        </form>
    </section>

</div>


<?php echo '<script'; ?>
>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const btnModificaPassword = document.getElementById('btnModificaPassword');
    const passwordHelperText = document.getElementById('passwordHelperText');
    const nomeInput = document.getElementById('nome');
    const cognomeInput = document.getElementById('cognome');

    if (toggleBtn && passwordInput) {
        const eyeIcon = toggleBtn.querySelector('.icon-eye');
        const eyeOffIcon = toggleBtn.querySelector('.icon-eye-off');

        toggleBtn.addEventListener('click', function () {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';

            eyeIcon.classList.toggle('d-none', isHidden);
            eyeOffIcon.classList.toggle('d-none', !isHidden);

            toggleBtn.setAttribute('aria-pressed', String(isHidden));
            toggleBtn.setAttribute('aria-label', isHidden ? 'Nascondi password' : 'Mostra password');
        });
    }

    if (passwordInput && btnModificaPassword && nomeInput && cognomeInput) {
        let modificaManuale = false;

        function pulisciPartePassword(valore) {
            return (valore || '')
                .trim()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .replace(/[^a-z0-9]/g, '');
        }

        function aggiornaPasswordAutomatica() {
            if (modificaManuale) return;
            const parteNome = pulisciPartePassword(nomeInput.value);
            const parteCognome = pulisciPartePassword(cognomeInput.value);
            if (parteNome && parteCognome) {
                passwordInput.value = parteNome + '.' + parteCognome;
            } else if (parteNome) {
                passwordInput.value = parteNome + '.';
            } else if (parteCognome) {
                passwordInput.value = '.' + parteCognome;
            } else {
                passwordInput.value = '';
            }
        }

        nomeInput.addEventListener('input', aggiornaPasswordAutomatica);
        cognomeInput.addEventListener('input', aggiornaPasswordAutomatica);

        btnModificaPassword.addEventListener('click', function () {
            modificaManuale = !modificaManuale;
            passwordInput.readOnly = !modificaManuale;
            passwordInput.classList.toggle('admin-input-readonly', !modificaManuale);

            if (modificaManuale) {
                btnModificaPassword.textContent = 'Ripristina';
                btnModificaPassword.title = 'Torna alla password automatica nome.cognome';
                if (passwordHelperText) {
                    passwordHelperText.innerHTML = 'Modalità modifica attiva. Clicca su "Ripristina" per tornare a <strong>nome.cognome</strong>.';
                }
                passwordInput.focus();
                passwordInput.select();
            } else {
                btnModificaPassword.textContent = 'Modifica';
                btnModificaPassword.title = 'Personalizza la password iniziale';
                if (passwordHelperText) {
                    passwordHelperText.innerHTML = 'Generata automaticamente come <strong>nome.cognome</strong>. Clicca su "Modifica" per personalizzarla.';
                }
                aggiornaPasswordAutomatica();
            }
        });

        aggiornaPasswordAutomatica();
    }

    const ruoloSelect = document.getElementById('ruolo');
    const campiAllievo = document.getElementById('campi-allievo');
    const campoIstruttore = document.getElementById('campo-istruttore');
    const creditiInput = document.getElementById('crediti_residui');
    const certificatoInput = document.getElementById('scadenza_certificato');
    const descrizioneInput = document.getElementById('descrizione');
    const tariffaInput = document.getElementById('tariffa_individuale');
    const immagineInput = document.getElementById('immagine_profilo');
    const rimuoviImgCheckbox = document.getElementById('rimuovi_immagine');
    const avatarPreview = document.getElementById('admin-avatar-preview');

    if (!ruoloSelect || !campiAllievo || !campoIstruttore || !creditiInput || !certificatoInput || !descrizioneInput || !immagineInput) return;

    function aggiornaCampiRuolo() {
        const isAllievo = ruoloSelect.value === 'allievo';
        const isIstruttore = ruoloSelect.value === 'istruttore';

        campiAllievo.classList.toggle('d-none', !isAllievo);
        creditiInput.disabled = !isAllievo;
        creditiInput.required = isAllievo;
        certificatoInput.disabled = !isAllievo;

        campoIstruttore.classList.toggle('d-none', !isIstruttore);
        descrizioneInput.disabled = !isIstruttore;
        immagineInput.disabled = !isIstruttore;
        if (tariffaInput) {
            tariffaInput.disabled = !isIstruttore;
        }
        if (rimuoviImgCheckbox) {
            rimuoviImgCheckbox.disabled = !isIstruttore;
        }

        if (isAllievo && creditiInput.value === '') {
            creditiInput.value = '0';
        }
    }

    immagineInput.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file || !avatarPreview) return;
        const reader = new FileReader();
        reader.onload = function (e) {
            avatarPreview.innerHTML = '<img src="' + e.target.result + '" alt="Anteprima profilo">';
        };
        reader.readAsDataURL(file);
        if (rimuoviImgCheckbox) {
            rimuoviImgCheckbox.checked = false;
        }
    });

    ruoloSelect.addEventListener('change', aggiornaCampiRuolo);
    aggiornaCampiRuolo();
});
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
