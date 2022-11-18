<?php 
require_once(VIEWS_PATH."Section/header.php");
?>

<form action="<?php echo FRONT_ROOT . "Owner/setCalificacion" ?>"id="newReview" method="post" enctype="multipart/form-data">

<div class="header">
                <div>Rev<span>iew</span></div>
            </div>
            <br>
            <div class="addPetForm addReview">
                <br>
                <label> Calificación:</label>
                <p class="clasificacion">
                    <input id="radio1" type="radio" name="estrellas" value="5" required><!--
                    --><label for="radio1">★</label><!--
                    --><input id="radio2" type="radio" name="estrellas" value="4"><!--
                    --><label for="radio2">★</label><!--
                    --><input id="radio3" type="radio" name="estrellas" value="3"><!--
                    --><label for="radio3">★</label><!--
                    --><input id="radio4" type="radio" name="estrellas" value="2"><!--
                    --><label for="radio4">★</label><!--
                    --><input id="radio5" type="radio" name="estrellas" value="1"><!--
                    --><label for="radio5">★</label>
                </p><br>
                    <label > Reseña del Guardian: </label><br>
                    <textarea placeholder="Preguntale a tu amiguito animal como la paso!" form="newReview" name="review" required></textarea><br>
                    <input type="hidden" value="<?php echo $reserve->getIdReserve();?>" name="id" >
            
                    <input type="submit" value="Enviar"><br>
            </div>
</form>

<?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>