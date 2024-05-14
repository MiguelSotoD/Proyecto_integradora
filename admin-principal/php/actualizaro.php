    <!-- Actualizar Ordenes -->

    <?php
    include_once('sesiones.php');

    $_SESSION['tipo_Usuario']=$privilegio;

            
    include_once('conexion.php');

    $user=$_SESSION['email'];

    $sql="select * from administrador where correo_Electronico='".$user."'";

    $resultado=$conexion->query($sql);

    while($data=$resultado->fetch_assoc()){
        $id=$data['ID_admin'];
        $nombreg=$data['nombre'];
        $paterno=$data['ap_Paterno'];
        $materno=$data['ap_Materno'];
        $edad=$data['edad'];
        $ps=$data['password'];
        $imagen=$data['foto'];
    }
    include_once('conexion.php');
    $entrar="";
    if (isset($_GET['id_Orden_act'])) {
           
        $ID_orden_Entrega = $_GET['id_Orden_act'];
        
        if (isset($_GET['source']) && $_GET['source'] === 'ordenes.php') {
           $sqlorden="select * FROM ordenentrega AS o
           INNER JOIN cliente AS c ON o.FK_cliente_id = c.ID_cliente and o.ID_orden_Entrega='$ID_orden_Entrega'";
           $ejecutar_sqlorden=mysqli_query($conexion,$sqlorden);
         

           
           if($ejecutar_sqlorden->num_rows>0){
            $cliente = array();
                while ($filaOrden=mysqli_fetch_assoc($ejecutar_sqlorden)){
                    $cliente[$filaOrden['ID_cliente']] = $filaOrden['nombre'].$filaOrden['fecha_Estimada'].$filaOrden['estatus'].$filaOrden['total'];
                  
                    foreach ($cliente as $ID_cliente => $nombre) {
                    } 

        
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Actualizar Pedido</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" href="../../usuario/img/favicon.ico" type="image/x-icon">

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
                    <a href="inventarioMenu.php">Inventario</a>
                    <ul class="submenu">
                        <li><a href="inventario.php">Productos</a></li>
                        <li><a href="proveedor.php">Proveedores</a></li>
                    </ul>
                </li>
                <li>
                    <a href="facturacion.php">Gestionar</a>
                    <ul class="submenu">
                        <li><a href="Ordenes.php">Orden de Entrega</a></li>
                        <li><a href="tickets.php">Tickets</a></li>
                        <li><a href="clientes.php">Clientes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="admin"><?php echo $nombreg . ' ' . $paterno . ' ' . $materno;?></a>
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
             <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="formulario">
                <h2>Actualizar Pedidos</h2>
                <label for="id">ID:</label>
                <input type="text" name="id" readonly value="<?php echo $filaOrden['ID_orden_Entrega'];?>">


                <label for="Nomcliente">Nombre del Cliente:</label>
                <input type="text" value="<?php echo $filaOrden['nombre']." ".$filaOrden['ap_Paterno'];?>" readonly>
                
                    <label for="fecha">Fecha a Entregar:</label>
                    <input type="date" name="fecha_entregar" id="fecha" value="<?php echo $filaOrden['fecha_Estimada'];?>" required>
                    
                    <label for="desc">Descripcion del Pedido</label>
                    <input type="text" pattern="[A-Z                 a-z 0-9]{1,60}" maxlength="60" name="descripcion" value="<?php echo $filaOrden['descripcion'];?>" required>


                     <label for="estado">Estado</label>
                    <select name="estatus" id="estado" required>
                        <option value="<?php echo $filaOrden['estatus'];?>" selected><?php echo $filaOrden['estatus'];?></option>
                        <option value="Activo">Activo</option>
                        <option value="Cancelado">Cancelado</option>
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
                                        <select name="nombre_producto" id="" readonly>
                                            
                                            <?php
                                            $sqlcliente="select * from ordenentrega AS o INNER JOIN productos AS p ON o.FK_producto_id=p.ID_Producto and o.ID_orden_Entrega='$ID_orden_Entrega'";
                                            $ejecutar_sqlorden=mysqli_query($conexion,$sqlcliente);
                                            $Productoss =array();
                                 
                                            
                                            while($row=mysqli_fetch_assoc($ejecutar_sqlorden)){
                                             $Productoss[$row['ID_Producto']] = $row['nombre'];
                                            
                                            {
                                                echo '<option value="' . $row['ID_Producto'] . '">' . $row['nombre'] . '</option readonly>';
                                            }}
                                            ?>
                                        </select>
                                    </td>
                                    <td class="eli-td">
                                        <input type="number" value="<?php echo $filaOrden['cantidad']?>" min="1" max="100" readonly>
                                        
                                    </td>
                                    <td class="eli-td">
                                    <label for="total">Total:</label>
                                    <input type="text" value="<?php echo $filaOrden['total']?>" readonly>
                
                                        <!-- <button class="eliminar-fila" onclick="eliminarFila(event)">
                                            <img src="../img/eliminar-usuario.png" width="30px" alt="">
                                        </button> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <button type="button" class="agg-prod" onclick="agregarFila()"><p>Agregar Producto</p><i class="icon-agregar"  title="Agregar Producto"></i></button> -->
                        <?php }}?>
             
                        <input type="hidden" name="source" value="actOrden.php">
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
 
       
} else {

}
} else {
   
}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_REQUEST['source']) && $_REQUEST['source'] === 'actOrden.php'){
    include_once('conexion.php');
$id_orden=$_POST['id'];
$fecha_Entrega=$_POST['fecha_entregar'];
$descripcion=$_POST['descripcion'];
$estatus=$_POST['estatus'];


$actorden="update ordenentrega set estatus='$estatus',descripcion='$descripcion',fecha_Estimada='$fecha_Entrega' where ID_orden_Entrega='$id_orden'";



$actualizar_orden=mysqli_query($conexion,$actorden);
if ($actualizar_orden){
?>

<script>
    alert("SE ACTUALIZO CORRECTAMENTE");
    location.href="Ordenes.php";
</script>
<?php
}
}else{

}

?>



<?php
 include_once("alertas.php");
?>


