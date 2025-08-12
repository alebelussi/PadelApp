/*** SCRIPT PER GESTIRE GLI INPUT DEGLI ORARI DELLE STRUTTURE ***/

document.querySelectorAll('.toggle-closed').forEach(toggle => {
    toggle.addEventListener('change', function () { //=> Al cambiamento
        const card = this.closest('.card'); //=> Prende la card
        const openInput = card.querySelector('.open-time'); //=> Prende l'input
        const closeInput = card.querySelector('.close-time'); //=> Prende l'input
        const cardBoyd = card.querySelector('.card-body');  //=> Prende il body della card

        const disabled = this.checked; 

        //=> Disattiva l'input
        openInput.disabled = disabled;  
        closeInput.disabled = disabled;

        if(disabled){   
            cardBoyd.classList.add('card-body-closed');  //=> Aggiunge la classe
            card.classList.add('closed-full'); //=> Aggiunge la classe
        }
        else {
            cardBoyd.classList.remove('card-body-closed'); //=> Rimuove la classe
            card.classList.remove('closed-full'); //=> Rimuove la classe
        }
            
    });
});

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toggle-closed').forEach(toggle => {
        const card = toggle.closest('.card');
        const body = card.querySelector('.card-body');
        const openInput = card.querySelector('.open-time');
        const closeInput = card.querySelector('.close-time');

        if (toggle.checked) {
            body.classList.add('card-body-closed');
            card.classList.add('closed-full');

            //=> Disabilita input e svuota valori
            openInput.disabled = true;
            closeInput.disabled = true;
        } else {
            body.classList.remove('card-body-closed');
            card.classList.remove('closed-full');

            openInput.disabled = false;
            closeInput.disabled = false;
        }
    });

    //=> AGGIORNAMENTO DELLA LABEL DELL'HEADER CARD
    const switches = document.querySelectorAll('.toggle-closed');   //=> Prende l'elemento

    switches.forEach(sw => {
        sw.addEventListener('change', function () {
            const label = sw.closest('.form-check').querySelector('label'); //=> Prende la label
            if(sw.checked)
                label.textContent = 'Chiuso';   //=> Imposta il valore a Chiuso
            else
                label.textContent = 'Aperto';   //=> Imposta il valore ad Aperto
        })
    });
});