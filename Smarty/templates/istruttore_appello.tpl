<!-- File: Smarty/templates/istruttore_appello.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container my-4" style="max-width: 920px;">

    <div class="bg-white rounded-3 shadow-sm p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="h4 mb-1" style="color: #7b8b6f;">Registro Appello</h1>
            <p class="text-muted mb-0">
                <strong>{$lezione.nome_corso}</strong> &bull; {$lezione.data} ({$lezione.orario}) &bull;
                Posti occupati: <strong>{$iscritti|count} / {$lezione.capienza_max}</strong>
            </p>
        </div>
        <a href="index.php?controller=istruttore&action=dashboard" class="btn btn-secondary">&larr; Torna alla Dashboard</a>
    </div>

    <div class="bg-white rounded-3 shadow-sm p-4">
        {if empty($iscritti)}
            <p class="text-muted mb-0">Nessun allievo risulta prenotato per questo corso.</p>
        {else}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Allievo</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Certificato Medico</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $iscritti as $allievo}
                            <tr>
                                <td>{$allievo@iteration}</td>
                                <td><strong>{$allievo.cognome} {$allievo.nome}</strong></td>
                                <td>{$allievo.telefono|default:'-'}</td>
                                <td>{$allievo.email}</td>
                                <td>
                                    {if $allievo.certificato_valido}
                                        <span class="badge bg-success">Valido</span>
                                    {else}
                                        <span class="badge bg-danger">Scaduto / Non valido</span>
                                    {/if}
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        {/if}
    </div>

</div>
{/block}