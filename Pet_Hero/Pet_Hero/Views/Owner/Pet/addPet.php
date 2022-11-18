<?php 
require_once(VIEWS_PATH."Section/header.php");
$maxDate=date('Y-m-d');?>

<?php
include('Views/../../../Section/nav.php');
?>

<form action="<?php echo FRONT_ROOT . "Owner/addPet" ?>"id="agregarMascota" method="post" enctype="multipart/form-data">

            <div class="header">
                <div>Nueva<span> <br>Mascota</span></div>
            </div>
            <br>
            <div class="addPetForm">
                    <input type="text" placeholder="Nombre" name="name" required><br>
                    <select name="animal" required placeholder="Animal">
                        <optgroup label="Animal"></optgroup>
                         <option  value="perro" >Perro</option>
                         <option  value="gato">Gato</option>
                         <option   value="hamster">Hamster</option>
                         <option   value="pez">Pez</option>
                        </select><br>
                        <label for="size"> Tamaño: </label>
            <div class="ac_type" >      
                        Grande <input type="radio" name="size" value="3" required id="size">
                        Mediano <input type="radio" name="size" value="2">
                        Pequeño <input type="radio" name="size" value="1">
            </div>
                    <input type="number" placeholder="Peso" name="weight" min="0" max=100 required><br>
                    <input type="number" placeholder="Edad" name="age" min="0" max= 100 required><br>
                    <input type="number" placeholder="Gr x Porción de comida" min="0" step="10" name="gxp" required><br>
                    <textarea placeholder="Descripción" form="agregarMascota" name="description"></textarea><br>
                    <input type="submit" value="Añadir"><br>
                
            </div>
</form>  

<?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>