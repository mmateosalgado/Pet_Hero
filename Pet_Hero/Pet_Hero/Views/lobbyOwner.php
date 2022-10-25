<?php 
 include('nav.php');
?>
<?php $minDate=date('Y-m-d');?>
<form action="<?php echo FRONT_ROOT . "Owner/showOwnerViewGuardians"?>" method="post" enctype="multipart/form-data"><!-- No nos deja con el POST-->

            <div class="header">
                <div>Pet<span>Hero</span></div><br>
                <div>Ow<span>ner:</span></div>
            </div>
            <br>
            <div class="login">
                    <input type="date" placeholder="Fecha Inicio" name="fechaInicio" min=<?php echo $minDate?> required>
                    <input type="date" placeholder="Fecha Fin" name="fechaFin" min=<?php echo $minDate?> required><br>
                    <input type="submit" value="Seleccionar Fechas"><br>
                    <div class="text">
                    </div>
                </div>
   </form>