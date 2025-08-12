/***  SCRIPT PER LA GESTIONE DELLE PRENOTAZIONI E DEI CONTROLLI FRONT END ***/

document.addEventListener('DOMContentLoaded', function () {
    const dayInput = document.getElementById('inputDay');   //=> Prende il giorno dall'input
    const startTimeSelect = document.getElementById('selectStartTime'); //=> Prende l'orario dall'input

    const daysMap = {
        sunday: 0,
        monday: 1,
        tuesday: 2,
        wednesday: 3,
        thursday: 4,
        friday: 5,
        saturday: 6
    };

    //=> Recupera i giorni chiusi (closed) dalla configurazione openingHours
    const closedDays = Object.entries(openingHours)
        .filter(([day, value]) => value === 'closed')
        .map(([day]) => daysMap[day]);

    //=> Funzione per generare gli slot orari tra start e end con intervallo in minuti
    function generateTimeSlots(start, end, intervalMinutes) {
        const times = [];
        const [startH, startM] = start.split(':').map(Number);
        const [endH, endM] = end.split(':').map(Number);

        //=> Arrotondo al multiplo di 30 più vicino per evitare di generare orari "particolari"
        let roundedStartMinutes = startM <= 30 ? (startM > 0 ? 30 : 0) : 0;
        let roundedStartHours = startH + (startM > 30 ? 1 : 0);

        let current = new Date(1970, 0, 1, roundedStartHours, roundedStartMinutes);
        const endTime = new Date(1970, 0, 1, endH, endM);

        while (true) {
            const next = new Date(current.getTime() + intervalMinutes * 60000);
            
            if(next > endTime)
                break;

            const h = current.getHours().toString().padStart(2, '0');
            const m = current.getMinutes().toString().padStart(2, '0');
            times.push(`${h}:${m}`);

            current = next
        }

        return times;
    }

    //=> Funzione per formattare una data in YYYY-MM-DD locale
    function formatDateLocal(date) {
        const y = date.getFullYear();
        const m = (date.getMonth() + 1).toString().padStart(2, '0');
        const d = date.getDate().toString().padStart(2, '0');
        return `${y}-${m}-${d}`;
    }

    //=> Controlla se un giorno è completamente prenotato (nessuno slot disponibile)
    function isFullyBooked(date) {
        const dayName = date.toLocaleDateString('en-US', { weekday: 'long' }).toLowerCase();
        const dateStr = formatDateLocal(date);

        const timeRange = openingHours[dayName];
        if (!timeRange || timeRange === 'closed') return true;

        const [start, end] = timeRange.split('-');
        const allTimeSlots = generateTimeSlots(start, end, 90);

        //=> Filtra prenotazioni per la data corrente
        const bookedTimes = bookings
            .filter(b => {
                const bookingDate = new Date(b.start);
                return formatDateLocal(bookingDate) === dateStr;
            })
            .map(b => b.start.slice(11, 16)); //=> Prendi solo l'orario HH:mm

        //=> Filtra gli slot disponibili (non prenotati)
        let availableSlots = allTimeSlots.filter(t => !bookedTimes.includes(t));

        //=> Se la data è oggi, rimuove gli orari già passati
        const now = new Date();
        if (dateStr === formatDateLocal(now)) {
            const currentMinutes = now.getHours() * 60 + now.getMinutes();
            availableSlots = availableSlots.filter(time => {
                const [h, m] = time.split(':').map(Number);
                return (h * 60 + m) > currentMinutes;
            });
        }

        return availableSlots.length === 0;
    }

    //=> Inizializza flatpickr con restrizioni e callback
    flatpickr(dayInput, {
        minDate: "today",
        dateFormat: "Y-m-d",
        disable: [
            function(date) {
                //=> Disabilita i giorni chiusi e quelli completamente prenotati
                return closedDays.includes(date.getDay()) || isFullyBooked(date);
            }
        ],
        onChange: function(selectedDates, dateStr) {
            startTimeSelect.innerHTML = '<option value="">Seleziona un orario</option>';
            if (!dateStr) return;

            const selectedDate = new Date(dateStr);
            const weekday = selectedDate.toLocaleDateString('en-US', { weekday: 'long' }).toLowerCase();

            const timeRange = openingHours[weekday];
            if (!timeRange || timeRange === 'closed') return;

            const [start, end] = timeRange.split('-');
            const allTimeSlots = generateTimeSlots(start, end, 90);

            //=> Filtra le prenotazioni per il giorno selezionato
            const bookedTimes = bookings
                .filter(b => b.start.startsWith(dateStr))
                .map(b => b.start.slice(11, 16));

            //=> Filtra gli slot orari disponibili
            let availableSlots = allTimeSlots.filter(t => !bookedTimes.includes(t));

            //=> Se la data è oggi, elimina gli orari già passati
            const now = new Date();
            if (dateStr === formatDateLocal(now)) {
                const currentMinutes = now.getHours() * 60 + now.getMinutes();
                availableSlots = availableSlots.filter(time => {
                    const [h, m] = time.split(':').map(Number);
                    return (h * 60 + m) > currentMinutes;
                });
            }

            //=> Crea gli option per gli orari disponibili
            availableSlots.forEach(time => {
                const opt = document.createElement('option');
                opt.value = time;
                opt.textContent = time;
                startTimeSelect.appendChild(opt);
            });
        }
    });

    //=> Gestione del numero di racchette
    const numberOfPlayer = document.getElementById('selectNumberOfPlayer');
    const racketNeededSelect = document.getElementById('selectedRacketNeeded');
    const racketCountContainer = document.getElementById('racketCountContainer');
    const racketCountSelect = document.getElementById('racketCount');

    function updateRacketCountOptions() {
        const players = parseInt(numberOfPlayer.value);
        racketCountSelect.innerHTML = ''; //=> Per resettare le opzioni

        if(!players || players < 1) {
            racketCountContainer.classList.add('d-none');
            racketCountSelect.removeAttribute('required');
            return
        }

        for(let i = 1; i <= players; i++){  //=> Crea le diverse opzioni e le aggiunge al select
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i; 
            racketCountSelect.appendChild(option);
        }

        racketCountSelect.setAttribute('required', 'required'); //=> Aggiunge required
        racketCountContainer.classList.remove('d-none');    //=> Toglie display none
    }

    racketNeededSelect.addEventListener('change', () => {
        if(racketNeededSelect.value === '1') 
            updateRacketCountOptions();
        else {
            racketCountContainer.classList.add('d-none');
            racketCountSelect.removeAttribute('required');
            racketCountSelect.innerHTML = '';
        }
    });

    numberOfPlayer.addEventListener('change', () => {
        if (racketNeededSelect.value === '1') {
            updateRacketCountOptions();
        }
    });

});
