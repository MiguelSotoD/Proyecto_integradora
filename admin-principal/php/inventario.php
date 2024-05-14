<?php
    include_once('nombre.php');
    include_once('conexion.php');
    $sql = "SELECT ID_producto, nombre, cantidad, precio, foto FROM productos WHERE activo = 1";

    $resultado = $conexion->query($sql);

    // Verificar si se obtuvieron resultados
    if ($resultado->num_rows > 0) {
        // Iterar sobre los resultados
        while ($row = $resultado->fetch_assoc()) {
            // Acceder a los valores de cada fila
            $id_producto = $row["ID_producto"];
            $nombrep     = $row["nombre"];
            $cantidad    = $row["cantidad"];
            $precio      = $row["precio"];
            $foto        = $row["foto"];

            ?>
            <!DOCTYPE html>
            <html lang="es">
            
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Productos</title>
                <link rel="stylesheet" href="../css/style.css">
                <link rel="stylesheet" href="../css/responsivo.css">
                <link rel="stylesheet" href="../css/inventario-lleno.css">
                <link rel="icon" href="../img/2.png" type="image/x-icon">
                <script src="https://kit.fontawesome.com/65f0f40838.js" crossorigin="anonymous"></script>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
                <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
                <!-- <script src="https://node_modules/bootstrap/scss/bootstrap.scss"></script> -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="../js/functions.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                  <!-- <link rel="stylesheet" href="../css/style.scss"> -->
            <!-- <script src="../js/functions.js"></script> -->
            <link rel="stylesheet" href="../css/ordenesytickets.css">
        <link rel="stylesheet" href="../../usuario/css/fontello.css">
            </head>
            
        <body>
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
                <input type="text" name="buscar" class="form-control me-2 " id="buscador-ordenes" placeholder="Buscar Producto...">
                <a href="#" target="_blank">
                    <i class="icon-search icono"></i>
                </a>
            </form>
        </div>
    </div>

    <div class="ordenes-ingresar">
        <div class="ordenes-ingresar-contenido">
            <a href="inventarioNuevoProducto.php"><i class="icon-agregar"></i></a>
            <p>Nuevo Producto</p>
        </div>  
    </div>
</section>
            
                <hr id="separador">
            
            <div class="album py-5 bg-body-tertiary">
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                      <?php foreach($resultado as $row){ ?>
                        <div class="col">
                            <div class="card shadow-sm">
                                <?php
                                    if($row['foto'] != 'img_producto.png'){
                                       $foto = '../img/productos/'.$row['foto'];
                                    } else {
                                        $foto = '../img/productos/img_producto.png';
                                    }
                                ?>
                                    <img  src="<?php echo $foto; ?>" alt="">
                                <div class="card-body">
                                    <p class="card-text"><h2 class="nombre-text"><?php echo $row ['nombre']; ?></h2></p>
                                    <p>Cantidad: <?php echo $row ['cantidad']; ?></p>
                                    <p>Precio: $<?php echo $row ['precio']; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3">

                                        <?php if($privilegio=="Administrador" ) { ?>

                                        <form action="agregarProducto.php" method="GET">
                                                <!-- Agrega un campo oculto para enviar el valor de ID de la orden y source -->
                                                <input type="hidden" name="id_productos" value="<?php echo $row['ID_producto']; ?>">
                                                <input type="hidden" name="source" value="inventario.php">
                                                <button type="submit" class="btn btn-sm btn-outline-success">Agregar</button>
                                            </form>
                                            <form action="modificarProducto.php" method="GET">
                                                <!-- Agrega un campo oculto para enviar el valor de ID de la orden y source -->
                                                <input type="hidden" name="id_productos" value="<?php echo $row['ID_producto']; ?>">
                                                <input type="hidden" name="source" value="inventario.php">
                                                <button type="submit" class="btn btn-sm btn-outline-primary">Modificar</button>
                                            </form>
                                           
                                            <?php include_once('eliminarProducto.php'); ?>
                                            <!-- Botón para redireccionar a eliminar-cliente.php -->
                                            <form class="eliminarProducto" action="eliminarProducto.php" method="GET">
                                                <!-- Agrega un campo oculto para enviar el valor de ID de la orden y source -->
                                                <input type="hidden" name="id_productos" value="<?php echo $row['ID_producto']; ?>">
                                                <input type="hidden" name="source" value="inventario.php">
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmarEliminacion(this)">Eliminar</button>
                                            </form>

                         <?php } ?>
                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <?php } ?>
                    </div>
                </div>
            </div>
         </body>
            </html>

            <?php
        }
    } else {
        ?>
         <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proveedores</title>
        <link rel="stylesheet" href="../css/style.css">
            <link rel="stylesheet" href="../css/responsivo.css">
            <link rel="stylesheet" href="../css/inventario-lleno.css">
            <script src="https://kit.fontawesome.com/65f0f40838.js" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
                integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
                crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
                integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
                crossorigin="anonymous"></script>
            <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
            <!-- <link rel="stylesheet" href="../css/style.scss"> -->
            <!-- <script src="../js/functions.js"></script> -->
            <link rel="stylesheet" href="../css/ordenesytickets.css">
        <link rel="stylesheet" href="../../usuario/css/fontello.css">
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
                    <input type="t" name="bur" id="tic" class="f" data-table="ta" placeholder="Buscar productos ...">
                    <a href="#" target="_blank">
                        <i class="icon-search icono"></i>
                    </a>
                </form>
            </div>
        </div>


        <div class="ordenes-ingresar">
            <div class="ordenes-ingresar-contenido">
                <a href="inventarioNuevoProducto.php"><i class="icon-agregar"></i></a>
                <p>Nuevo Producto</p>
            </div>  
        </div>
    </section>

        <hr id="separador">
        <section class="section-productos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-producto-empty col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 file-empty">
                    <i class="fa-sharp fa-regular fa-file-excel ancho col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                        style="color: #000000;"></i>
                    <p>No se ha encontrado ningún producto. ¡Creemos uno! Realice un seguimiento de sus existencias creando
                        productos almacenables.</p>
                </div>
            </div>
        </section>
        
    </body>

    </html>
                
                
    <?php
    }
    
    // Cerrar la conexión
    $conexion->close(); 
?>

<script src="../js/buscador-ordenes-.js"></script>
