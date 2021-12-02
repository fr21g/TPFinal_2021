// Obtiene la Referencia a la forma Modal
var modal = document.getElementById("myModal");

// Obtiene la Referencia al botón
var btn = document.getElementById("modal");

// Obtiene la referencia al Close
var span = document.getElementsByClassName("close")[0];

// Función que abre la forma
btn.onclick = function() 
{
    // Solo cambia el modo del display
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() 
{
    // Vuelve a ocultar la forma
    modal.style.display = "none";
}

// Cuando el usuario da click en cualquier parte de la ventana
window.onclick = function(event) 
{
    // Verifica si está la forma activa
    if (event.target == modal) 
    {
        // La cierra
        modal.style.display = "none";
    }
}