document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('#password-update-form');
  if (!form) return;

  const password = form.password;
  const passwordConfirmation = form.password_confirmation;

  // Funzioni di validazione
  const validators = {
    password: val => val.length >= 8,
    password_confirmation: (val, form) => val === form.password.value,
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
    input.classList.add('is-invalid');
  }

  // Rimuove errore da un campo
  function clearFieldError(field) {
    const input = form[field];
    const errorDiv = input.nextElementSibling;
    if (errorDiv && errorDiv.classList.contains('js-error-' + field)) {
      errorDiv.remove();
    }
    input.classList.remove('is-invalid');
  }

  // Validazione in tempo reale per password e conferma password
  [ 'password', 'password_confirmation' ].forEach(field => {
    const input = form[field];
    if (!input) return;

    input.addEventListener('input', () => {
      let valid;
      if (field === 'password_confirmation') {
        valid = validators[field](input.value, form);
      } else {
        valid = validators[field](input.value);
      }

      if (!valid) {
        const messages = {
          password: "La password deve contenere almeno 8 caratteri",
          password_confirmation: "Le password non corrispondono",
        };
        setFieldError(field, messages[field]);
      } else {
        clearFieldError(field);
      }
    });
  });

  // Validazione finale sul submit (ulteriore sicurezza)
  form.addEventListener('submit', (e) => {
    let errors = [];

    [ 'password', 'password_confirmation' ].forEach(field => {
      let valid;
      if (field === 'password_confirmation') {
        valid = validators[field](form[field].value, form);
      } else {
        valid = validators[field](form[field].value);
      }

      if (!valid) {
        errors.push(field);
        setFieldError(field, `Valore non valido nel campo ${field}`);
      }
    });

    if (errors.length > 0) {
      e.preventDefault();
      const firstError = form.querySelector('.invalid-feedback.d-block');
      if (firstError) firstError.scrollIntoView({ behavior: 'smooth' });
    }
  });
});

