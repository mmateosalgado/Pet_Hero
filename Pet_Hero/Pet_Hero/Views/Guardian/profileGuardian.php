<?php 
 include('Views/../../Section/nav.php');
 ?>
<div class="headerSP">
<div> Guardián: <span><?php echo $userGuardian->getuserName();?></span></div>
</div>

   
        <div>
            <br>     
                <?php if(isset($message)) 
                { echo "<div class='message'><a>". $message."</a></div>";} ?>
        </div>
        <div class="textInfo update">
            <span>Nombre de usuario:</span><?php echo $userGuardian->getuserName();?><br>
            <span>Nombre Completo:</span><?php echo $userGuardian->getFullName();?><br>
            <span>Fecha de nacimiento:</span><?php echo $userGuardian->getAge();?> <br>
            <span>Email:</span><?php echo $userGuardian->getEmail();?><br>
            <span>Genero:</span><?php echo $userGuardian->getGender();?><br>
            <span>Telefono:</span><?php echo $userGuardian->getTelefono();?><br>
            <span>Tamaño para Cuidar:</span><?php echo $userGuardian->getTamanioParaCuidar();?><br>
            <span>CUIL:</span><?php echo $userGuardian->getCuil();?><br>
            <span>Precio x Hora:</span><?php echo $userGuardian->getPrecioPorHora();?><br>
            <span>Disponibilidad:</span><br>
            <select name="datesView" placeholder="Disponibilidad">
        <?php foreach($userGuardian->getFechasDisponibles() as $fecha){?>
            <?php echo'<option>'. $fecha. '</option>';?>
        <?php } ?></td>
    </select>
    <form action="<?php echo FRONT_ROOT."Guardian/showUpdateGuardian"?>" method="post">
        <input type="hidden" value="<?php echo $userGuardian->getuserName();?>" name="user">
        <input type="submit" value="Modificar Datos">
    </form>
        </div>
        <div class="photoProfile">
        <span>Foto:<br></span><img src="<?php echo $userGuardian->getFotoPerfil();?>" width="300px" height="300px">
        </div>
       
      

</div> 



