<?php 
 include('Views/../../Section/nav.php');
 ?>

<?php $minDate=date('Y-m-d');?>
<form action="<?php echo FRONT_ROOT . "Guardian/UpdateGuardian" ?>" method="post">

    <div class="header">
        <div>Modificar <br><span> Usuario</span></div>
    </div><br>
    <div class="login guardianUpdate hovers">
        <label>  </label>
        <label>Inicio de la disponibilidad</label>
        <input type="date" placeholder="Inicio de la Disponibilidad" name="iDisp" min=<?php echo $minDate?> required><br><!-- inicio disponibilidad-->
        <label><br>Fin de la disponibilidad</label>
        <input type="date" placeholder="Fin de la Disponibilidad" name="fDisp" min=<?php echo $minDate?> required><br><br><!-- fin disponibilidad-->
        <label for="size"> Tamaño de mascotas a cuidar: </label>
        <div class="ac_type" >      
            Grande <input type="radio" name="size" value="big" required id="size">
            Mediano <input type="radio" name="size" value="medium">
            Pequeño <input type="radio" name="size" value="small">
        </div>
        <input type="hidden" value="<?php echo $user?>" name="user">
        <input type="submit" value="Guardar cambios"><br>
        <div>
                <br>            
                <?php if(isset($message)) 
                { echo "<font>". $message."</font>";} ?>
        </div>
    </div>
</form>

