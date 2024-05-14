<?php

    include_once('nombre.php');
    include_once('conexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsivo.css">
    <link rel="stylesheet" href="../css/inventarioNuevo.css">
    <link rel="icon" href="../img/2.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/65f0f40838.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/functions.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsivo.css">
    <!-- <link rel="stylesheet" href="../css/style.scss"> -->
    <link rel="stylesheet" href="../../usuario/css/fontello.css">
    <!-- <script src='main.js'></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.all.min.js">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    


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

    <!--CONTENIDO DE LA PAGINA -->
    
    <!-- Seccion donde se encontraran el buscador y el boton para realizar un nuevo producto -->
    <section class="section-navegador col-xl-12 col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="div-producto col-xl-3 col-lg-12 col-md-5 col-sm-6 col-8">
            <div class="div-producto-new col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                <a class="new-producto col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" href="../php/inventario.php"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a>
            </div>
        </div>
    </section>

    <hr>

    <section class="section-formulario col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="login">
                <h1>Datos del nuevo producto</h1>
                <div class="login-datos">
                <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="proveedorProducto">Proveedor del producto</label><br>

                        <?php 
                            $query = mysqli_query($conexion, "select ID_proveedor, nombre_proveedor from proveedor where activo = 1 order by nombre_proveedor asc;" );
                            $result_proveedor = mysqli_num_rows($query);
                        ?>
                        <select type="text" id="proveedorProducto" name="proveedorProducto" required>
                        <option value="-1" selected>Selecciona un proveedor existente o crea uno nuevo</option>

                        <?php 
                            if($result_proveedor > 0){
                                while($proveedor = mysqli_fetch_array($query)){
                        ?>
                            <option value="<?php echo $proveedor['ID_proveedor'];?>"><?php echo $proveedor['nombre_proveedor'];?></option>
                        <?php 
                            }
                        }
                        ?>
                        </select>
                    </div>
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="nombreProducto">Nombre del producto</label><br>
                        <input type="text" id="nombreProducto" name="nombreProducto" placeholder="Ej: Camisetas" required>
                    </div>
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="cantidadProducto">Cantidad del producto</label><br>
                        <input type="number" id="cantidadProducto" name="cantidadProducto" placeholder="Ej: 100" required>
                    </div>
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="precioProducto">Precio del producto</label><br>
                        <input type="number" id="precioProducto" name="precioProducto" placeholder="Ej: $200.00" required>
                    </div>
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="descripcionProducto">Descripcion del producto</label><br>
                        <input type="text" id="descripcionProducto" name="descripcionProducto" placeholder="Ej: Camisetas" required>
                    </div>
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <label for="categoriaProducto">Categoria del producto</label><br>
                        <select id="categoriaProducto" name="categoriaProducto" value="<?php echo $row['categoria']; ?>" required>
                            <option value="Calendarios">Calendarios</option>
                            <option value="Ropa">Ropa</option>
                            <option value="Accesorios">Accesorios</option>
                            <option value="Libros">Libros</option>
                            <option value="Impresiones">Impresiones</option>
                        </select>
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
                    <a class="cancelar" href="inventario.php">Cancelar</a>
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

        if(empty($_POST['nombreProducto']) || empty($_POST['cantidadProducto']) || empty($_POST['cantidadProducto']) || empty($_POST['precioProducto']) || $_POST['precioProducto'] <= 0  || empty($_POST['descripcionProducto'])){
            ?><script>alert("Campos invalidos")</script><?php
        } else {
            //Traemos los parametros del formulario
            $nombreProducto      = $_POST['nombreProducto'];
            $cantidadProducto    = $_POST['cantidadProducto'];    
            $precioProducto      = $_POST['precioProducto'];
            $descripcionProducto = $_POST['descripcionProducto'];
            $categoriaProducto   = $_POST['categoriaProducto'];
            $proveedorProducto   = $_POST['proveedorProducto'];

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
                $destino     = '../img/productos/';
                $img_nombre  = 'img_'.md5(date('d-m-Y H:m:s'));
                $imgProducto = $img_nombre.'.jpg';
                $src         = $destino.$imgProducto;
            } 

                //Creamos el query que guarda los datos en la base de datos
                $sql= "insert into productos values (null, $proveedorProducto, '$nombreProducto','$descripcionProducto', '$cantidadProducto', '$precioProducto', '$categoriaProducto' ,'$imgProducto', 1);";

                //Ejecutamos el query
                $ejecutar_sql=$conexion->query($sql);

                if($ejecutar_sql){
                    if($name != ''){
                        move_uploaded_file($tmp_name, $src);
                    }
                    ?><script> 
                    Swal.fire({
                        title: 'Agregado correctamente',
                        text: "¿Deseas agregar otro producto?",
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
                                    window.location.href = 'inventario.php';
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