<?php
include_once('nombre.php');

$entrar="";

$sql="select * from administrador";

$ejecucion_sql=$conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cuenta</title>
    <link rel="icon" href="../img/2.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsivo.css">
    <link rel="stylesheet" href="../css/eliminar_cuenta.css">
    <link rel="stylesheet" href="../../usuario/css/fontello.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">
</head>
<body>

 <!-- Header -->
 <header class="header-style ">
        <input type="checkbox" id="btn-menu">

        <label for="btn-menu"><img src="../../usuario/img/menu-despegar.png" alt="menu" >
        </label>

            <div class="header-logo"><a href="principal-admin.php" class="header-logo-menu"><img src="../img/2.png" alt=""></a></div>
            <nav class="navegacion">
                <ul class="menu">
                    <li>
                        <a href="principal-admin.php">INICIO</a>
                    </li>  
                    
                    <li>
                        <a href="#">Gestionar</a>
                        <ul class="submenu">
                            <li><a href="inventario.php">Productos</a></li>
                            <li><a href="proveedor.php">Proveedores</a></li>
                            <li><a href="Ordenes.php">Orden de Entrega</a></li>
                            <li><a href="tickets.php">Tickets</a></li>
                            <li><a href="clientes.php">Clientes</a></li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="admin"><?php echo $nombre . ' ' . $paterno . ' ' . $materno;?></a>
                        <ul class="submenu">
                            <li><a href="datos-cuenta.php">Datos de la cuenta</a></li>
                            <?php
                        if ($privilegio=="Administrador")
                        echo "<li><a href='admin-cuenta.php'>Administrar cuentas</a></li>"
                        ?>
                            <li><a href="login.php">Cerrar sesion</a></li>
                        </ul>
                    </li>
                </ul>
                <ion-icon name="header-icon"></ion-icon>
            </nav>
        </header>

    <section class="ordenes1">
        <!-- Regresar -->
     <div class="ordenes-ingresar">
            <div class="ordenes-ingresar-contenido">
                <a href="admin-cuenta.php"><i class="icon-angle-circled-left"></i></a>
                <p>Regresar</p>
            </div>  
        </div>
    </section>

    <!-- Primera seccion -->
<section class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 seccion1">

        <h1>Eliminar Cuenta</h1>

            <!-- Buscador JS -->
        <input class="form-control me-2 light-table-filter" data-table="table_id" type="text" 
        placeholder="Buscar Usuario">

        <!-- Tabla con los datos de las cuentas a eliminar -->
    <table align="center" class="table table-striped table-dark table_id ">
        <thead>             
        <th>Nombre Completo</th> 
        <th>Correo Electronico</th>  
        <th>Telefono</th>
        <th>Tipo de Usuario</th> 
        <th></th>
    </thead>
    
<?php
while ($fila=$ejecucion_sql->fetch_assoc())
{
echo "<tr>";
echo "<td>".$fila['nombre'] . ' ' . $fila['ap_Paterno'] . ' ' . $fila['ap_Materno'];"</td>"; 
echo "<td>".$fila['correo_Electronico']."</td>"; 
echo "<td>".$fila['telefono']."</td>";
echo "<td>".$fila['tipo_Usuario']."</td>";  
echo "<td>" ?>
    <!-- Botón para redireccionar a eliminar-cliente.php -->
    <form class="eliminarOrd" action="eliminar.php" method="POST">
                <!-- Agrega un campo oculto para enviar el valor de ID de la orden y source -->
                <input type="hidden" name="id_admin" value="<?php echo $fila['ID_admin']; ?>">
                <input type="hidden" name="source" value="eliminar.php">
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmareditar(this)"><img src="../img/editar.png" width="30px" height="30px"></button>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmarEliminacion(this)"><img src="../img/borrar.png" width="30px" height="30px"></button>
        </form>
        <script>
            
            function confirmareditar(button) {
            var form = button.closest('.eliminarOrd');
            var idOrden = form.querySelector('input[name="id_admin"]').value;
                    Swal.fire({
                        title: '¿Quieres editar el usuario?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, Deseo Editarlo',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href="editar-usuario.php";
                        }
                    });
                }

            function confirmarEliminacion(button) {
            var form = button.closest('.eliminarOrd');
            var idOrden = form.querySelector('input[name="id_admin"]').value;
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Envío del formulario
                        }
                    });
                }
        </script>
<?php

echo "</td>";    
echo "</tr>";                      
}

echo "</table>";


?>

</section>


 
    
    
</body>
<script src="../js/buscador.js"></script>
</html>


<?php
include_once("alertas.php");
?>