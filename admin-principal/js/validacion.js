    // Obtener el input de fecha por su ID
    const inputFecha = document.getElementById('fecha');

    // Obtener la fecha actual
    const fechaActual = new Date().toISOString().split('T')[0];

    inputFecha.setAttribute('min', fechaActual);



    function agregarFila() {
        // Obtener la tabla por su ID
        var tabla = document.getElementById("tabla-agregar");
      
        // Crear una nueva fila (<tr>)
        var nuevaFila = document.createElement("tr");
      
        nuevaFila.innerHTML = `
        <td>
        <label for="">Producto</label>
        <select name="nombre_producto" id="producto">
            <?php
            foreach ($productos as $ID_Producto => $nombre) {
                echo '<option value="' . $ID_Producto . '">' . $nombre . '</option>';
            }
            ?>
        </select>
    <br>
    <label for="">Cantidad</label>
        <input type="number" min="1" max="100" value="1" id="cantidad" name="cantidad">
    
        
        <button class="eliminar-fila" onclick="eliminarFila(event)">
            <img src="../img/eliminar-usuario.png" width="30px" alt="">
        </button>
        </td>
        `;
      
        // Agregar la nueva fila a la tabla
        tabla.appendChild(nuevaFila);
      }
      
      function eliminarFila(event) {
        event.preventDefault();
    
        // Obtener el botón que fue clicado
        var boton = event.target;
    
        // Obtener la fila (tr) que contiene el botón
        var fila = boton.parentNode.parentNode;
    
        // Eliminar la fila de la tabla
        fila.parentNode.removeChild(fila);
    }
    
    
      
      
  


