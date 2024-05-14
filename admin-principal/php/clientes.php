<?php
// Menejo de Sesiones
include_once('nombre.php');
include_once('conexion.php');
// include_once("burbujas.php");

$sql="select * from cliente";

$ejecutar_sql=mysqli_query($conexion,$sql);

// Funcion para obtener numero de registros
$num_filas=$ejecutar_sql->num_rows;



// Obtener el término de búsqueda del formulario
if (isset($_POST['query'])) {
    $termino_busqueda = $_POST['query'];

  

    // Liberar recursos
    $resultado->free();
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Clientes</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/style.css'>
    <link rel="icon" href="../img/2.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/responsivo.css">
    <link rel="stylesheet" href="../css/ordenesytickets.css">
    <link rel="stylesheet" href="../../usuario/css/fontello.css">

     <!-- <script src='main.js'></script> -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.all.min.js">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

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
            <a href="principal-admin.php"><i class="icon-angle-circled-left"></i></a>
            <p>Regresar</p>
        </div>  
    </div>
        <!-- Seccion de Barra de Busqueda para las Ordenes -->
        <div class="ordenes-container">
            <div class="ordenes-container-busqueda active">
                <form action="" method="post" autocomplete="off">
                    <input type="text" name="buscar" id="ticket-buscar" class="form-control me-2 light-table-filter" data-table="table_id" placeholder="Buscar Clientes ...">
                    <a href="#" target="_blank">
                        <i class="icon-search icono"></i>
                    </a>
                </form>
            </div>
        </div>


        <div class="ordenes-ingresar">
            <div class="ordenes-ingresar-contenido">
                <a href="agregar-clientes.php"><i class="icon-agregar"></i></a>
                <p>Nuevo Cliente</p>
            </div>  
        </div>
    </section>

    <!-- <div id="search-results"></div> -->
<div>


    <table class='tickets-table table table-striped table-dark table_id'>
    <thead class='tickets-table-thead'>                 
    <!-- <th>ID</th> -->
    <th>Nombre Cliente</th>
    <th>Apellidos</th>
    <th>Telefono</th>
    <th>Direccion</th>
    <th>Correo Electronico</th>
    <?php if($privilegio=="Administrador" ) { ?>
    <th>Editar</th>
    <th>Eliminar</th>
    <?php }?>
    </thead>
<?php


                  
while ($fila=mysqli_fetch_assoc($ejecutar_sql))
{
echo "<tr class='tickets-table-tr'>";
// echo "<td class='tickets-table-td'>".$fila['ID_cliente']."</td>";
echo "<td class='tickets-table-td'>".$fila['nombre']."</td>"; 
echo "<td class='tickets-table-td'>".$fila['ap_Paterno']." ".$fila['ap_Materno']."</td>"; 
echo "<td class='tickets-table-td'>".$fila['telefono']."</td>";
echo "<td class='tickets-table-td'>".$fila['direccion']."</td>"; 
echo "<td class='tickets-table-td'>".$fila['correo_Electronico']."</td>"; 
 if($privilegio=="Administrador" ) { 
echo "<td class='tickets-table-td-a'>";       

?>
<form action="actualizar-cliente.php" method="GET" class="formCliente">
    <input type="hidden" name="id_cliente" value="<?php echo $fila['ID_cliente']; ?>">
    <input type="hidden" name="source" value="clientes.php">
    <button type="submit" class="btn btn-el btn-sm btn-outline-danger"><img src="../img/editar.png" ></button>
</form>
<?php echo "</td>"; 
echo "<td class='tickets-table-td-a'>";?>
<form action="eliminar-cliente.php" method="POST" class="formCliente">
    <input type="hidden" name="id_cliente" value="<?php echo $fila['ID_cliente']; ?>">
    <input type="hidden" name="source" value="clientes.php">
    <button type="button" class="btn-el" onclick="confirmarEliminacion(this)"><img src='../img/borrar.png'></button>
</form>

<script>
 function confirmarEliminacion(button) {
    var form = button.closest('.formCliente');
    var idCliente = form.querySelector('input[name="id_cliente"]').value;
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!"+ idCliente,
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
 }
echo "</tr>";                      
}

echo "</table>";

echo "<h3 align='center'>Registros:".$num_filas."</h3>";
echo"</div>";
?>

</body>
</html>


<!-- <script src="../js/jquery-3.7.0.js"></script> -->
<script src="../js/buscador.js"></script>



