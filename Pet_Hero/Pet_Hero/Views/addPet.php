<?php $maxDate=date('Y-m-d');?>

<?php 
include('nav.php');?>

<form action="<?php echo FRONT_ROOT . "Home/Register" ?>" method="post">

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
                    <input type="text" placeholder="Raza" name="raza" required><br>
                    <input type="number" placeholder="Peso" name="weight" required><br>
                    <input type="number" placeholder="Edad" name="age" required><br>
                    <input type="number" placeholder="Gr x Porción de comida" name="age" required><br>
                    <textarea placeholder="Descripción"></textarea><br>
                
                    <input type="submit" value="Añadir"><br>
                
            </div>
</form>