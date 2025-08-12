document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form.auth-content');
  const termsCheckbox = form.terms;

  // Limite data massima per nascita = oggi (per input date)
  const todayStr = new Date().toISOString().split('T')[0];
  form.birth_date.setAttribute('max', todayStr);

  // Funzioni di validazione
  const validators = {
    name: val => /^[a-zA-ZÀ-ÿ\s'-]+$/.test(val.trim()),
    surname: val => /^[a-zA-ZÀ-ÿ\s'-]+$/.test(val.trim()),
    birth_date: val => {
      const date = new Date(val);
      const now = new Date();
      return val && date instanceof Date && !isNaN(date) && date <= now;
    },
    gender: val => ['male', 'female', 'other'].includes(val),
    phone: val => /^\+?[0-9\s\-]{6,15}$/.test(val.trim()),
    tax_code: val => /^[A-Za-z0-9]{16}$/.test(val.trim()),
    email: val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val.trim()),
    password: val => val.length >= 8,
    password_confirmation: (val, form) => val === form.password.value,
    terms: val => val === true,
  };

  // Funzione per mostrare o aggiornare errore sotto un campo
  function setFieldError(field, message) {
    const input = form[field];
    let errorDiv = input.nextElementSibling;
    if (!errorDiv || !errorDiv.classList.contains('js-error-' + field)) {
      errorDiv = document.createElement('div');
      errorDiv.classList.add('js-error-' + field, 'invalid-feedback', 'd-block');
      input.parentNode.appendChild(errorDiv);
    }
    errorDiv.textContent = message;
  }

  // Rimuove errore da un campo
  function clearFieldError(field) {
    const input = form[field];
    const errorDiv = input.nextElementSibling;
    if (errorDiv && errorDiv.classList.contains('js-error-' + field)) {
      errorDiv.remove();
    }
  }

  // Controllo in tempo reale per ogni campo importante
  const realtimeFields = ['name', 'surname', 'birth_date', 'gender', 'phone', 'tax_code', 'email', 'password', 'password_confirmation'];

  realtimeFields.forEach(field => {
    const input = form[field];
    if (!input) return;

    const eventType = (field === 'gender' || field === 'birth_date') ? 'change' : 'input';

    input.addEventListener(eventType, () => {
      let valid;

      if(field === 'password_confirmation'){
        valid = validators[field](input.value, form);
      } else {
        valid = validators[field](input.value);
      }

      if (!valid) {
        // Messaggi personalizzati per ogni campo
        const messages = {
          name: "Nome non valido (solo lettere, spazi, apostrofi e trattini)",
          surname: "Cognome non valido (solo lettere, spazi, apostrofi e trattini)",
          birth_date: "Data di nascita non valida o futura",
          gender: "Seleziona un genere valido",
          phone: "Il numero di telefono può contenere solo cifre, +, - e spazi (minimo 6 cifre)",
          tax_code: "Codice fiscale non valido (16 caratteri alfanumerici)",
          email: "Email non valida",
          password: "La password deve contenere almeno 8 caratteri",
          password_confirmation: "Le password non corrispondono"
        };

        setFieldError(field, messages[field]);
        termsCheckbox.checked = false;
        termsCheckbox.disabled = true;
      } else {
        clearFieldError(field);

        // Rivediamo se possiamo riabilitare checkbox (controlla tutti i campi)
        const allValid = realtimeFields.every(fld => {
          if(fld === 'password_confirmation'){
            return validators[fld](form[fld].value, form);
          }
          return validators[fld](form[fld].value);
        });
        termsCheckbox.disabled = !allValid;
      }
    });
  });

  // Speciale validazione iniziale telefono per bloccare lettere subito
  form.phone.addEventListener('input', () => {
    if (!/^[0-9+\-\s]*$/.test(form.phone.value)) {
      setFieldError('phone', 'Il numero di telefono può contenere solo cifre, +, - e spazi');
      termsCheckbox.checked = false;
      termsCheckbox.disabled = true;
    }
  });

  // Validazione checkbox termini non permette submit se non è spuntato
  termsCheckbox.addEventListener('change', () => {
    if (!termsCheckbox.checked) {
      // Se termini non accettati, blocca submit
      termsCheckbox.setCustomValidity('Devi accettare i termini e la privacy');
    } else {
      termsCheckbox.setCustomValidity('');
    }
  });

  // Validazione finale sul submit (per sicurezza)
  form.addEventListener('submit', (e) => {
    const errors = [];

    realtimeFields.forEach(field => {
      let valid;
      if(field === 'password_confirmation'){
        valid = validators[field](form[field].value, form);
      } else {
        valid = validators[field](form[field].value);
      }

      if (!valid) {
        errors.push(field);
        setFieldError(field, `Valore non valido nel campo ${field}`);
      }
    });

    if (!termsCheckbox.checked) {
      errors.push('terms');
      setFieldError('terms', 'Devi accettare i termini e la privacy');
    } else {
      clearFieldError('terms');
    }

    if (errors.length > 0) {
      e.preventDefault();
      // scroll to first error
      const firstError = form.querySelector('.invalid-feedback.d-block');
      if (firstError) firstError.scrollIntoView({ behavior: 'smooth' });
    }
  });
});
