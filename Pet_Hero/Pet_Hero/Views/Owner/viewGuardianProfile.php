<?php 
require_once(VIEWS_PATH."Section/header.php");
 include('Views/../../Section/nav.php');
 ?>
<div class="headerSP">
<div> Guardián: <span><?php echo $guardian->getUserName();?></span></div>
</div>

   

    
        
        <div class="textInfo update">
            <span>Nombre de usuario:</span><?php echo $guardian->getUserName();?><br>
            <span>Nombre Completo:</span><?php echo $guardian->getFullName();?><br>
            <span>Fecha de nacimiento:</span><?php echo $guardian->getAge();?> <br>
            <span>Email:</span><?php echo $guardian->getEmail();?><br>
            <span>Genero:</span><?php echo $guardian->getGender();?><br>
            <span>Telefono:</span><?php echo $guardian->getTelefono();?><br>
            <span>Tamaño para Cuidar:</span><?php echo $guardian->getTamanioParaCuidar();?><br>
            <span>CUIL:</span><?php echo $guardian->getCuil();?><br>
            <span>Precio x Hora:</span><?php echo $guardian->getPrecioPorHora();?><br>
            <span>Disponibilidad:</span><br>
            <select name="datesView" placeholder="Disponibilidad">
        <?php foreach($guardian->getFechasDisponibles() as $fecha){?>
            <?php echo'<option>'. $fecha. '</option>';?>
        <?php } ?></td>
    </select>
    <form action="<?php echo FRONT_ROOT."Owner/showOwnerViewGuardians"?>" method="post">
        <input type="hidden" value="<?php echo $fechaInicio;?>" name="fechaInicio">
        <input type="hidden" value="<?php echo $fechaFin;?>" name="fechaFin">
        <input type="hidden" value="<?php echo $idPet;?>" name="idPet">
        <input type="submit" value="Volver">
    </form>
        </div>
        <div class="photoProfile">
        <span>Foto:<br></span><img src="<?php echo $guardian->getFotoPerfil();?>" width="300px" height="300px">
        </div>
       
      

</div> 
<?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>