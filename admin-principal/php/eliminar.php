<?php
    // manejo de sesion y todo
    include_once('nombre.php');

    // variable de alertas
    $entrar="";

// eliminar los datos

    $id=$_REQUEST['id_admin'];

    $sql="DELETE FROM administrador WHERE ID_admin='$id'"; //se da instruccion para borrar el parametro id

    $ejecutar_sql=$conexion->query($sql);

    // mensaje

    if ($ejecutar_sql)
   {
    $entrar="eliminarCliente";
   }
   else
   {
    echo " <script>   
             alert('... No fue posible eliminar el empleado, verifique por favor... ');
          </script>";
   }

   echo "<script>
            location.href='eliminar-cuenta.php';
        </script>";

?>

<?php
include_once("alertas.php");
?>
