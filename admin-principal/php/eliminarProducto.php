<html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function confirmarEliminacion(button) {
        var form = button.closest('.eliminarProducto');
        var id_producto = form.querySelector('input[name="id_productos"]').value;
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Envío del formulario
            }
        });
    }
</script>

</html>
<?php

include_once('conexion.php');

if (isset($_GET['id_productos'])) {

    $id_producto = $_GET['id_productos'];

    if (isset($_GET['source']) && $_GET['source'] === 'inventario.php') {

        $sqlforeign= "delete from ordenentrega where FK_producto_id='$id_producto'";
        $ejecutar_sqlforeign= mysqli_query($conexion, $sqlforeign);

        $sqlorden = "delete from productos where ID_producto='$id_producto'";

        $ejecutar_sqlorden = mysqli_query($conexion, $sqlorden);

        if ($ejecutar_sqlorden) {
            ?>
            <script>
                location.href = "inventario.php";
            </script>
            <?php
        }
    } else {
        $entrar = "eliminarOrden";
    }
} else {
}
?>