<?php
include_once('sesiones.php');

$_SESSION['tipo_Usuario']=$privilegio;

        
include_once('conexion.php');

$user=$_SESSION['email'];

$sql="select * from administrador where correo_Electronico='".$user."'";

$resultado=$conexion->query($sql);

while($data=$resultado->fetch_assoc()){
    $id=$data['ID_admin'];
    $nombre=$data['nombre'];
    $paterno=$data['ap_Paterno'];
    $materno=$data['ap_Materno'];
    $edad=$data['edad'];
    $ps=$data['password'];
    $cel=$data['telefono'];
    $imagen=$data['foto'];
}


?>