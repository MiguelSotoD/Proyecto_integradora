<?php
    // Manejo de sesiones

    session_start();
    
    // verificar que existan las variables de inicio de sesion
    if(isset($_SESSION)){
        session_destroy();
    }

    $entrar="";
    $alerta="";
    // Aqui entra despues de presionar el boton de submit
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        include_once('conexion.php');

        $us=$_POST['email'];
        $ps=$_POST['pass'];

        // echo $us=." ".$ps;


        // Instruccion sql sin encriptar
        // $sql="select * from usuarios where username='$us' and password='$ps'";

        // Intruccion sql encriptada
        $sql="Select * from administrador where correo_Electronico='$us' and password=hex(AES_ENCRYPT('$ps','visualizarpass'))";

        // $ejecutar_sql=$conexion->query($sql);
        $ejecutar_sql=mysqli_query($conexion, $sql);
        

        
        if(mysqli_num_rows($ejecutar_sql)>0){

            if($fila=mysqli_fetch_assoc($ejecutar_sql))
            {
                $us=$fila['correo_Electronico'];      
                $privilegio=$fila['tipo_Usuario'];
                $nombre=$fila['nombre'];
                // crear variables de sesion
                session_start();
                $_SESSION['email']=$us;
                $_SESSION['tipo_Usuario']=$privilegio;
                $_SESSION['nombre']=$nombre;

                if ($privilegio=="Administrador")
                {
                  $entrar="acceso";
                } 
                elseif($privilegio=="Empleado")
                {
                  $entrar="accesoest";
                }
            }
        }

        else{
            $entrar="noacceso";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../img/2.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsivo.css">
    <link rel="stylesheet" href="../css/normalize.css">
</head>
<body>

<header class="header-style">

        </label>

        <a href="../../index.html" class="header-logo"> <img src="../img/2.png"></a>

        <nav class="navegacion">
            <ul class="menu">
                <li>
                    <a href="../../index.html" class="admin">REGRESAR</a>
                </li>
            </ul>
            <ion-icon name="header-icon"></ion-icon>
        </nav>
    </header>

    <!-- Formulario de Registro -->
    <section class="login-section">

   
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" 
            class="formulario-login">
           
           <h2>Iniciar Sesión</h2>
            <table class="formulario-tabla">
            <tr>
                <td><label>Correo:</td>
                <td><input type="email" placeholder="Correo Electronico" id="us" name="email" required></td>
            </tr>
            <tr>
                <td><label>Contraseña:</td>
                <td><input type="password" placeholder="Contraseña" id="ps" name="pass" required></td>
            </tr>
            <tr>
                <td></td>
            <td><input  type="submit" name="enviar" value="Enviar" ></td>
            </tr>
        </table>
           </form>
    </section>

</body>
</html>

<?php
include_once("alertas.php");
?>