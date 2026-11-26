/* File: js/form-validation.js
 * Gestione unificata degli avvisi custom di validazione per tutti i form di Studio Essenza.
 * Sostituisce i tooltip nativi del browser con messaggi inline coerenti allo stile del sito.
 */
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    var SVG_ALERT_ICON =
        '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" ' +
        'fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" ' +
        'stroke-linejoin="round" aria-hidden="true">' +
        '<circle cx="12" cy="12" r="10"></circle>' +
        '<line x1="12" y1="8" x2="12" y2="12"></line>' +
        '<line x1="12" y1="16" x2="12.01" y2="16"></line>' +
        '</svg>';

    function isControlloVisibile(el) {
        if (el.disabled) return false;
        if (el.type === 'hidden') return false;
        if (el.closest('.d-none')) return false;
        return true;
    }

    function getLabelTesto(el) {
        if (el.id) {
            var label = document.querySelector('label[for="' + el.id + '"]');
            if (label) {
                var clone = label.cloneNode(true);
                clone.querySelectorAll('.auth-optional').forEach(function (n) { n.remove(); });
                var testo = (clone.textContent || '').replace(/\s+/g, ' ').replace(/\*$/, '').trim();
                if (testo) return testo;
            }
        }
        return '';
    }

    function getContenitoreErrore(el) {
        var wrapper = el.closest('.auth-input-group, .input-group');
        return wrapper || el;
    }

    function rimuoviErroreCampo(el) {
        el.classList.remove('essenza-invalid');
        el.removeAttribute('aria-invalid');
        var anchor = getContenitoreErrore(el);
        var next = anchor.nextElementSibling;
        if (next && next.classList.contains('essenza-field-error')) {
            next.remove();
        }
    }

    function mostraErroreCampo(el, messaggio) {
        rimuoviErroreCampo(el);
        el.classList.add('essenza-invalid');
        el.setAttribute('aria-invalid', 'true');

        var box = document.createElement('div');
        box.className = 'essenza-field-error';
        box.setAttribute('role', 'alert');

        var iconWrap = document.createElement('span');
        iconWrap.className = 'essenza-field-error-icon';
        iconWrap.innerHTML = SVG_ALERT_ICON;

        var textSpan = document.createElement('span');
        textSpan.textContent = messaggio;

        box.appendChild(iconWrap);
        box.appendChild(textSpan);

        var anchor = getContenitoreErrore(el);
        anchor.insertAdjacentElement('afterend', box);
    }

    function calcolaMessaggioErrore(el, form) {
        var tag = el.tagName.toLowerCase();
        var type = (el.type || '').toLowerCase();
        var val = typeof el.value === 'string' ? el.value : '';
        var trimmed = val.trim();
        var label = getLabelTesto(el);

        // 1. Campo obbligatorio vuoto (inclusi solo spazi su testo/textarea o file non scelto)
        var isVuoto = false;
        if (el.required) {
            if (type === 'file') {
                isVuoto = !el.files || el.files.length === 0;
            } else if (type === 'checkbox' || type === 'radio') {
                isVuoto = !el.checked;
            } else if (tag === 'select') {
                isVuoto = val === '';
            } else {
                isVuoto = trimmed === '';
            }
        }

        if (isVuoto) {
            if (el.dataset.msgRequired) return el.dataset.msgRequired;
            if (tag === 'select') {
                return label
                    ? 'Seleziona un\'opzione per "' + label + '" dal menù a tendina.'
                    : 'Seleziona un\'opzione dal menù a tendina.';
            }
            if (type === 'file') {
                return 'Seleziona un file dal tuo dispositivo prima di continuare.';
            }
            return label
                ? 'Il campo "' + label + '" è obbligatorio.'
                : 'Compila questo campo obbligatorio.';
        }

        // Se il campo è opzionale e vuoto, non segnalare errori di formato
        if (!el.required && trimmed === '' && type !== 'file') {
            return '';
        }

        // 2. Controllo formato email
        if (type === 'email' && (el.validity.typeMismatch || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(trimmed))) {
            return el.dataset.msgType || 'Inserisci un indirizzo email valido (es. nome@esempio.it).';
        }

        // 3. Controllo lunghezza minima
        if (el.validity.tooShort || (el.minLength > 0 && val.length < el.minLength)) {
            return el.dataset.msgMinlength || ('Inserisci almeno ' + el.minLength + ' caratteri.');
        }

        // 4. Controllo valore numerico / data non valido o fuori range
        if (el.validity.badInput) {
            return el.dataset.msgBadInput || 'Inserisci un valore valido.';
        }
        if (el.validity.rangeUnderflow) {
            if (el.dataset.msgMin) return el.dataset.msgMin;
            if (type === 'date' || type === 'datetime-local') {
                return 'La data selezionata non può essere precedente al minimo consentito.';
            }
            return 'Il valore inserito deve essere almeno ' + el.min + '.';
        }
        if (el.validity.rangeOverflow) {
            if (el.dataset.msgMax) return el.dataset.msgMax;
            return 'Il valore inserito non può superare ' + el.max + '.';
        }
        if (el.validity.stepMismatch && type === 'number') {
            return el.dataset.msgStep || 'Inserisci un importo valido.';
        }

        // 5. Controllo corrispondenza tra campi (es. conferma password)
        if (el.dataset.matchTarget) {
            var target = form.querySelector('#' + el.dataset.matchTarget);
            if (target && target.value !== val) {
                return el.dataset.msgMatch || 'I valori inseriti non coincidono.';
            }
        }

        // 6. Controllo maggiore di altro campo numerico/select (es. ora_fine > ora_inizio)
        if (el.dataset.gtTarget) {
            var startEl = form.querySelector('#' + el.dataset.gtTarget);
            if (startEl && Number(val) <= Number(startEl.value)) {
                return el.dataset.msgGt || 'Il valore di fine deve essere successivo a quello di inizio.';
            }
        }

        return '';
    }

    document.querySelectorAll('form').forEach(function (form) {
        if (form.dataset.noCustomValidation === 'true') return;

        var campi = Array.from(form.querySelectorAll('input, select, textarea')).filter(function (el) {
            return el.type !== 'hidden' && el.type !== 'submit' && el.type !== 'button' && el.type !== 'reset';
        });

        // Ignora form composti solo da campi nascosti e pulsanti di azione
        if (campi.length === 0) return;

        // Disattiva i tooltip nativi del browser solo quando il nostro validatore JS è attivo
        form.setAttribute('novalidate', 'novalidate');

        campi.forEach(function (el) {
            var evento = (el.tagName.toLowerCase() === 'select' || el.type === 'file' || el.type === 'date' || el.type === 'datetime-local')
                ? 'change'
                : 'input';

            el.addEventListener(evento, function () {
                if (el.classList.contains('essenza-invalid')) {
                    var err = calcolaMessaggioErrore(el, form);
                    if (!err) {
                        rimuoviErroreCampo(el);
                    } else {
                        mostraErroreCampo(el, err);
                    }
                }
                // Se un campo è il target di un altro campo (es. nuova_password o ora_inizio), rivalida il campo dipendente
                if (el.id) {
                    form.querySelectorAll('[data-match-target="' + el.id + '"], [data-gt-target="' + el.id + '"]').forEach(function (dep) {
                        if (dep.classList.contains('essenza-invalid')) {
                            var depErr = calcolaMessaggioErrore(dep, form);
                            if (!depErr) {
                                rimuoviErroreCampo(dep);
                            } else {
                                mostraErroreCampo(dep, depErr);
                            }
                        }
                    });
                }
            });
        });

        form.addEventListener('submit', function (event) {
            var primoInvalido = null;

            campi.forEach(function (el) {
                if (!isControlloVisibile(el)) {
                    rimuoviErroreCampo(el);
                    return;
                }
                var errore = calcolaMessaggioErrore(el, form);
                if (errore) {
                    mostraErroreCampo(el, errore);
                    if (!primoInvalido) {
                        primoInvalido = el;
                    }
                } else {
                    rimuoviErroreCampo(el);
                }
            });

            if (primoInvalido) {
                event.preventDefault();
                event.stopImmediatePropagation();
                primoInvalido.focus();
                if (typeof primoInvalido.scrollIntoView === 'function') {
                    primoInvalido.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    });
});
