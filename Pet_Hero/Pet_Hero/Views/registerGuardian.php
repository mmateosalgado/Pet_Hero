<form action="<?php echo FRONT_ROOT . "Guardian/addCuilAndPPH"?>" method="post" enctype="multipart/form-data"><!-- No nos deja con el POST-->

            <div class="header">
                <div>Pet<span>Hero</span></div><br>
                <div>Guard<span>ianes:</span></div>
            </div>
            <br>
            <div class="login">
                    <input type="hidden" value="<?php echo $user?>" name="user" >
                    <input type="hidden" value="<?php echo $password?>" name="password">
                    <input type="hidden" value="<?php echo $name?>" name="name">
                    <input type="hidden" value="<?php echo $date?>" name="date">
                    <input type="hidden" value="<?php echo $email?>" name="email">
                    <input type="hidden" value="<?php echo $gender?>" name="gender">
                    <input type="hidden" value="<?php echo $accountType?>" name="accountType">
                    <input type="hidden" value="<?php echo $telefono?>" name="telefono">

                    <input type="number" placeholder="Cuil" name="cuil" required min=0><br>
                    <input type="number" placeholder="Precio por hora" name="pph" min="0" step="50" required><br>
                    <input type="date" placeholder="Fecha Inicio" name="fechaInicio" required>
                    <input type="date" placeholder="Fecha Fin" name="fechaFin" required><br>
                    <label for="photo"> Foto de Perfil:</label>
                    <input type="file" name="photo" id="photo" placeholder="Foto de Perfil" required>
                    <input type="submit" value="Terminar Registro"><br>
                    <div class="text">
                    </div>
                </div>
   </form>