<?php
    include_once('nombre.php');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Cuentas</title>
    <link rel="icon" href="../img/2.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsivo.css">
    <link rel="stylesheet" href="../css/admin-cuenta.css">
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

    <!-- Primera seccion -->
    <section class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 seccion1">

        <h1>Administrador de Cuentas</h1>

        <article class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 article1">
            <a href="agregar-cuenta.php"><img class="imagen" src="../img/agregar-usuario.png" alt="" srcset=""></a>
            <p>Agregar cuenta</p>
        </article>

        <article class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 article2">
            <a href="eliminar-cuenta.php"><img class="imagen" src="../img/eliminar-usuario.png" alt="" srcset=""></a>
            <p>Eliminar cuenta</p>
        </article>
    </section>

</body>
</html>