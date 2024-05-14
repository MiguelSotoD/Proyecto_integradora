<?php
    include_once('nombre.php');
    include_once('conexion.php');
    // include_once('alertas.php');
    $entrar="";

    // Aqui entra despues de presionar el boton de submit
 if ($_SERVER["REQUEST_METHOD"]=="POST"){
       //Desactivar las noticias y mostrar los errores
       error_reporting(E_ALL ^ E_NOTICE);
 
    //Datosz 
   $nombre=$_POST['nombre'];
   $telefono=$_POST['numero'];
   $ap_Paterno=$_POST['ap_paterno'];
   $ap_Materno=$_POST['ap_materno'];
    $direccion=$_POST['direccion'];
    $correo_Electronico=$_POST['correo'];
    

   //echo "nombre: ".$nombre."<br>"."usuario: ".$usuario."<br>"."password: ".$password;
 try{
   $sql="insert into cliente values (null,'$nombre','$telefono','$ap_Paterno','$ap_Materno','$direccion','$correo_Electronico')";


   //Ejecutar la instruccion SQL
   $ejecutar_sql=mysqli_query($conexion,$sql);
   if($ejecutar_sql){
    $entrar="add-correcto";
   }
 }
 catch(mysqli_sql_exception $ex){
    $entrar="add-incorrecto";
 }
   
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Agregar Nueva Orden</title>
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
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="formulario-add-clientes">
                        <h2>Agregar Cliente</h2>
                    <label for="Nomcliente">Nombre:</label>
                     <input type="text" id="Nomcliente" name="nombre" pattern="[A-Z  a-z]{1,25}" placeholder="David" required> 
                
                     <label for="apPaterno">Apellido Paterno:</label>
                     <input type="text" id="apPaterno" name="ap_paterno" pattern="[A-Z   a-z]{1,20}" placeholder="Salas" required>

                     <label for="apMaterno">Apellido Materno:</label>
                     <input type="text" id="apMaterno" name="ap_materno" pattern="[A-Z   a-z]{1,20}" placeholder="Martinez" required>

                    <label for="Direccio">Direccion:</label>
                    <input type="text" id="Direccio" name="direccion" pattern="[A-Z    a-z 0-9]{1,60}" placeholder="Calle..." required>

                   <label for="numTel">Numero de Telefono:</label>
                     <input type="text" id="numTel" name="numero" min="0" pattern="[0-9]{10,10}" maxlength="10" placeholder="6181345671" required>
                
                     <label for="Correo-E">Correo:</label>
                     <input type="email" id="Correo-E" name="correo" pattern="{1,40}" placeholder="cliente@gmail.com" required>
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
<!-- <script src="../js/validacion.js"></script> -->
<script src="../js/alertas.js"></script>
<script src="../js/validacion.js"></script>
<?php
include_once("alertas.php");
?>