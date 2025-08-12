document.addEventListener('DOMContentLoaded', () => {
    const deleteBtn = document.getElementById('delete-account-btn');
    const modal = document.getElementById('delete-modal');
    const modalCancel = document.getElementById('modal-cancel');
    const modalConfirm = document.getElementById('modal-confirm');
    const passwordInput = document.getElementById('modal-password');
    const deleteForm = document.getElementById('delete-account-form');
    const hiddenPasswordInput = document.getElementById('current_password');

    //Mostra modal al click
    deleteBtn.addEventListener('click', () => {
        passwordInput.value = '';
        modal.style.display = 'flex';
        passwordInput.focus();
    });

    //Chiudi modal
    modalCancel.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    //Conferma eliminazione
    modalConfirm.addEventListener('click', () => {
        const pwd = passwordInput.value.trim();
        if (pwd === '') {
            alert('Inserisci la password per confermare.');
            passwordInput.focus();
            return;
        }
        hiddenPasswordInput.value = pwd;
        deleteForm.submit();
    });

    //Chiudi modal se clicchi fuori dal contenuto
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    //Invio con Enter nel campo password
    passwordInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            modalConfirm.click();
        }
    });
});


