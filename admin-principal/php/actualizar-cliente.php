<?php
include_once('nombre.php');
include_once('conexion.php');

if (isset($_GET['id_cliente'])) {

$id=$_GET['id_cliente'];


$sql="select * from cliente where ID_cliente='$id'";

$ejecutar_sql=mysqli_query($conexion,$sql);

if($data=$ejecutar_sql->fetch_assoc()){
}
// if ($row = $ejecucion_sql->fetch_assoc()) {
//             //Guarda el registro                    
// }
}
// Aqui entra despues de presionar el boton de submit
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
    //Actualizar un registro
   include_once('conexion.php');

   // Actualizar los datos
   $idd=$_POST['id'];
     $nom=$_POST['nombre'];
     $app=$_POST['ap_paterno'];
     $apm=$_POST['ap_materno'];
    $dir=$_POST['direccion'];
    $tel=$_POST['numero'];
    $correo=$_POST['correo'];
    
    $sqlupdate="update cliente set nombre='$nom', telefono='$tel', ap_Paterno='$app', ap_Materno='$apm', direccion='$dir', correo_Electronico='$correo'  where ID_cliente='$idd'"; 

    $ejecutar_sqlup=mysqli_query($conexion,$sqlupdate);

    
       ?>
            <Script>
                alert("Se actualizo Correctamente")
            location.href="clientes.php";
            </Script>
    <?php
   }

?>
<script ></script>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Actualizar Cliente</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" href="../../usuario/img/favicon.ico" type="image/x-icon">

    <link rel='stylesheet' type='text/css' media='screen' href='../css/style.css'>
    <link rel="stylesheet" href="../css/responsivo.css">
    <link rel="stylesheet" href="../../usuario/css/fontello.css">
    <link rel="stylesheet" href="../css/ordenesytickets.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.all.min.js">
</script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
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
                <a href="clientes.php"><i class="icon-angle-circled-left"></i></a>
                <p>Regresar</p>
            </div>  
        </div>
    </section>

    <section class="nuevaOrden-Ingresar">
       
          
                <div class="nuevaOrden-Ingresar-datos">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="formulario-add-clientes">
                        <h2>Agregar Cliente</h2>
                        <input type="hidden"  value="<?php echo $id ?>" name="id"> 

                    <label for="Nomcliente">Nombre:</label>
                     <input type="text" id="Nomcliente" value="<?php echo $data['nombre']; ?>" name="nombre" pattern="[A-Z  a-z]{1,25}" placeholder="David" required> 
                
                     <label for="apPaterno">Apellido Paterno:</label>
                     <input type="text" id="apPaterno" name="ap_paterno" value="<?php echo $data['ap_Paterno']; ?>" pattern="[A-Z   a-z]{1,20}" placeholder="Salas" required>

                     <label for="apMaterno">Apellido Materno:</label>
                     <input type="text" id="apMaterno" name="ap_materno" value="<?php echo $data['ap_Materno']; ?>" pattern="[A-Z   a-z]{1,20}" placeholder="Martinez" required>

                    <label for="Direccio">Direccion:</label>
                    <input type="text" id="Direccio" name="direccion" value="<?php echo $data['direccion']; ?>"  pattern="[A-Z    a-z 0-9]{1,60}" placeholder="Calle..." required>

                   <label for="numTel">Numero de Telefono:</label>
                     <input type="text" id="numTel" name="numero" min="0" value="<?php echo $data['telefono']; ?>" pattern="[0-9]{10,10}" maxlength="10" placeholder="6181345671" required>
                
                     <label for="Correo-E">Correo:</label>
                     <input type="email" id="Correo-E" name="correo" pattern="{1,40}" value="<?php echo $data['correo_Electronico']; ?>" placeholder="cliente@gmail.com" required>
                </div>
            
                    <div class="nuevaOrden-Ingresar-botones">
                        <input type="submit" value="Agregar" id="Enviar">
                        <input type="reset" value="Cancelar">
                    </div>
    
            
        </form>
    </section>
</body>
</html>
