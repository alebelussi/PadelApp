/*** CREAZIONE DELLO SWIPER ***/
document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.mySwiper', { //=> Crea lo swiper per il container .mySwiper
        navigation: {       //=> Specifica il selettore
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        loop: true,        //=> Scorrimento
        spaceBetween: 20,
        slidesPerView: 1,
        keyboard: {         //=> Permette di utilizzare le freccette per spostare slide
            enabled: true,
            onlyInViewport: true,
        },
        observer: true,
        observeParents: true,
    });
});