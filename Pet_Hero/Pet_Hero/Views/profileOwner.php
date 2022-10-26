<?php 
include('nav.php');?>
<div class="headerSP">
    
<div>Dueño: <span><?php echo $userOwner->getuserName();?></span></div>
 

    
        <div class="textInfoUser" >
            <span>Nombre de usuario:</span><?php echo $userOwner->getuserName();?><br>
            <span>Nombre Completo:</span><?php echo $userOwner->getFullName();?><br>
            <span>Fecha de nacimiento:</span><?php echo $userOwner->getAge();?> <br>
            <span>Email:</span><?php echo $userOwner->getEmail();?><br>
            <span>Genero:</span><?php echo $userOwner->getGender();?><br>
            <span>Telefono:</span><?php echo $userOwner->getTelefono();?><br>
        </div>
        

