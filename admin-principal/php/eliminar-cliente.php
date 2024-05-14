
<?php

    // Menejo de Sesiones
    include_once('sesiones.php');
    include_once('conexion.php');
    $entrar="";
    $alerta="";
    // Conectar BD
    
    // Eliminar un Registro de BD
   // Condicion para establecer de que archivo viene el id
    if (isset($_REQUEST['source']) && $_REQUEST['source'] === 'clientes.php') {
      
      
      error_reporting(E_ALL ^ E_NOTICE);  
               mysqli_begin_transaction($conexion);
                  try {
                     $ID_cliente=$_REQUEST['id_cliente'];   
                     $eliminarOrden = "delete FROM ordenentrega WHERE FK_cliente_id = $ID_cliente";
                     $resultadoEliminarorden = mysqli_query($conexion, $eliminarOrden);
                     // Verifica si se eliminaron los registros de pedidos correctamente
                     if (!$resultadoEliminarorden) {
                         throw new Exception("Error al eliminar las ordenes del cliente");
                         $entrar="eliminarmal";
                     }
                 
                     // Elimina el cliente de la tabla de clientes
                     $sqlCliente="Delete from cliente where ID_cliente='$ID_cliente'";
                     $ejecutar_sqlCliente=mysqli_query($conexion,$sqlCliente);
                 
                     // Verifica si se eliminó el cliente correctamente
                     if (!$ejecutar_sqlCliente) {
                        $entrar="eliminarmal";
                     }
                 
                     
                     mysqli_commit($conexion);
                 
                     $entrar="eliminarCliente";
                 } catch (Exception $e) {
                    
                     mysqli_rollback($conexion);
                 
                        
                 }
                

      
   } else {
   }
   

            // Condicion para establecer si id viene de tickets   
         if (isset($_REQUEST['source']) && $_REQUEST['source'] === 'tickets.php') {
                  // Eliminar un Registro de BD
               $ID_ticket=$_REQUEST['id_ticket'];
               $sqlticket="Delete from ticket where ID_ticket='$ID_ticket'";

               
               $ejecutar_sqlticket=mysqli_query($conexion,$sqlticket);
            $entrar="eliminarticket";
      } else {
            
      }
      



      
         if (isset($_GET['id_Orden'])) {
           
            $ID_orden_Entrega = $_GET['id_Orden'];

            if (isset($_GET['source']) && $_GET['source'] === 'Ordenes.php') {
               $sqlorden="Delete from ordenentrega where ID_orden_Entrega='$ID_orden_Entrega'";
               $ejecutar_sqlorden=mysqli_query($conexion,$sqlorden);

               $entrar="eliminarOrden";
            } else {
            
            }
         } else {
         }

  

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Eliminar</title>
</head>
<body>
   
</body>
</html>

<?php
 include_once("alertas.php");
?>