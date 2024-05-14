// Obtiene todas las etiquetas <p> con la clase "estatus"

function leerP(){
    const estatusP = document.querySelectorAll('.estatusP');

    // Itera sobre cada elemento y verifica si contiene la palabra "Activo"
    estatusP.forEach((element) => {
      if (element.textContent.includes('Activo')) {
        // Si contiene la palabra "Activo", agrega la clase "activo"
        estatusP.style.color = "#13cc13";
      }
    });
}
