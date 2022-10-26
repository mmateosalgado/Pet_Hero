<?php 
 include('nav.php');
?>
<?php $minDate=date('Y-m-d');?>
<form action="<?php echo FRONT_ROOT . "Owner/showOwnerViewGuardians"?>" method="post" enctype="multipart/form-data">

            <div class="header">
                <div>Pet<span>Hero</span></div><br>
                <div>Ow<span>ner:</span></div>
            </div>
            <br>
            <div class="login">
                    <input type="date" placeholder="Fecha Inicio" name="fechaInicio" min=<?php echo $minDate?> required>
                    <input type="date" placeholder="Fecha Fin" name="fechaFin" min=<?php echo $minDate?> required><br>
                    <select name="mascota" required placeholder="Mascota" required>
                    <optgroup label="Mascotas"></optgroup>
                    <?php foreach($petList as $pet){?>
                         <option  value="<?php echo $pet->getAnimal() ?>"> <?php echo $pet->getName(). " (". $pet->getAnimal()."-". $pet->getRace().")";?> </option>
                         <input type="hidden" name="race" value="<?php echo $pet->getRace() ?>" />
                         <input type="hidden" name="size" value="<?php echo $pet->getSize() ?>" />
                         <input type="hidden" name="idPet" value="<?php echo $pet->getId() ?>" />
                         <?php } ?>
                        </select><br>
                    <input type="submit" value="Seleccionar Fechas"><br>
                    <div class="text">
                    </div>
                    <div><?php if($message !=null) echo $message;?></div>
                </div>
   </form>