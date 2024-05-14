<?php
// Menejo de Sesiones
include_once('nombre.php');
include_once('conexion.php');
// include_once("burbujas.php");

$sql="select * from ticket";

$ejecutar_sql=mysqli_query($conexion,$sql);

// Funcion para obtener numero de registros
$num_filas=$ejecutar_sql->num_rows;



// Obtener el término de búsqueda del formulario
if (isset($_POST['query'])) {
    $termino_busqueda = $_POST['query'];

    // Consulta SQL para buscar productos que coincidan con el término de búsqueda
    $consulta = "SELECT * FROM ticket WHERE nombre_Cliente LIKE '%$termino_busqueda%'";
    $resultado = $conexion->query($consulta);

    // Mostrar los resultados
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<td class='tickets-table-td'>".$fila['nombre_Cliente']."</td>";
        }
    } else {
        echo "No se encontraron resultados.";
    }

    // Liberar recursos
    $resultado->free();
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Tickets</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/style.css'>
    <link rel="stylesheet" href="../css/responsivo.css">
    <link rel="icon" href="../img/2.png" type="image/x-icon">
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
    </div>
    
        <!-- Seccion de Barra de Busqueda para las Ordenes -->
        <div class="ordenes-container">
            <div class="ordenes-container-busqueda active">
                <form action="" method="post" autocomplete="off">
                    <input type="text" name="buscar" id="ticket-buscar" class="form-control me-2 light-table-filter" data-table="table_id" placeholder="Buscar Tickets ...">
                    <a href="#" target="_blank">
                        <i class="icon-search icono"></i>
                    </a>
                </form>
            </div>
        </div>
    </section>

    <!-- <div id="search-results"></div> -->
<div>


    <table class='tickets-table table table-striped table-dark table_id'>
    <thead class='tickets-table-thead'>                 
    <th>Folio:</th>
    <th>Nombre Cliente</th>
    <th>Hora y Fecha Realizada</th>
    <th>total</th>
    <th>Cantidad</th>
    <th>Descripcion</th>
    <?php if($privilegio=="Administrador" ) { ?>
    <th>Acciones</th>
    <?php } ?>
    </thead>
<?php


                  
while ($fila=mysqli_fetch_assoc($ejecutar_sql))
{
echo "<tr class='tickets-table-tr'>";
echo "<td class='tickets-table-td'>".$fila['ID_ticket']."</td>"; 
echo "<td class='tickets-table-td'>".$fila['nombre_Cliente']."</td>"; 
echo "<td class='tickets-table-td'>".$fila['fecha_Entrega']."</td>"; 
echo "<td class='tickets-table-td'>$".$fila['total']."</td>";
echo "<td class='tickets-table-td'>".$fila['cantidad_Producto']."</td>"; 
echo "<td class='tickets-table-td'>".$fila['descripcion']."</td>"; 

 if($privilegio=="Administrador" ) { 
echo "<td class='tickets-table-td-a'>";
?>
<form action="eliminar-cliente.php" method="POST" class="formticket">
    <input type="hidden" name="id_ticket" value="<?php echo $fila['ID_ticket']; ?>">
    <input type="hidden" name="source" value="tickets.php">
    <button type="button" class="btn-el" onclick="confirmarEliminacion(this)" border="none"><img src='../img/borrar.png'></button>
</form>

<script>

function confirmarEliminacion(button) {
    var form = button.closest('.formticket');
    var idTicket = form.querySelector('input[name="id_ticket"]').value;
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!"+idTicket,
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