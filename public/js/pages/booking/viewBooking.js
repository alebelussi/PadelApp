//***  SCRIPT PER CREARE IL CALENDARIO ***/
document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    var eventsUrl = calendarEl.dataset.eventsUrl; //=> Prende la rotta

    //=> Crea il calendario
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        locale: 'it',
        firstDay: 1,
        slotMinTime: "08:00:00",
        slotMaxTime: "22:00:00",
        slotDuration: "00:30:00",
        allDaySlot: false,
        height: 'auto',
        events: eventsUrl,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridWeek,timeGridDay'
        },
        dayHeaderFormat: { weekday: 'long'}, //=> Mette solo il nome nell'intestazione
        titleFormat: {year: 'numeric', month: 'long', day: 'numeric'},

        eventClick: function(info) { //=> Creazione del modale della prenotazione al click
            info.jsEvent.preventDefault();
            //=> Prende gli elementi necessari
            const event = info.event;
            const players = event.extendedProps.players;
            const racketNeeded = event.extendedProps.racket_needed;
            const numberRakcet = event.extendedProps.racket_count;
            
            const list = document.getElementById('modal-info-list');
            list.querySelectorAll('.dynamic-li').forEach(el => el.remove());

            //=> Imposta il testo
            document.getElementById('modal-title').textContent = `${event.title}`;
            document.getElementById('modal-start').textContent = `Inizio: ${event.start.toLocaleString()}`;
            document.getElementById('modal-end').textContent = `Fine: ${event.end.toLocaleString()}`;
            document.getElementById('modal-players').textContent = `Numero di giocatori: ${players}`;
            document.getElementById('modal-racket').textContent = "Racchette prenotate: " + (racketNeeded ? 'Si' : 'No');

            if(racketNeeded){   //=> Se le racchette sono necessarie viene aggiunta la voce del numero
                const li = document.createElement('li');
                li.textContent = 'Numero di racchette: ' + numberRakcet;
                li.classList.add('dynamic-li');
                list.appendChild(li);
            }
                
            //=> Passaggio dell'id per la rimozione
            const deleteForm = document.querySelector('#eventModal form');  
            deleteForm.action = '/booking/delete/' + event.id;

            const modal = new bootstrap.Modal(document.getElementById('eventModal'));
            modal.show();
        }
    });

    calendar.render(); //=> Mostra il calendario
});