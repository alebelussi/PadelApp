//*** GESTIONE DELLE ALTEZZE DELLE CARD DELLA VIEW COMPLEX ***/
document.addEventListener('DOMContentLoaded', () => {
// prendi tutte le colonne (card) della riga principale
const columns = document.querySelectorAll('.col-md-4');

// se non ci sono colonne o sono poche, esci
if (columns.length === 0) return;

// conta quante righe di campo ha la prima card
const fieldCount = columns[0].querySelectorAll('.field-row').length;

for (let i = 0; i < fieldCount; i++) {
    let maxHeight = 0;
    const fields = [];

    // per ogni colonna prendi la i-esima riga
    columns.forEach(col => {
    const field = col.querySelectorAll('.field-row')[i];
    if (field) {
        fields.push(field);
        field.style.height = 'auto'; // reset altezza
        if (field.offsetHeight > maxHeight) {
        maxHeight = field.offsetHeight;
        }
    }
    });

    // assegna altezza massima a tutte le righe di indice i
    fields.forEach(field => {
    field.style.height = maxHeight + 'px';
    });
}
});
