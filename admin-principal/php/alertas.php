<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.all.min.js">
</script>
<script src="../js/alertas.js"></script>

<?php 


if($entrar=="acceso"){
    ?>

        <script> acceso() </script>
    
<?php } ?>


<?php 


if($entrar=="accesoest"){
    ?>

        <script> accesoest() </script>
    
<?php } ?>

<?php 
if($entrar=="exitosa"){
    ?>

        <script> exitosa(); </script>
    
<?php } ?>


<?php 
if($entrar=="noacceso"){
    ?>

        <script> noacceso(); </script>
    
<?php } ?>


<?php 
if($entrar=="actu"){
    ?>

        <script> actu(); </script>
    
<?php } ?>

<?php 
if($entrar=="noactu"){
    ?>

        <script> noactu(); </script>
    
<?php } ?>


<?php 
if($entrar=="add-correcto"){
    ?>

        <script> addcorrecto(); </script>
    
<?php } ?>

<?php 
if($entrar=="add-incorrecto"){
    ?>

        <script> addincorrecto(); </script>
    
<?php } ?>


<?php

    if($entrar=="eliminarCliente"){ ?>
        <script> 
        eliminarcliente();
        </script>
    

<?php }?>

<?php

    if($entrar=="eliminarticket"){ ?>
        <script> 
        eliminarticket();
        </script>
    

<?php }?>

<?php

    if($entrar=="eliminarmal"){ ?>
        <script> 
        eliminarmal();
        </script>
    

<?php }?>


<?php

    if($entrar=="orden-correcto"){ ?>
        <script> 
        ordencorrecto();
        </script>
    

<?php }?>


<?php

    if($entrar=="orden-incorrecto"){ ?>
        <script> 
        ordenincorrecto();
        </script>
    

<?php }?>



<?php

    if($entrar=="eliminarOrden"){ ?>
        <script> 
        eliminarOrden();
        </script>
    

<?php }?>


<?php

    if($entrar=="actualizar"){ ?>
        <script> 
        actualizar();
        </script>
    

<?php }?>

<?php 
if($entrar=="eliminado"){
    ?>

        <script> eliminado() </script>
    
<?php } ?>

<?php

    if($entrar=="actualizarc"){ ?>
        <script> 
        actualizarc();
        </script>
    

<?php }?>



<?php

    if($entrar=="no-cantidad-disponible"){ ?>
        <script> 
        nocantidaddisponible();
        </script>
    

<?php }?>
