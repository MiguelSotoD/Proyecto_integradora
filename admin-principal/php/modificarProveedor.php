<?php 
    include_once('conexion.php');
   include_once('nombre.php');
   error_reporting(E_ALL ^ E_NOTICE);
    if(isset($_GET['id_proveedores'])){
        $id_proveedor = $_GET ['id_proveedores'];

        if(isset($_GET['source']) && ($_GET['source']) === 'proveedor.php'){
            $sql = "select * from proveedor where ID_proveedor='$id_proveedor'";

            $ejecucion_sql = $conexion -> query($sql);

            if ($row = $ejecucion_sql -> fetch_assoc()) {
                //Guarda el registro
            }
        $foto        = '';
        $ClassRemove = 'notBlock';

        if($row['foto'] != 'img_producto.png'){
            $ClassRemove = '';
            $foto = '<img id="img" src="../img/proveedores/'.$row['foto'].'">';

        }

        }
    }


    $actualizar = "";

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        error_reporting(E_ALL ^ E_NOTICE);
        include_once('conexion.php');
        $id_proveedor           = $_POST['id_proveedor'];
        $nombreProveedor        = $_POST['nombreProveedor'];
        $direccionProveedor     = $_POST['direccionProveedor'];
        $contactoProveedor      = $_POST['contactoProveedor'];
        $imgProducto            = $_POST['foto_actual'];
        $imgRemove              = $_POST['foto_remove'];
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
        $destino     = '../img/proveedores/';
        $img_nombre  = 'img_'.md5(date('d-m-Y H:m:s'));
        $imgProducto = $img_nombre.'.jpg';
        $src         = $destino.$imgProducto;
    } else  {
        if($_POST['foto_actual'] != $_POST['foto_remove']){
            $imgProducto = 'img_producto.png';
        }
    }

    $sql2="update proveedor set nombre_proveedor='$nombreProveedor', direccion_proveedor='$direccionProveedor', telefono = '$contactoProveedor', foto='$imgProducto' where ID_Proveedor = '$id_proveedor'";
                        
    $ejecutar_sql2=$conexion->query($sql2);

    if($ejecutar_sql2){
        if(($name != '' && ($_POST['foto_actual'] != 'img_producto.png')) || ($_POST['foto_actual'] != $_POST['foto_remove'])){
            unlink('../img/proveedores/'.$_POST['foto_actual']);
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
    <title>Nuevo Proveedor</title>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.all.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <link rel="stylesheet" href="../css/style.css">
                    <link rel="stylesheet" href="../css/responsivo.css">
                    <link rel="stylesheet" href="../css/inventario.css">
                    <link rel="stylesheet" href="../css/inventarioNuevo.css">
                    <link rel="icon" href="../img/2.png" type="image/x-icon">
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
                <a class="new-producto col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" href="proveedor.php"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a>
            </div>
        </div>
    </section>

    <hr>

    <section class="section-formulario col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_proveedor" value="<?php echo $id_proveedor ?>">
                        <input type="hidden" name="source" value="modificarProveedor.php">
                        <input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $row['foto'];?>">
                        <input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $row['foto'];?>">
            <div class="login">
                <h1>Datos del nuevo proveedor</h1>
                <div class="login-datos">
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="nombreProveedor"></label><br>
                        <input type="text" id="nombreProveedor" name="nombreProveedor" value="<?php echo $row['nombre_proveedor']; ?>" placeholder="Ej: ProveedorCamisa" required>
                    </div>
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="contactoProveedor">Telefono del proveedor</label><br>
                        <input type="number" id="contactoProveedor" name="contactoProveedor" value="<?php echo $row['telefono']; ?>" placeholder="618-134-8820" required>
                    </div>
                    <div class="campos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="direccionProveedor">Direccion</label><br>
                        <input type="text" id="direccionProveedor" name="direccionProveedor" value="<?php echo $row['direccion_proveedor']; ?>" placeholder="Calle Margarita #212 colonia Fuentes" required>
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
                <div class="botones col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <button type="submit" value="Guardar" id="btn-guardar" class="btn-guardar">Guardar</button>
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
        text:'Proveedor Actualizado',
        showConfirmButton: false,
        timer: 2000
    }).then(function(){
        location.href="../php/proveedor.php";
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
        text:'EL proveedor no se actualizo verifique nuevamente',
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
            location.href = "proveedor.php";
        }
    });
}

</script>

<?php

     if($actualizar=="noActualizado"){?>

        <script> noActualizar(); </script>    

    <?php } ?>

    





