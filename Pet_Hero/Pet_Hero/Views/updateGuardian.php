<?php include('nav.php');?>

<?php $minDate=date('Y-m-d');?>
<form action="<?php echo FRONT_ROOT . "Guardian/UpdateGuardian" ?>" method="post">

    <div class="header">
        <div>Modificar <br><span> Usuario</span></div>
    </div><br>
    <div class="login">
        <label>  </label>
        <a>Inicion de la disponibilidad</a>
        <input type="date" placeholder="Inicio de la Disponibilidad" name="iDisp" min=<?php echo $minDate?> required><br><!-- inicio disponibilidad-->
        <a><br><br>Fin de la disponibilidad</a>
        <input type="date" placeholder="Fin de la Disponibilidad" name="fDisp" min=<?php echo $minDate?> required><br><!-- fin disponibilidad-->
        <input type="hidden" value="<?php echo $user?>" name="user"><br>
        <input type="submit" value="Guardar cambios"><br>
    </div>
</form>

