<?php 
include_once('nombre.php');
    include_once('conexion.php');?>
    
    <?php
    error_reporting(E_ALL ^ E_NOTICE);
    if(isset($_GET['id_productos'])){
        $id_producto = $_GET ['id_productos'];

        if(isset($_GET['source']) && ($_GET['source']) === 'inventario.php'){
            $sql = "select * from productos where ID_producto='$id_producto'";

            $ejecucion_sql = $conexion -> query($sql);

            if ($row = $ejecucion_sql -> fetch_assoc()) {
                //Guarda el registro
            
            }
        $foto        = '';
        $ClassRemove = 'notBlock';

        if($row['foto'] != 'img_producto.png'){
            $ClassRemove = '';
            $foto = '<img id="img" src="../img/productos/'.$row['foto'].'">';
        }

        }
    }

    $actualizar = "";

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        error_reporting(E_ALL ^ E_NOTICE);
        include_once('conexion.php');

    $id_producto         = $_POST['id_producto'];
    $nombreProducto      = $_POST['nombreProducto'];
    $cantidadProducto    = $_POST['cantidadProducto'];    
    $precioProducto      = $_POST['precioProducto'];
    $descripcionProducto = $_POST['descripcionProducto'];
    $categoriaProducto   = $_POST['categoriaProducto'];
    $proveedorProducto   = $_POST['proveedorProducto'];
    $imgProducto         = $_POST['foto_actual'];
    $imgRemove           = $_POST['foto_remove'];

    //Tomamos el array foto
    $foto = $_FILES['foto'];

    //         //LLamamos las propiedades de la foto
    $name     = $foto['name'];
    $fullPath = $foto['full_path'];
    $type     = $foto['type'];
    $tmp_name = $foto['tmp_name'];
    $size     = $foto['size'];

    $upd = '';

    if($name != ''){
        $destino     = '../img/productos/';
        $img_nombre  = 'img_'.md5(date('d-m-Y H:m:s'));
        $imgProducto = $img_nombre.'.jpg';
        $src         = $destino.$imgProducto;
    } else  {
        if($_POST['foto_actual'] != $_POST['foto_remove']){
            $imgProducto = 'img_producto.png';
        }
    }

    $sql2="update productos set id_Proveedor='$proveedorProducto', nombre='$nombreProducto', descripcion='$descripcionProducto', cantidad='$cantidadProducto', precio='$precioProducto', categoria='$categoriaProducto', foto='$imgProducto' where ID_producto = '$id_producto'";
                        
    $ejecutar_sql2=$conexion->query($sql2);

    if($ejecutar_sql2){
        if(($name != '' && ($_POST['foto_actual'] != 'img_producto.png')) || ($_POST['foto_actual'] != $_POST['foto_remove'])){
            unlink('../img/productos/'.$_POST['foto_actual']);
        }
            if($name != ''){       
                move_uploaded_file($tmp_name, $src);      
            }
        $actualizar = "actualizado";

    } else {
        $actualizar = "noActualizado";
    }
}

?>


