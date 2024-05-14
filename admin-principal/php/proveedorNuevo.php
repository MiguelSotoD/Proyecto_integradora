<?php
    include_once('nombre.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Proveedor</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsivo.css">
    <link rel="stylesheet" href="../css/inventarioNuevo.css">
    <link rel="icon" href="../img/2.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/65f0f40838.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/functions.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

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
                <a class="new-producto col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" href="proveedor.php"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a>
            </div>
        </div>
    </section>

    <hr>

    <section class="section-formulario col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="login">
                <h1>Datos del nuevo proveedor</h1>
                <div class="login-datos">
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="nombreProveedor">Nombre del proveedor</label><br>
                        <input type="text" id="nombreProveedor" name="nombreProveedor" placeholder="Ej: ProveedorCamisa" required>
                    </div>
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="contactoProveedor">Telefono del proveedor</label><br>
                        <input type="number" id="contactoProveedor" name="contactoProveedor" placeholder="618-134-8820" required>
                    </div>
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="direccionProveedor">Direccion</label><br>
                        <input type="text" id="direccionProveedor" name="direccionProveedor" placeholder="Calle Margarita #212 colonia Fuentes" required>
                    </div>
                    <!-- Aqui se sube la foto del producto -->
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="photo">
                            <label for="foto">Imagen del producto</label>
                                <div class="prevPhoto">
                                    <span class="delPhoto notBlock">X</span>
                                    <label for="foto"></label>
                                </div>
                                <div class="upimg">
                                    <input type="file" name="foto" id="foto">
                                </div>
                                <div id="form_alert"></div>
                        </div>
                    </div>
                </div>
                <div class="botones col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <button type="submit" value="Guardar" id="btn-guardar" class="btn-guardar">Guardar</button>
                    <a class="cancelar" href="proveedor.php">Cancelar</a>
                </div>
            </div>
        </form>
    </section>

    <hr>
    
    
</body>
</html>

<?php
    
    //Esto se ejecuta cuando se le da al boton de guardar
    if($_SERVER['REQUEST_METHOD']=="POST"){

        error_reporting(E_ALL ^ E_NOTICE);

        include_once('conexion.php');

        if(empty($_POST['nombreProveedor']) || empty($_POST['direccionProveedor']) || empty($_POST['contactoProveedor'])){
            ?><script>alert("Campos invalidos")</script><?php
        } else {
            //Traemos los parametros del formulario
            $nombreProveedor        = $_POST['nombreProveedor'];
            $direccionProveedor     = $_POST['direccionProveedor'];
            $contactoProveedor      = $_POST['contactoProveedor'];

        
            //Tomamos el array foto
            $foto = $_FILES['foto'];

            //LLamamos las propiedades de la foto
            $name     = $foto['name'];
            $fullPath = $foto['full_path'];
            $type     = $foto['type'];
            $tmp_name = $foto['tmp_name'];
            $size     = $foto['size'];

            $imgProducto = 'img_producto.png';

            if($name != ''){
                $destino     = '../img/proveedores/';
                $img_nombre  = 'img_'.md5(date('d-m-Y H:m:s'));
                $imgProducto = $img_nombre.'.jpg';
                $src         = $destino.$imgProducto;
            } 



                //Creamos el query que guarda los datos en la base de datos
                $sql= "insert into proveedor values (null, '$nombreProveedor', '$direccionProveedor', '$contactoProveedor', 1, '$imgProducto');";

                //Ejecutamos el query
                $ejecutar_sql=$conexion->query($sql);

                if($ejecutar_sql){
                    if($name != ''){
                        move_uploaded_file($tmp_name, $src);
                    }
                    ?><script> 
                    Swal.fire({
                        title: 'Agregado correctamente',
                        text: "¿Deseas agregar otro proveedor?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'No',
                        confirmButtonText: 'Si'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                   //Se quedara en la misma pagina
                                } else {
                                    window.location.href = 'proveedor.php';
                                }
                        });
            </script><?php
                } else {
                    ?><script>Swal.fire({
                        title: 'Error al agregar',
                        text: "Vuelva a intentar",
                        icon: 'error'
                        });
                </script><?php
            }
        }
    }
    
?>