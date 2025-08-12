// SCRIPT PER L'ATTIVAZIONE DEL SUCCESS MODAL

document.addEventListener("DOMContentLoaded", function () {
    const modalElement = document.getElementById('messageModal');
    if(modalElement) {
        const messageModal = new bootstrap.Modal(modalElement);
        messageModal.show();

        setTimeout(() => {
            messageModal.hide();
        }, 3000);
    }
});