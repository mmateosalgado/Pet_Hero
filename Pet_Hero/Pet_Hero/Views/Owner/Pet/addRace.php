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
                        <option  value="salchicha">Salchicha</option>
                         <option  value="caniche" >Caniche</option>
                         <option  value="bulldog">Bulldog</option>
                         <option   value="labrador">Labrador</option>
                         <option   value="pitbull">Pitbull</option>
                         <option   value="golden">Golden</option>
                         <option   value="doberman">Dóberman</option>
                        </select><br>
                        <?php }else if($animal=='gato')
                        { ?>
                         <select name="race" required placeholder="Raza" required>
                        <optgroup label="Raza de Gato"></optgroup>
                         <option  value="persa" >Persa</option>
                         <option  value="siames">Siamés</option>
                         <option   value="ragdoll">Ragdoll</option>
                         <option   value="british">British shorthair</option>
                         <option   value="siberiano">Siberiano</option>
                        </select><br>
                        <?php }else if($animal=='hamster')
                        { ?>
                        <select name="race" required placeholder="Raza" required>
                        <optgroup label="Raza de Hamster"></optgroup>
                         <option  value="china" >Enano de china.</option>
                         <option  value="ruso">Enano ruso</option>
                         <option   value="campbell">Enano de Campbell.</option>
                         <option   value="roborowski">Enano Roborowski</option>
                        </select><br>
                        <?php }else if($animal=='pez') { ?>
                        <select name="race" required placeholder="Raza" required>
                        <optgroup label="Raza de Pez"></optgroup>
                         <option  value="payaso" >Payaso</option>
                         <option  value="guppys ">Guppys </option>
                         <option   value="tetras ">Tetras </option>
                         <option   value="disco ">Disco </option>
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