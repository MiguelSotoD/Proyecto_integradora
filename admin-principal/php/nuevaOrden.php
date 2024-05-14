<?php
    include_once('nombre.php');
    include_once('conexion.php');

    $entrar="";
    $alerta="";
    $sqlCliente="select * from cliente";

    $resultadoClientes=mysqli_query($conexion,$sqlCliente);

    $clientes = array();
    while ($row = mysqli_fetch_assoc($resultadoClientes)) {
        $clientes[$row['ID_cliente']] =$row['ID_cliente'].'-'. ' '.$row['nombre']. ' '.$row['ap_Paterno']. ' '.$row['ap_Materno'];
    }


    $sqlproducto="select * from productos";

    $resultadoprod=mysqli_query($conexion,$sqlproducto);

    $productos = array();
    $productos2 =array();
    $totalprod= array();
    while ($fila = mysqli_fetch_assoc($resultadoprod)) {
        $productos[$fila['ID_Producto']] =$fila['nombre'];
        $productos2[$fila['ID_Producto']]=$fila['precio'];
        // $totalprod[$fila['ID_Producto']] =$fila['cantidad'].$fila['precio'];
    }

    // Condicion por si se envian los dato por POST
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        error_reporting(E_ALL ^ E_NOTICE);
  
     //Datosz 
    $idCliente=$_POST['nombre_cliente'];
    $estatus=$_POST['estatus'];
    $descripcion=$_POST['descripcion'];
    $fechae=$_POST['fecha_entregar'];
    $cantidad=$_POST['cantidad'];
    $precio=$_POST['presio'];
    $productoid=$_POST['nombre_producto'];

    $total=$precio*$cantidad;
    
    try {
        // Verificar si hay suficiente cantidad del producto en la base de datos
        $verificarCantidad = "select cantidad FROM productos WHERE ID_Producto= '$productoid'";
        $result = mysqli_query($conexion, $verificarCantidad);
        
        if ($result) {
            $filao = mysqli_fetch_assoc($result);
            $cantidadDisponible = $filao['cantidad'];
            if ($cantidad <= $cantidadDisponible) {
                // Restar la cantidad del producto
                $nuevaCantidad = $cantidadDisponible - $cantidad;
                $actualizarCantidad = "update productos SET cantidad = '$nuevaCantidad' WHERE ID_Producto= '$productoid'";
                mysqli_query($conexion, $actualizarCantidad);
                
                // Insertar en la tabla ordenentrega
                $sqlOrden = "Insert INTO ordenentrega VALUES (null, '$estatus', '$descripcion', '$fechae', null, '$cantidad', '$total', '$idCliente', '$productoid')";
                
                $ejecutar_sqlOrden = mysqli_query($conexion, $sqlOrden);
                
                if ($ejecutar_sqlOrden) {
                    $entrar = "orden-correcto";
                } else {
                    // $entrar = "orden-incorrecto";
                    echo "no ejecuto insert";
                }
            } else {
                $entrar = "no-cantidad-disponible";
            }
        } else {
            // $entrar = "orden-incorrecto";
            echo "no ejecuto result";
        }
    } catch (mysqli_sql_exception $ex) {
        // $entrar = "orden-incorrecto";
        echo "no entro catch";
    }
    
    // // Cerrar la conexión a la base de datos
    // mysqli_close($conexion);
}
 
//   try{
//     $sqlOrden="insert into ordenentrega values (null,'$estatus','$descripcion','$fechae',null,'$cantidad','$total','$idCliente','$productoid')";
 
 
    
//     $ejecutar_sqlOrden=mysqli_query($conexion,$sqlOrden);
//     if($ejecutar_sqlOrden){
//      $entrar="orden-correcto";
//     }
//   }
//   catch(mysqli_sql_exception $ex){
//      $entrar="orden-incorrecto";
//   }
    
//      }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Agregar Nueva Orden</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" href="../img/2.png" type="image/x-icon">
    <link rel='stylesheet' type='text/css' media='screen' href='../css/style.css'>
    <link rel="stylesheet" href="../css/responsivo.css">
    <link rel="stylesheet" href="../../usuario/css/fontello.css">
    <link rel="stylesheet" href="../css/ordenesytickets.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Varela+Round&display=swap" rel="stylesheet">
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


    <!--CONTENIDO DE LA PAGINA -->
    <section class="ordenes1">

    
        <div class="ordenes-ingresar">
            <div class="ordenes-ingresar-contenido">
                <a href="Ordenes.php"><i class="icon-angle-circled-left"></i></a>
                <p>Regresar</p>
            </div>  
        </div>
    </section>

    <section class="nuevaOrden-Ingresar">
       
          
                <div class="nuevaOrden-Ingresar-datos">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="formulario">
                <h2>Nueva Orden de Entrega</h2>
                <label for="Nomcliente">Nombre del Cliente:</label>
                     <select name="nombre_cliente" id="Nomcliente" required> 
                     <?php
                        foreach ($clientes as $ID_cliente => $nombre) {
                            echo '<option value="' . $ID_cliente . '">' . $nombre .' '. $ap_Paterno .' '. $ap_Materno . '</option>';
                        }
                    ?>
        </select> 
        <a href="agregar-clientes.php" title="Agregar Nuevo Cliente"><i class="icon-agregar-usuario"></i></a>
                
                    <label for="fecha">Fecha a Entregar:</label>
                    <input type="date" name="fecha_entregar" id="fecha" required>
                    
                    <label for="desc">Descripcion del Pedido</label>
                    <input type="text" pattern="[A-Z                 a-z 0-9]{1,60}" maxlength="60" name="descripcion" required>


                     
                    <select name="estatus" id="estado" hidden>
                        <option value="Activo">Activo</option>
                    </select>


                </div>
            

                    <div class="nuevaOrden-Ingresar-productos">
                        <h1>Productos</h1>
                        
                        <table id="tabla-agregar">
                            <thead>
                                <td><label for="">Producto</label></td>
                                <td><label for="">Cantidad</label></td>
                        
                            </thead>
                            <tbody>
                                <!-- Contenido de la tabla -->
                                <tr>
                                    <td class="eli-td">
                                        <select name="nombre_producto" id="">
                                            <?php
                                            foreach ($productos as $ID_Producto => $nombre) {
                                                echo '<option value="' . $ID_Producto . '">' . $nombre .'</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <input type="hidden" name="presio" value=" <?php
                                            foreach ($productos2 as $ID_Producto => $precio) {
                                                echo "$precio";
                                            }
                                            ?>">
                                    <td class="eli-td">
                                        <input type="number" name="cantidad" required pattern="[1-9]{1,2}" min="1">
                                    </td>
                                    <!-- <td class="eli-td">
                                        <button class="eliminar-fila" onclick="eliminarFila(event)">
                                            <img src="../img/eliminar-usuario.png" width="30px" alt="">
                                        </button>
                                    </td> -->
                                </tr>

                            

                            
                            </tbody>
                        </table>
                        <!-- <button type="button" class="agg-prod" onclick="agregarFila()"><p>Agregar Producto</p><i class="icon-agregar"  title="Agregar Producto"></i></button> -->

                        
                        
                    </div>
                    <div class="nuevaOrden-Ingresar-botones">
                        <input type="submit" value="Agregar" id="Enviar">
                        <input type="reset" value="Cancelar">
                    </div>
    
            
        </form>
    </section>
</body>
</html>
<script src="../js/jquery-3.7.0.js"></script>
<script src="../js/validacion.js"></script>
<?php
include_once("alertas.php");
?>