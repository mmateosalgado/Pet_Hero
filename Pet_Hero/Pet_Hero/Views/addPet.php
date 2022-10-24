<?php $maxDate=date('Y-m-d');?>

<?php 
include('nav.php');?>

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
                    <input type="text" placeholder="Raza" name="race" required><br>
                    <input type="number" placeholder="Peso" name="weight" required><br>
                    <input type="number" placeholder="Edad" name="age" required><br>
                    <input type="number" placeholder="Gr x Porción de comida" name="gxp" required><br>
                    <textarea placeholder="Descripción" form="agregarMascota" name="description"></textarea><br>
                    <label for="photoProfile"> Foto de la Mascota :             </label>
                    <input type="file" name="photoProfile" id="photoProfile" placeholder="Foto de Perfil" required><br>
                    <label for="photo"> Plan de Vacunación:</label>
                    <input type="file" name="planVacunacion" id="planVacunacion" placeholder="Plan de Vacunacion" required><br>
                    <label for="video"> Video Opcional:   ......</label>
                    <input type="file" name="video" id="video"><br>
                    <input type="submit" value="Añadir"><br>
                
            </div>
</form>  