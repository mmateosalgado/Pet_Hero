<?php 
require_once(VIEWS_PATH."Section/header.php");
 include('Views/../../Section/nav.php');
 ?>
<?php $minDate=date('Y-m-d');?>
<form action="<?php echo FRONT_ROOT . "Owner/showOwnerViewGuardians"?>" method="post" enctype="multipart/form-data">

            <div class="header">
                <div>Pet<span>Hero</span></div><br>
                <div>Ow<span>ner:</span></div>
            </div>
            <br>
            <div class="login date reserve hovers">
                <input type="date" placeholder="Fecha Inicio" name="fechaInicio" min=<?php echo $minDate?> required>
                <input type="date" placeholder="Fecha Fin" name="fechaFin" min=<?php echo $minDate?> required><br>
                    
                    <select name="idPet" required placeholder="Mascota" required>
                    
                    <?php foreach($petList as $pet){
                        
                         echo'<option  value="'. $pet->getId() .'">'. $pet->getName(). " (". $pet->getAnimal()."-". $pet->getRace().")" . '</option>';
                                                  ?>
                         <?php } ?>
                        </select><br>
                        
                        <input type="submit" value="Seleccionar Fechas"><br>
                        <a href="<?php echo FRONT_ROOT."Owner\showReserves";?>"> Ver Reservas en Curso </a>
                       
                       
                        <br>   
                        <br>  
                        <br>  
                        <br> 
                        <br>       
                        <?php if($message != ""){/*TODO VER CSS */?>
                            <br>
                            <div class="success">
                                <?php echo $message?>
                            </div>
                        <?php } ?> 
                    <?php if($alert != ""){?>
                            <br>
                            <div class="success">
                                <?php echo $alert["text"]?>
                            </div>
                        <?php } ?> 
                    </div>

            </div>
        </form>
        
        <?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>
        
        