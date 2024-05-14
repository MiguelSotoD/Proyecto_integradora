<?php
include_once('nombre.php');
include_once('conexion.php');
if (isset($_GET['id_productos'])) {
    $id_producto = $_GET['id_productos'];

    if (isset($_GET['source']) && ($_GET['source']) === 'inventario.php') {
        $sql = "select * from productos where ID_producto='$id_producto'";

        $ejecucion_sql = $conexion->query($sql);

        if ($row = $ejecucion_sql->fetch_assoc()) {
            //Guarda el registro                    
        }
    }
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsivo.css">
    <link rel="icon" href="../img/2.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="../css/inventario.css"> -->
    <link rel="stylesheet" href="../css/inventarioNuevo.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/65f0f40838.js" crossorigin="anonymous"></script>
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


    <!-- Seccion donde se encontraran el buscador y el boton para realizar un nuevo producto -->
    <section class="section-navegador col-xl-12 col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="div-producto col-xl-3 col-lg-12 col-md-5 col-sm-6 col-8">
            <div class="div-producto-new col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                <a class="new-producto col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" href="../php/inventario.php"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a>
            </div>
        </div>
    </section>

    <section class="section-formulario col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data"
            id="actualizarDatos">
            <input type="hidden" name="id_producto" value="<?php echo $id_producto ?>">
            <input type="hidden" name="source" value="agregarProducto.php">
            <!-- formulario -->
            <?php
            $sql = "select * from productos where ID_producto='$id_producto'";

            $ejecucion_sql = $conexion->query($sql);

            if ($row = $ejecucion_sql->fetch_assoc()) {
                //Guarda el registro                    ?>

                <div class="login">
                    <h1>Agregar productos</h1><br>
                    <h3 align="center">
                        <?php echo $row['nombre'] ?>
                    </h3>
                    <div class="login-datos">
                        <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <?php
                            if ($row['foto'] != 'img_producto.png') {
                                $foto = '../img/productos/' . $row['foto'];
                            } else {
                                $foto = '../img/productos/img_producto.png';
                            }
                            ?>
                            <img class="imgRepre" src="<?php echo $foto; ?>" alt="">
                        </div>
                        <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <label for="cantidadProducto">Cantidad del producto</label><br>
                            <input type="hidden" id="cantidadProducto" name="cantidadProducto"
                                value="<?php echo $row['cantidad'] ?>" placeholder="Ej: 100" required>
                            <input type="number" id="cantidadProducto" name="cantidad_sumar" placeholder="Ej: 100" required>
                        </div>
                        <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <label for="precioProducto">Precio del producto</label><br>
                            <input type="hidden" id="precioProducto" name="precioProducto"
                                value="<?php echo $row['precio'] ?>" placeholder="Ej: $200.00" required>
                            <input type="number" id="precioProducto" name="precio_sumar" placeholder="Ej: $200.00" required>
                        </div>
                    </div>
                </div>
                <div class="botones col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <button type="submit" value="Guardar" name="btn-guardar" id="btn-guardar"
                        class="btn-guardar">Guardar</button>
                    <button type="reset" value="cancelar" name="btn-cancelar" id="btn-cancelar" class="btn-cancelar"
                        onclick="cancelar()">Cancelar</button>
                </div>
                </div>
            </form>
    </body>

    </html>
<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.all.min.js"></script>

<script>
    function agregar() {

        Swal.fire({
            icon: 'success',
            title: 'Felicidades',
            text: 'Agregado correctamente',
            showConfirmButton: false,
            timer: 2000,
        }).then(function () {
            location.href = "../php/inventario.php";
        })
    }

    function noAgregar() {

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se agrego correctamente',
            showConfirmButton: false,
            timer: 2000,
        })
    }

    function cancelar() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Quieres cancelar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "inventario.php";
            }
        });
    }
</script>
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once('conexion.php');
    $id_producto = $_POST['id_producto'];
    // $nombreProducto      = $_POST['nombreProducto'];
    $cantidadProducto = $_POST['cantidadProducto'];
    $precioProducto = $_POST['precioProducto'];

    // Sumar el precio
    $precio_sumar = floatval($_POST['precio_sumar']);
    $precioProductoF = $precioProducto + $precio_sumar;

    $cantidad_sumar = floatval($_POST['cantidad_sumar']);
    $cantidadProductoF = $cantidadProducto + $cantidad_sumar;

    // Actualizar la cantidad y el precio en la base de datos
    $update_sql = "update productos set cantidad = '$cantidadProductoF', precio = '$precioProductoF' where ID_producto = '$id_producto'";

    $ejecutar_sql = $conexion->query($update_sql);
    if ($ejecutar_sql) {
        ?>
        <script>
            agregar();
        </script>
        <?php
    } else {
        ?>
        <script>
            noAgregar();
        </script>
        <?php
    }
}
?>