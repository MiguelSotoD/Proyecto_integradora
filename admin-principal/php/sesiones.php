<?php

    session_start();

    if(!isset($_SESSION['nombre']))
    {
        header("location:login.php");
    }
    else{
        $us=$_SESSION['email'];
        $privilegio=$_SESSION['tipo_Usuario'];
        $nombre=$_SESSION['nombre'];
    }

?>