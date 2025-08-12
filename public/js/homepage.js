// Observer per animare le sezioni
var elements_to_watch = document.querySelectorAll('.watch');

var callback = function (items) {
  items.forEach((item) => {
    if (item.isIntersecting) {
      item.target.classList.add('in-page');
    } else {
      item.target.classList.remove('in-page');
    }
  });
};

var observer = new IntersectionObserver(callback, { threshold: 0.6 });
elements_to_watch.forEach((element) => {
  observer.observe(element);
});

/*
*** ==> GESTIONE DEL MENU STICKY
*/
const nav = document.getElementById('mainNav'); // => Prende il menu
const firstSection = document.getElementById('section1'); // => Prende la prima sezione

window.addEventListener('scroll', () => {
  // Quando scroll supera l'altezza della prima sezione meno l'altezza del menu
  if (window.scrollY >= firstSection.getBoundingClientRect().bottom) 
    nav.classList.add('sticky');
  else 
    nav.classList.remove('sticky');
  
});

