<?php
 include_once('sesiones.php');
 include_once('conexion.php');
    $entrar="";
    if(isset($_POST['source']) && $_POST['source'] === 'terminar.php'){
   
    $id=$_POST['id'];
    $nombreC=$_POST['nombre'];
    $cantidad=$_POST['cantidad'];
    $descripcion=$_POST['desc'];
    $total=$_POST['total'];

    echo "$nombreC";
    echo "$total";


    $inser="insert into ticket values(null,'$nombreC','$total',null,'$cantidad','$descripcion','$id')";
    $ainsertar=mysqli_query($conexion,$inser);
    if ($ainsertar){
        $esta="Terminado";
        $change="update ordenentrega set estatus='$esta' where ID_orden_Entrega";
        $estaterm=mysqli_query($conexion,$change);
    ?>

    <script>
        alert("SE Ingresaron correctamente");
        location.href="tickets.php";
    </script>
    <?php
    }
    }else{

    }
?>

<?php
 include_once("alertas.php");
?>