<?php
// Menejo de Sesiones
include_once('nombre.php');
include_once('conexion.php');
// include_once("burbujas.php");

        // Consulta SQL para obtener todos los registros de la tabla
        $consulta="select * FROM cliente AS c
        INNER JOIN ordenentrega AS p ON c.ID_cliente = p.FK_cliente_id";
        $resultado = mysqli_query($conexion,$consulta);

    // Mostrar los registros con la estructura HTML deseada
    

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Ordenes</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" href="../img/2.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/ordenesytickets.css">
    <script src="https://kit.fontawesome.com/65f0f40838.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
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
    <!-- Ingresar Nueva Orden de Entrega -->
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
                    <input type="text" name="buscar" class="form-control me-2 " id="buscador-ordenes" placeholder="Buscar Pedidos...">
                    <a href="#" target="_blank">
                        <i class="icon-search icono"></i>
                    </a>
                </form>
            </div>
        </div>

        <div class="ordenes-ingresar">
            <div class="ordenes-ingresar-contenido">
                <a href="nuevaOrden.php"><i class="icon-agregar"></i></a>
                <p>Nueva Orden</p>
            </div>  
        </div>
    </section>
   

        <h1>Pedidos</h1>
    <div class="album py-5 bg-body-tertiary table table-striped table_id">
    
        <div class="container">
       
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
                            if ($resultado->num_rows > 0) {
                                $ordenes = array();
                                    while ($row = mysqli_fetch_assoc($resultado)) {
                                        $ordenes[$row['ID_orden_Entrega']] = $row['nombre'].$row['fecha_Estimada'].$row['estatus'];
                                        foreach ($ordenes as $ID_orden_Entrega => $nombre) {
                                        }        
                            ?>
                <div class="col">
                    <div class="card shadow-sm">
                                 
                        <div class="card-body table-striped" >
                        
                            <p class="card-text"><h2 class="nombre-text">Folio: <?php echo $row['ID_orden_Entrega']; ?></h2></p>
                            <p>Nombre: <?php echo $row['nombre'].' '.$row['ap_Paterno']; ?></p>
                            <p>Entrega: <?php echo $row['fecha_Estimada']; ?></p>
                            <p class="estatusP">Estatus: <?php echo $row['estatus'];?> </p>
                            <script src="../js/leerorden.js">
                                leerP();
                            </script>
                            <p>Descripcion: <?php echo $row['descripcion']; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">

                                <?php if($row['estatus']=="Activo" && $privilegio=="Administrador" ) { ?>
                                
                                <form action="actualizaro.php" method="GET" >
                                        <!-- Agrega un campo oculto para enviar el valor de ID de la orden y source -->
                                        <input type="hidden" name="id_Orden_act" value="<?php echo $row['ID_orden_Entrega']; ?>">
                                        <input type="hidden" name="source" value="ordenes.php">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Actualizar</button>  
                                </form>
                                    
                                    
                                    

                                    

                                         
                                <!-- Botón para redireccionar a eliminar-cliente.php -->
                                <form class="eliminarOrd" action="eliminar-cliente.php" method="GET">
                                        <!-- Agrega un campo oculto para enviar el valor de ID de la orden y source -->
                                        <input type="hidden" name="id_Orden" value="<?php echo $row['ID_orden_Entrega']; ?>">
                                        <input type="hidden" name="source" value="Ordenes.php">
                                        
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmarEliminacion(this)">Eliminar</button>
                                </form>
                              
                               <script>
                                  function confirmarEliminacion(button) {
                                    var form = button.closest('.eliminarOrd');
                                    var idOrden = form.querySelector('input[name="id_Orden"]').value;
                                            Swal.fire({
                                                title: '¿Estás seguro?',
                                                text: "¡No podrás revertir esto!"+idOrden,
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Sí, eliminar',
                                                cancelButtonText: 'Cancelar'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    form.submit(); // Envío del formulario
                                                }
                                            });
                                        }
                               </script>
                                    
                                     <!-- Botón para redireccionar a eliminar-cliente.php -->
                                <form class="terminarp" action="enviarticket.php" method="POST">
                                        <!-- Agrega un campo oculto para enviar el valor de ID de la orden y source -->
                                        <input type="hidden" name="id" value="<?php echo $row['ID_orden_Entrega']; ?>">
                                        <input type="hidden" name="nombre" value="<?php echo $row['nombre']; ?>">
                                        <input type="hidden" name="total" value="<?php echo $row['total']; ?>">
                                        <input type="hidden" name="nombre" value="<?php echo $row['nombre']; ?>">
                                        <input type="hidden" name="desc" value="<?php echo $row['descripcion']; ?>">
                                    
                                        <input type="hidden" name="cantidad" value="<?php echo $row['cantidad']; ?>">
                                        <input type="hidden" name="source" value="terminar.php">
                                        
                                        <button type="submit" class="btn btn-sm btn-outline-finish">Terminado</button>
                                </form>
                                <?php }?>
                                </div>
                            </div>

                        </div>
                      
                    </div>
                </div>
                <?php
                 
                    }
                } else {
                    echo  "<section class='section-productos col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>";
                    echo  "<div class='section-producto-empty col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>";
                    echo "<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 file-empty'>";
                    echo "<i class='fa-sharp fa-regular fa-file-excel ancho col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12' style='color: #000000;'></i>";
                    echo "    <p>No se ha encontrado ningún producto. ¡Creemos uno! Agrega un nuevo pedido.</p>";
                    echo "   </div>";
                    echo " </div>";
                    echo " </section>";
                }?>
            </div>
        </div>
        
    </div>

   
  
    
</body>
</html>

<script src="../js/buscador-ordenes-.js"></script>
     
