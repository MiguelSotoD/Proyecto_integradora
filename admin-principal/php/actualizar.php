<?php
include_once('nombre.php');

$user=$_SESSION['email'];

$sql="select * from administrador where correo_Electronico='".$user."'";

$ejecucion_sql=$conexion->query($sql);

    if($fila=$ejecucion_sql->fetch_assoc())
    {
        // me guarda el registro en el objeto fila

    }

    $entrar="";

// Aqui entra despues de presionar el boton de submit
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
    //Actualizar un registro
   include_once('conexion.php');

   // Actualizar los datos
     $email=$_POST['email'];
     $tipo_us=$_POST['tipo'];
     $pass=$_POST['pass'];

     
   
       $sql="update administrador set correo_Electronico='$email', tipo_Usuario='$tipo_us', password=HEX(AES_ENCRYPT('$pass', 'visualizarpass'))  where correo_Electronico='$user'"; 
       
       $ejecutar_sql=$conexion->query($sql);
   
       // mensaje
   
       if ($ejecutar_sql)
      {
       $entrar="actu";
      }
      else
      {
        $entrar="noactu";
      }
   }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar datos</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsivo.css">
    <link rel="icon" href="../img/2.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/actualizar.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../usuario/css/fontello.css">
    

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
                <a href="datos-cuenta.php"><i class="icon-angle-circled-left"></i></a>
                <p>Regresar</p>
            </div>  
        </div>
    </section>

    <!-- Primera seccion -->
    
    <section class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 seccion1">
        <h1>DATOS DE LA CUENTA A ACTUALIZAR</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="correo">Actualizar Correo:</label>
            <input type="text" name="email"  value="<?php echo $fila['correo_Electronico'] ?>" required>
            <br><br><br>
            <label for="tipo">Tipo de trabajador:</label>
            <select name="tipo" id="">
                        <option value="Empleado">Empleado</option>
                        <option value="Administrador" selected>Administrador</option>
            </select>
            <br><br><br>
            <label for="pass">Ingresar nueva contraseña:</label>
            <input type="password" name="pass"  required>
            <br><br><br><br>
            <input type="submit" name="guardar" value="Guardar" >

            <input type="reset" name="limpiar" value="Cancelar" >

        </form>

    </section>

  
</body>
</html>
<?php
include_once("alertas.php");
?>