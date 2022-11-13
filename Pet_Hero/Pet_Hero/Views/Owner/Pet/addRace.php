<form action="<?php echo FRONT_ROOT ."Owner/addRace"?>" method="post" enctype="multipart/form-data">

            <div class="header">
                <div>Pet<span>Hero</span></div><br>
                <div>Guard<span>ianes:</span></div>
            </div>
            <br>
            <div class="login">
                    <input type="hidden" value="<?php echo $name?>" name="name" >
                    <input type="hidden" value="<?php echo $animal?>" name="animal">
                    <input type="hidden" value="<?php echo $size?>" name="size">
                    <input type="hidden" value="<?php echo $weight?>" name="weight">
                    <input type="hidden" value="<?php echo $age?>" name="age">
                    <input type="hidden" value="<?php echo $gxp?>" name="gxp">
                    <input type="hidden" value="<?php echo $description?>" name="description">
                    <?php if($animal == 'perro'){?>
                        <select name="race" required placeholder="Raza" required>
                        <optgroup label="Raza de Perro"></optgroup>
                        <option  value="1">Salchicha</option>
                         <option  value="2" >Caniche</option>
                         <option  value="3">Bulldog</option>
                         <option   value="4">Labrador</option>
                         <option   value="5">Pitbull</option>
                         <option   value="6">Golden</option>
                         <option   value="7">Dóberman</option>
                        </select><br>
                        <?php }else if($animal=='gato')
                        { ?>
                         <select name="race" required placeholder="Raza" required>
                        <optgroup label="Raza de Gato"></optgroup>
                         <option  value="8" >Persa</option>
                         <option  value="9">Siamés</option>
                         <option   value="10">Ragdoll</option>
                         <option   value="11">British shorthair</option>
                         <option   value="12">Siberiano</option>
                        </select><br>
                        <?php }else if($animal=='hamster')
                        { ?>
                        <select name="race" required placeholder="Raza" required>
                        <optgroup label="Raza de Hamster"></optgroup>
                         <option  value="13" >Enano de china.</option>
                         <option  value="14">Enano ruso</option>
                         <option   value="15">Enano de Campbell.</option>
                         <option   value="16">Enano Roborowski</option>
                        </select><br>
                        <?php }else if($animal=='pez') { ?>
                        <select name="race" required placeholder="Raza" required>
                        <optgroup label="Raza de Pez"></optgroup>
                         <option  value="17" >Payaso</option>
                         <option  value="18 ">Guppys </option>
                         <option   value="19 ">Tetras </option>
                         <option   value="20 ">Disco </option>
                        </select><br>
                        <?php } ?>
                    <label for="photoProfile"> Foto de la Mascota :             </label>
                    <input type="file" name="photoProfile" id="photoProfile" placeholder="Foto de Perfil" required><br>
                    <label for="photo"> Plan de Vacunación:</label>
                    <input type="file" name="planVacunacion" id="planVacunacion" placeholder="Plan de Vacunacion" required><br>
                    <label for="video"> Video Opcional:   ......</label>
                    <input type="file" name="video" id="video"><br>
                    <input type="submit" value="Terminar Registro"><br>
                    <div class="text">
                    </div>
                </div>
   </form>