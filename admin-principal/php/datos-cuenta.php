<?php
include_once('conexion.php');
include_once('sesiones.php');
include_once('nombre.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del empleado</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/2.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/responsivo.css">
    <link rel="stylesheet" href="../css/datos-cuenta.css">
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
    <!-- Seccion con formulario -->
    <section class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 seccion1">
    <h1 class="datos">Datos de la cuenta</h1>
        <article class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 article1">
            <img src="<?php echo $imagen;?>">
            <br>
            <h1><?php echo $nombre . ' ' . $paterno . ' ' . $materno; ?></h1>
            <h2>Ocupacion</h2>
            <h4><?php echo $_SESSION['tipo_Usuario'];?></h4>

        </article>

        <form  method="post" class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <label for="tipo">Tipo de trabajador:</label>
                <a><?php echo $_SESSION['tipo_Usuario'];?></a>
                <br><br>
                <label for="telefono">Telefono:</label>
                <a><?php echo $cel;?></a>
                <br><br>
                <label for="correo">Correo Electronico:</label>
                <a><?php echo $_SESSION['email'];?></a>
                <br><br>
                <label for="edad">Edad:</label>
                <a><?php echo $edad;?></a>
                <br><br>
                <label for="pass">Contraseña:</label>
                <a><?php echo '************'?></a>
                <br><br><br><br>
        </form>
        <section class="boton" align="center">
                        <?php
                    if ($privilegio=="Administrador")
                    echo "<a class='act' href='actualizar.php'>Actualizar Perfil</a>"
                    ?>
        </section>
    </section>
</body>
</html>