<?php
    include_once('nombre.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El profe</title>
    <link rel="icon" href="../img/2.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/facturacion.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsivo.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">

    <style>
       
    </style>
    
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

    <h1>Gestionar</h1>

    <article class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
    <a href="proveedor.php"><img class="imagen" width="250px" src="../img/proveedor.png" alt="" srcset=""></a>
    <p>Proveedores</p>
    </article>

    <article class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
    <a href="inventario.php"><img class="imagen" width="250px" src="../img/producto.png" alt="" srcset=""></a>
    <p>Productos</p>
</article>

<article class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
    <a href="clientes.php"><img class="imagen" width="250px" src="../img/clientes.png" alt="" srcset=""></a>
    <p>Clientes</p>
</article>
</section>

<section class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 seccion1">
    
<article class="col-xl-6 col-lg-4 col-md-4 col-sm-12 col-12 ">
    <a href="Ordenes.php"><img class="imagen" width="250px" src="../img/orden.png" alt="" srcset=""></a>
    <p>Órdenes</p>
</article>

<article class="col-xl-6 col-lg-4 col-md-4 col-sm-12 col-12 ">
    <a href="tickets.php"><img class="imagen" width="250px" src="../img/ticket.png" alt="" srcset=""></a>
    <p>Tickets</p>
</article>

</section>
<!-- 





</body>
</html>

