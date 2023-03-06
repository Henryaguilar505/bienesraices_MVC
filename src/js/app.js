document.addEventListener('DOMContentLoaded', function(){

    eventListeners();

    darkMode();
});

function darkMode(){
    const botondarkmode = document.querySelector('.dark-mode-boton');

    botondarkmode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    })
}

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');
    //el toggle en este caso funciona como un if else,
    // si la navegacion no tiene la clase se la pone, y si 
    //si la tiene se la quita
}