<?php 
include('nav.php');?>
<div class="headerSP">
<div> Guardián: <span><?php echo $userGuardian->getuserName();?></span></div>
</div>

   

    
        
        <div class="textInfo">
            <span>Nombre de usuario:</span><?php echo $userGuardian->getuserName();?><br>
            <span>Nombre Completo:</span><?php echo $userGuardian->getFullName();?><br>
            <span>Fecha de nacimiento:</span><?php echo $userGuardian->getAge();?> <br>
            <span>Email:</span><?php echo $userGuardian->getEmail();?><br>
            <span>Genero:</span><?php echo $userGuardian->getGender();?><br>
            <span>Telefono:</span><?php echo $userGuardian->getTelefono();?><br>
            <span>Tamaño para Cuidar:</span><?php echo $userGuardian->getTamanioParaCuidar();?><br>
            <span>CUIL:</span><?php echo $userGuardian->getCuil();?><br>
            <span>Precio x Hora:</span><?php echo $userGuardian->getPrecioPorHora();?><br>
            <span>Fecha inicio:</span><?php echo $userGuardian->getFechaInicio();?><br>
            <span>Fecha Fin:</span><?php echo $userGuardian->getFechaFin();?><br>
        </div>
        <div class="photoProfile">
        <span>Foto:<br></span><img src="<?php echo $userGuardian->getFotoPerfil();?>" width="300px" height="300px">
        </div>
       
      

</div> 
<div class="update">
    <form action="<?php echo FRONT_ROOT."Guardian/showUpdateGuardian"?>" method="post">
        <input type="hidden" value="<?php echo $userGuardian->getuserName();?>" name="user">>
        <input type="submit" value="Modificar Datos">
    </form>
</div>

