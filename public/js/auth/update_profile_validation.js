document.addEventListener('DOMContentLoaded', () => {
  // ========== VALIDAZIONE FORM ==========
  const form = document.querySelector('#profile-update-form');

  if (form) {
    const fields = ['name', 'surname', 'birth_date', 'phone', 'tax_code', 'password', 'password_confirmation'];

    const validators = {
      name: val => /^[a-zA-ZÀ-ÿ\s'-]+$/.test(val.trim()),
      surname: val => /^[a-zA-ZÀ-ÿ\s'-]+$/.test(val.trim()),
      birth_date: val => {
        if (!val) return false;
        const date = new Date(val);
        const now = new Date();
        return date instanceof Date && !isNaN(date) && date <= now;
      },
      phone: val => /^\+?[0-9\s\-]{6,15}$/.test(val.trim()),
      tax_code: val => /^[A-Za-z0-9]{16}$/.test(val.trim()),
      password: val => val.length >= 8,
      password_confirmation: val => val.length >= 8,
    };

    const errorMessages = {
      name: "Inserisci un nome valido (solo lettere, spazi, apostrofi e trattini).",
      surname: "Inserisci un cognome valido (solo lettere, spazi, apostrofi e trattini).",
      birth_date: "Inserisci una data di nascita valida e non futura.",
      phone: "Inserisci un numero di telefono valido.",
      tax_code: "Il codice fiscale deve contenere esattamente 16 caratteri alfanumerici.",
      password: "La password deve contenere almeno 8 caratteri.",
      password_confirmation: "La conferma password deve contenere almeno 8 caratteri.",
    };

    function showError(input, message) {
      let errorDiv = input.nextElementSibling;
      if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
        errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        input.parentNode.insertBefore(errorDiv, input.nextSibling);
      }
      errorDiv.textContent = message;
      input.classList.add('is-invalid');
    }

    function clearError(input) {
      input.classList.remove('is-invalid');
      const errorDiv = input.nextElementSibling;
      if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
        errorDiv.textContent = '';
      }
    }

    function validateField(field) {
      const input = form.querySelector(`#${field}`);
      if (!input) return true;

      const value = input.value.trim();
      const isValid = validators[field](value);

      if ((field === 'password_confirmation' || field === 'password') && isValid) {
        const password = form.querySelector('#password').value.trim();
        const passwordConfirm = form.querySelector('#password_confirmation').value.trim();

        if (password !== passwordConfirm) {
          showError(form.querySelector('#password_confirmation'), "Le password non coincidono.");
          return false;
        } else {
          clearError(form.querySelector('#password_confirmation'));
        }
      }

      if (!isValid) {
        showError(input, errorMessages[field]);
        return false;
      } else {
        clearError(input);
        return true;
      }
    }

    function validateForm() {
      let allValid = true;
      fields.forEach(field => {
        if (!validateField(field)) allValid = false;
      });
      return allValid;
    }

    fields.forEach(field => {
      const input = form.querySelector(`#${field}`);
      if (input) {
        input.addEventListener('input', () => validateField(field));
      }
    });

    form.addEventListener('submit', (e) => {
      if (!validateForm()) {
        e.preventDefault();
        const firstError = form.querySelector('.is-invalid');
        if (firstError) firstError.focus();
      }
    });
  }
});
