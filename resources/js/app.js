
import 'bootstrap';

//importazione alias scss
import '../scss/app.scss';  


import.meta.glob([
    '../img/**'
])


document.addEventListener('DOMContentLoaded', function() {
    // Seleziona l'elemento hamburger
    const hamburger = document.getElementById('hamburger');
    
    // Aggiungi l'evento di click
    hamburger.addEventListener('click', function() {
        // Aggiungi o rimuovi la classe "sidebar-open" al body
        document.body.classList.toggle('sidebar-open');
    });
});