<!DOCTYPE html>
                <html lang="en">
                
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Productos</title>
                    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.all.min.js"></script> -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <link rel="stylesheet" href="../css/style.css">
                    <link rel="stylesheet" href="../css/responsivo.css">
                    <link rel="icon" href="../img/2.png" type="image/x-icon">
                    <!-- <link rel="stylesheet" href="../css/inventario.css"> -->
                    <link rel="stylesheet" href="../css/inventarioNuevo.css">
                    <script src="https://kit.fontawesome.com/65f0f40838.js" crossorigin="anonymous"></script>
                    <script src="../js/functions.js"></script>
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

                    <!-- formulario -->
        <form action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" id="actualizarDatos">
            
                        <input type="hidden" name="id_producto" value="<?php echo $id_producto ?>">
                        <input type="hidden" name="source" value="modificarProducto.php">
                        <input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $row['foto'];?>">
                        <input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $row['foto'];?>">

        <div class="login">
                <h1>Actualizar producto</h1>
                <div class="login-datos">
                <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                       
                        <label for="proveedorProducto">Proveedor del producto</label><br>
                        <?php 
                        
                           $query = mysqli_query($conexion, "SELECT ID_proveedor, nombre_proveedor FROM proveedor WHERE activo = 1 ORDER BY nombre_proveedor ASC;");
                           $query1 = mysqli_query($conexion, "SELECT proveedor.nombre_proveedor, proveedor.ID_proveedor FROM productos INNER JOIN proveedor ON productos.id_proveedor = proveedor.ID_proveedor WHERE productos.ID_producto = '$id_producto';");
                           
                           $nombreProveedor = "";
                           $idProveedorSeleccionado = "";
                           
                           if ($query1) {
                               $fila = mysqli_fetch_assoc($query1);
                               if ($fila) {
                                   $nombreProveedor = $fila['nombre_proveedor'];
                                   $idProveedorSeleccionado = $fila['ID_proveedor'];
                               }
                           }
                           
                           $result_proveedor = mysqli_num_rows($query);
                           ?>
                           
                           <select id="proveedorProducto" name="proveedorProducto" required>
                               <?php if ($nombreProveedor !== "") { ?>
                                   <option value="<?php echo $idProveedorSeleccionado; ?>"><?php echo $nombreProveedor; ?></option>
                               <?php } ?>
                           
                               <?php if ($result_proveedor > 0) { ?>
                                   <?php while ($proveedor = mysqli_fetch_array($query)) { ?>
                                       <?php if ($nombreProveedor !== $proveedor['nombre_proveedor']) { ?>
                                           <option value="<?php echo $proveedor['ID_proveedor']; ?>"><?php echo $proveedor['nombre_proveedor']; ?></option>
                                       <?php } ?>
                                   <?php } ?>
                               <?php } ?>
                           </select>
                        </div>
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="nombreProducto">Nombre del producto</label><br>
                        <input type="text" id="nombreProducto" name="nombreProducto" value="<?php echo $row['nombre']; ?>" placeholder="Ej: Camisetas" required >
                    </div>
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="cantidadProducto">Cantidad del producto</label><br>
                        <input type="number" id="cantidadProducto" name="cantidadProducto" value="<?php echo $row['cantidad']; ?>" placeholder="Ej: 100" required>
                    </div>
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="precioProducto">Precio del producto</label><br>
                        <input type="number" id="precioProducto" name="precioProducto" value="<?php echo $row['precio']; ?>" placeholder="Ej: $200.00" required>
                    </div>
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="descripcionProducto">Descripcion del producto</label><br>
                        <input type="text" id="descripcionProducto" name="descripcionProducto" value="<?php echo $row['descripcion']; ?>" placeholder="Ej: Camisetas" required>
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
                            <div class="photo"  id="photo">
                                <label for="foto">Imagen del producto</label>
                                    <div class="prevPhoto">
                                    <span class="delPhoto <?php $ClassRemove; ?>">X</span>
                                    <label for="foto"></label>
                                        <?php echo $foto; ?>
                                    </div>
                                    <div class="upimg">
                                        <input type="file" name="foto" id="foto">
                                    </div>
                                <div id="form_alert"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="botones col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <button type="submit" value="Guardar" name="btn-guardar" id="btn-guardar" class="btn-guardar">Guardar</button>
                    <button type="reset" value="cancelar" name="btn-cancelar" id="btn-cancelar" class="btn-cancelar" onclick="cancelar()">Cancelar</button>
                </div>
            </div>
        </form>
    </section>    
    
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.all.min.js"></script>

<script>    
function actualizar(){

    Swal.fire({
        icon: 'success',
        title: 'Felicidades',
        text:'Usuario Actualizado',
        showConfirmButton: false,
        timer: 2000
    }).then(function(){
        location.href="../php/inventario.php";
    })
}

</script>

<?php

     if($actualizar=="actualizado"){?>

        <script> actualizar(); </script>    

    <?php } ?>

    <script>

function noActualizar(){

    Swal.fire({
        icon: 'error',
        title: 'Error',
        text:'Usuario no se actualizo verifique nuevamente',
        showConfirmButton: false,
        timer: 2000
    })
}

function cancelar(){
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

     if($actualizar=="noActualizado"){?>

        <script> noActualizar(); </script>    

    <?php } ?>

    





