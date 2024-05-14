<html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function confirmarEliminacion(button) {
        var form = button.closest('.eliminarProveedor');
        var id_proveedor = form.querySelector('input[name="id_proveedores"]').value;
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

if (isset($_GET['id_proveedores'])) {

    $id_proveedor = $_GET['id_proveedores'];

    if (isset($_GET['source']) && $_GET['source'] === 'proveedor.php') {
        $sqlorden = "delete from proveedor where ID_Proveedor='$id_proveedor'";

        $ejecutar_sqlorden = mysqli_query($conexion, $sqlorden);

        if ($ejecutar_sqlorden) {
            ?>
            <script>
                location.href = "proveedor.php";
            </script>
            <?php
        }
    } else {
        $entrar = "eliminarOrden";
    }
} else {
}
?>