<?php 
require_once(VIEWS_PATH."Section/header.php");
 include('Views/../../Section/nav.php');
 ?>
        <div class="textInfoUser" >
            <center><span>Datos de Review</span></center>
            -------------------------<font>Review</font>--------------------------<br>
            <span>Calificación: </span><?php echo $review->getCalificacion(); ?><br>
            <span>Descripción: </span><?php echo $review->getDescription(); ?><br>
            ------------------------<font>Owner</font>------------------------<br>
            <span>Nombre Completo: </span><?php echo $userOwner->getFullName();?><br>
            <span>Email: </span> <?php echo $userOwner->getEmail(); ?><br>
            <span>Telefono: </span><?php echo $userOwner->getTelefono();?><br>
            ------------------------<font>Reserva</font>-------------------------<br>
            <span>Fecha Inicio: </span><?php echo $reservePay->getFechaInicio();?><br>
            <span>Fecha Fin: </span><?php echo $reservePay->getFechaFin();?><br>
            <span>Mascota: </span><?php echo $reservePay->getTipoMascota();?><br>
            <span>Monto: </span><?php echo $reservePay->getTotal();?><br>
            <span></span>
            
        </div>
        
        <?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>