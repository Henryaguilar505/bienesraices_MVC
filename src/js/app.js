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
    // //evenlistener del formularipo de conta
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => addEventListener('click', mostrarMetodoContacto));
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');
    //el toggle en este caso funciona como un if else,
    // si la navegacion no tiene la clase se la pone, y si 
    //si la tiene se la quita
}

function mostrarMetodoContacto(e){
    const contactoDiv = document.querySelector("#contactoInfo");

    if(e.target.value == 'telefono'){
        contactoDiv.innerHTML = `
        <label for="telefono">Numero de Telefono</label>
        <input type="number" name="contacto[telefono]" id="telefono" placeholder="Tu telefono">

        <p>Elija la fecha y hora</p>

        <label for="fecha">fecha:</label>
        <input type="date" name="contacto[fecha]" id="fecha">

        <label for="hora">Hora:</label>
        <input type="time" name="contacto[hora]" id="hora">
        `;
    }else if(e.target.value == 'email') {
        contactoDiv.innerHTML = `
        <label for="email">E-mail</label>
        <input type="email" name="contacto[email]" id="email" placeholder="E-mail" >
        `;
    }
}