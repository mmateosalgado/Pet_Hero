<?php 
require_once(VIEWS_PATH."Section/header.php");
 include('Views/../../Section/nav.php');
 ?>
<div class="headerSP">
    
Pago realizado con exito
 
</div>

    
        <div class="textInfoUser" >
            <center><span>Datos de facturacion</span></center>
            -------------------------<font>Dueño</font>--------------------------<br>
            <span>Nombre Completo:</span><?// echo $userOwner->getFullName();?><br>
            <span>Cuit/Cuil:</span><br>
            <span>Email:</span><?php //echo $userOwner->getEmail();?><br>
            <span>Telefono:</span><?php //echo $userOwner->getTelefono();?><br>
            ------------------------<font>Guardian</font>------------------------<br>
            <span>Nombre Completo:</span><?php //echo $userOwner->getFullName();?><br>
            <span>Email:</span> <?// echo $userOwner->getEmail();?><br>
            <span>Telefono:</span><?php //echo $userOwner->getTelefono();?><br>
            <span>Cuit/Cuil:</span><br>
            ------------------------<font>Reserva</font>-------------------------<br>
            <span>Fechas: </span><br>
            <span>Mascota: </span><br>
            <span>Monto: </span><br>
            <span></span>
            
        </div>
        
        <?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>