<?php 
require_once(VIEWS_PATH."Section/header.php");
$maxDate=date('Y-m-d');?>

<form action="<?php echo FRONT_ROOT . "Home/Register" ?>" method="post">

            <div class="header">
                <div>Pet<span>Hero</span></div>
            </div>
            <br>
            <div class="addPetForm">
                    <input type="text" placeholder="Nombre de usuario" name="user" required><br>
                    <input type="text" placeholder="Nombre y Apellido" name="name" required><br>
                    <input type="text" placeholder="Email" name="email" required><br>
                    <input type="password" placeholder="Contraseña" name="password" required><br>
                    <input type="date" name="date" max="<?php echo $maxDate?>" required><br>
                    <div class="ac_type" required>      
                        Dueño <input type="radio" name="accountType" value="owner" required>
                        Guardián <input type="radio" name="accountType" value="guardian">
                    </div>
                    <div class="ac_type" >      
                        Mujer <input type="radio" name="gender" value="1" required>
                        Hombre <input type="radio" name="gender" value="2">
                        Otro <input type="radio" name="gender" value="3">
                    </div>
                    <input type ="number" placeholder="telefono" name="telefono" required min=999999><br>
                    <input type="submit" value="Registrarse"><br><br><br>
                    <div class="text"> Al registrarte, aceptas nuestras Condiciones, la Política de privacidad y la Política de cookies.
                    <br> <a href="<?php echo FRONT_ROOT?>Home/Index"> Ya tienes una cuenta? </a>
                    </div>
                    <br><br><br><br>
                    <?php if($alert){?>
                        <div class="message">
                            <a><?php echo $alert["text"]?></a></div>
                        </div>
                    <?php } ?> 
            </div>
</form>

<?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>