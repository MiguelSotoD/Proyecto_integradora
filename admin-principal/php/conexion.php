<?php

  //1.- Conectarme a la BD 
  $servidor="127.0.0.1";
  $usuario="root";
  $password="";
  $bd="elprofe";

  // Metodo de conexion orientado a objetos
  // $conexion=new mysqli($servidor,$usuario,$password,$bd);

  // Metodo de conexion procedural
  $conexion=mysqli_connect($servidor,$usuario,$password,$bd);
  // if ($conexion)
  //    echo "Se conecto exitosamente ok a la BD";

?>