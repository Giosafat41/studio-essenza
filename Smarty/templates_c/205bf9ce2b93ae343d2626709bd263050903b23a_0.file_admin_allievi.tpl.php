<?php
/* Smarty version 5.8.5, created on 2026-11-26 17:32:30
  from 'file:admin_allievi.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b085f1e5a6087_99423066',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '205bf9ce2b93ae343d2626709bd263050903b23a' => 
    array (
      0 => 'admin_allievi.tpl',
      1 => 1795710681,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b085f1e5a6087_99423066 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_allievi.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7810770606b085f1e540598_10877897', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_7810770606b085f1e540598_10877897 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container admin-wide-page py-2 py-md-3">

    <!-- Link ritorno al Pannello Admin -->
    <div class="mb-3">
        <a href="index.php?controller=admin&action=dashboard" class="calendar-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Torna al Pannello Admin</span>
        </a>
    </div>

    <!-- Intestazione -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Amministrazione</span>
                <h1 class="dashboard-title">Elenco Allievi</h1>
                <p class="dashboard-subtitle">
                    Consulta l'anagrafica completa di tutti gli allievi iscritti a Studio Essenza e visualizza le informazioni dettagliate di ciascun profilo.
                </p>
            </div>
            <div class="calendar-status-group">
                <div class="calendar-crediti-pill">
                    <span class="calendar-crediti-label">Allievi iscritti</span>
                    <div class="calendar-crediti-valore">
                        <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('allievi'));?>

                        <small><?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('allievi')) == 1) {?>allievo<?php } else { ?>allievi<?php }?></small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabella Allievi -->
    <section class="dashboard-card">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <h2 class="dashboard-section-title">Tutti gli Allievi</h2>
                <span class="dashboard-count-badge" id="allieviCountBadge">
                    <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('allievi'));?>
 <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('allievi')) == 1) {?>allievo<?php } else { ?>allievi<?php }?>
                </span>
            </div>

            <?php if (!( !$_smarty_tpl->hasVariable('allievi') || empty($_smarty_tpl->getValue('allievi')))) {?>
                <div style="min-width: 260px;">
                    <input
                        type="search"
                        id="cercaAllievo"
                        class="form-control admin-input"
                        placeholder="Cerca per nome, cognome o email..."
                        aria-label="Cerca allievo"
                    >
                </div>
            <?php }?>
        </div>

        <?php if (( !$_smarty_tpl->hasVariable('allievi') || empty($_smarty_tpl->getValue('allievi')))) {?>
            <div class="dashboard-empty">
                <p class="dashboard-empty-title">Nessun allievo registrato</p>
                <p class="dashboard-empty-text">Non risultano ancora allievi iscritti nel sistema.</p>
            </div>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0" id="tabellaAllievi">
                    <thead>
                        <tr>
                            <th>Nome e Cognome</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Data di nascita</th>
                            <th>Crediti</th>
                            <th>Certificato Medico</th>
                            <th class="text-end">Informazioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allievi'), 'a');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('a')->value) {
$foreach0DoElse = false;
?>
                            <tr class="js-riga-allievo" data-search="<?php echo htmlspecialchars((string)mb_strtolower((string) $_smarty_tpl->getValue('a')['cognome'], 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)mb_strtolower((string) $_smarty_tpl->getValue('a')['nome'], 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)mb_strtolower((string) $_smarty_tpl->getValue('a')['email'], 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
">
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="admin-avatar-sm">
                                            <?php if (!( !true || empty($_smarty_tpl->getValue('a')['immagine_profilo']))) {?>
                                                <img src="/studio-essenza/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('a')['immagine_profilo'], ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('a')['nome'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('a')['cognome'], ENT_QUOTES, 'UTF-8', true);?>
">
                                            <?php } else { ?>
                                                <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('a')['iniziali'], ENT_QUOTES, 'UTF-8', true);?>

                                            <?php }?>
                                        </span>
                                        <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('a')['cognome'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('a')['nome'], ENT_QUOTES, 'UTF-8', true);?>
</strong>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('a')['email'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('a')['telefono'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('a')['data_nascita'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td><strong><?php echo $_smarty_tpl->getValue('a')['crediti_residui'];?>
</strong></td>
                                <td>
                                    <?php if (!( !true || empty($_smarty_tpl->getValue('a')['scadenza_certificato']))) {?>
                                        <?php if ($_smarty_tpl->getValue('a')['certificato_valido']) {?>
                                            <span class="dashboard-status-pill is-confirmed">
                                                <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('a')['scadenza_certificato'], ENT_QUOTES, 'UTF-8', true);?>

                                            </span>
                                        <?php } else { ?>
                                            <span class="dashboard-status-pill is-cancelled">
                                                Scaduto (<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('a')['scadenza_certificato'], ENT_QUOTES, 'UTF-8', true);?>
)
                                            </span>
                                        <?php }?>
                                    <?php } else { ?>
                                        <span class="text-muted small">Non presente</span>
                                    <?php }?>
                                </td>
                                <td class="text-end text-nowrap">
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-essenza js-apri-dettaglio-allievo"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDettaglioAllievo"
                                        data-allievo-id="<?php echo $_smarty_tpl->getValue('a')['id'];?>
"
                                    >
                                        Dettagli
                                    </button>
                                </td>
                            </tr>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
            <div id="nessunRisultatoRicerca" class="dashboard-empty mt-3 d-none">
                <p class="dashboard-empty-title">Nessun allievo trovato</p>
                <p class="dashboard-empty-text">Prova a modificare i termini di ricerca.</p>
            </div>
        <?php }?>
    </section>

</div>

<!-- MODALE SCHEDA DETTAGLIO ALLIEVO -->
<div class="modal fade" id="modalDettaglioAllievo" tabindex="-1" aria-labelledby="modalDettaglioAllievoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-semibold" id="modalDettaglioAllievoLabel" style="color: #4a4a4a;">Scheda Allievo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex align-items-center gap-3 pb-3 mb-3 border-bottom">
                    <div class="profile-avatar" id="detAllievoAvatar"></div>
                    <div>
                        <h3 class="h5 fw-bold mb-1" id="detAllievoNome" style="color: #4a4a4a;"></h3>
                        <span class="admin-role-pill is-allievo">Allievo</span>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-12 col-sm-6">
                        <div class="p-3 rounded-3" style="background-color: #faf9f7; border: 1px solid #eceae4;">
                            <div class="text-muted small text-uppercase mb-1">Email</div>
                            <div class="fw-semibold" id="detAllievoEmail"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="p-3 rounded-3" style="background-color: #faf9f7; border: 1px solid #eceae4;">
                            <div class="text-muted small text-uppercase mb-1">Telefono</div>
                            <div class="fw-semibold" id="detAllievoTelefono"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="p-3 rounded-3" style="background-color: #faf9f7; border: 1px solid #eceae4;">
                            <div class="text-muted small text-uppercase mb-1">Data di nascita</div>
                            <div class="fw-semibold" id="detAllievoNascita"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="p-3 rounded-3" style="background-color: #faf9f7; border: 1px solid #eceae4;">
                            <div class="text-muted small text-uppercase mb-1">Data di registrazione</div>
                            <div class="fw-semibold" id="detAllievoRegistrazione"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="p-3 rounded-3" style="background-color: #f7f8f5; border: 1px solid rgba(123, 139, 111, 0.2);">
                            <div class="text-muted small text-uppercase mb-1">Crediti residui</div>
                            <div class="fw-bold fs-5" style="color: #7b8b6f;" id="detAllievoCrediti"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="p-3 rounded-3" style="background-color: #faf9f7; border: 1px solid #eceae4;">
                            <div class="text-muted small text-uppercase mb-1">Certificato medico</div>
                            <div id="detAllievoCertificato"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="p-3 rounded-3" style="background-color: #faf9f7; border: 1px solid #eceae4;">
                            <div class="text-muted small text-uppercase mb-1">Stato password</div>
                            <div class="fw-semibold small" id="detAllievoPassword"></div>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <h4 class="h6 fw-semibold mb-2" style="color: #5f6e54;">Corsi di gruppo prenotati</h4>
                        <div id="detAllievoGruppo" class="small text-muted"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <h4 class="h6 fw-semibold mb-2" style="color: #5f6e54;">Lezioni individuali prenotate</h4>
                        <div id="detAllievoIndividuali" class="small text-muted"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-outline-essenza" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
 id="dati-dettagli-allievi" type="application/json"><?php echo $_smarty_tpl->getValue('allievi_json');
echo '</script'; ?>
>


<?php echo '<script'; ?>
>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Ricerca rapida nella tabella allievi
    const inputRicerca = document.getElementById('cercaAllievo');
    const righe = Array.from(document.querySelectorAll('.js-riga-allievo'));
    const badgeCount = document.getElementById('allieviCountBadge');
    const msgVuoto = document.getElementById('nessunRisultatoRicerca');

    if (inputRicerca && righe.length > 0) {
        inputRicerca.addEventListener('input', function () {
            const q = this.value.trim().toLowerCase();
            let visibili = 0;
            righe.forEach(function (tr) {
                const match = !q || (tr.getAttribute('data-search') || '').indexOf(q) !== -1;
                tr.classList.toggle('d-none', !match);
                if (match) visibili++;
            });
            if (badgeCount) {
                badgeCount.textContent = visibili + (visibili === 1 ? ' allievo' : ' allievi');
            }
            if (msgVuoto) {
                msgVuoto.classList.toggle('d-none', visibili > 0);
            }
        });
    }

    // 2. Popolamento modale scheda completa allievo
    const jsonEl = document.getElementById('dati-dettagli-allievi');
    const datiAllievi = jsonEl ? JSON.parse(jsonEl.textContent || '{}') : {};
    const modalEl = document.getElementById('modalDettaglioAllievo');

    if (modalEl) {
        modalEl.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;
            if (!btn) return;
            const id = btn.getAttribute('data-allievo-id');
            const a = datiAllievi[id];
            if (!a) return;

            const avatar = document.getElementById('detAllievoAvatar');
            avatar.textContent = '';
            if (a.immagine_profilo) {
                const img = document.createElement('img');
                img.src = '/studio-essenza/' + a.immagine_profilo;
                img.alt = a.nome + ' ' + a.cognome;
                avatar.appendChild(img);
            } else {
                avatar.textContent = a.iniziali || '';
            }

            document.getElementById('detAllievoNome').textContent = a.cognome + ' ' + a.nome;
            document.getElementById('detAllievoEmail').textContent = a.email || '-';
            document.getElementById('detAllievoTelefono').textContent = a.telefono || 'Non inserito';
            document.getElementById('detAllievoNascita').textContent = a.data_nascita
                ? (a.eta !== null ? a.data_nascita + ' (' + a.eta + ' anni)' : a.data_nascita)
                : 'Non inserita';
            document.getElementById('detAllievoRegistrazione').textContent = a.data_registrazione || '-';
            document.getElementById('detAllievoCrediti').textContent = a.crediti_residui + (a.crediti_residui === 1 ? ' ingresso' : ' ingressi');

            const certBox = document.getElementById('detAllievoCertificato');
            certBox.textContent = '';
            if (a.scadenza_certificato) {
                const pill = document.createElement('span');
                pill.className = 'dashboard-status-pill ' + (a.certificato_valido ? 'is-confirmed' : 'is-cancelled');
                pill.textContent = a.certificato_valido
                    ? 'Valido fino al ' + a.scadenza_certificato
                    : 'Scaduto (' + a.scadenza_certificato + ')';
                certBox.appendChild(pill);
            } else {
                const span = document.createElement('span');
                span.className = 'text-muted small';
                span.textContent = 'Non presente';
                certBox.appendChild(span);
            }

            document.getElementById('detAllievoPassword').textContent = a.deve_cambiare_password
                ? 'Password iniziale (da cambiare)'
                : 'Password personale attiva';

            const gruppoBox = document.getElementById('detAllievoGruppo');
            gruppoBox.textContent = '';
            if (a.prenotazioni_gruppo && a.prenotazioni_gruppo.length > 0) {
                const ul = document.createElement('ul');
                ul.className = 'list-unstyled mb-0 d-flex flex-column gap-1';
                a.prenotazioni_gruppo.forEach(function (g) {
                    const li = document.createElement('li');
                    li.className = 'p-2 rounded-2';
                    li.style.backgroundColor = '#faf9f7';
                    li.style.border = '1px solid #eceae4';
                    const strong = document.createElement('strong');
                    strong.textContent = g.corso;
                    li.appendChild(strong);
                    li.appendChild(document.createTextNode(' — ' + g.data_ora));
                    ul.appendChild(li);
                });
                gruppoBox.appendChild(ul);
            } else {
                gruppoBox.textContent = 'Nessun corso di gruppo in programma.';
            }

            const indBox = document.getElementById('detAllievoIndividuali');
            indBox.textContent = '';
            if (a.lezioni_individuali && a.lezioni_individuali.length > 0) {
                const ul = document.createElement('ul');
                ul.className = 'list-unstyled mb-0 d-flex flex-column gap-1';
                a.lezioni_individuali.forEach(function (ind) {
                    const li = document.createElement('li');
                    li.className = 'p-2 rounded-2';
                    li.style.backgroundColor = '#faf9f7';
                    li.style.border = '1px solid #eceae4';
                    const strong = document.createElement('strong');
                    strong.textContent = ind.istruttore;
                    li.appendChild(strong);
                    li.appendChild(document.createTextNode(' — ' + ind.data_ora));
                    ul.appendChild(li);
                });
                indBox.appendChild(ul);
            } else {
                indBox.textContent = 'Nessuna lezione individuale in programma.';
            }
        });
    }
});
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
