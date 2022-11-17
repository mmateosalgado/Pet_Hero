<?php 
require_once(VIEWS_PATH."Section/header.php");?>

   <form action="<?php echo FRONT_ROOT . "Home/Login"?>" method="post">

            <div class="header">
                <div>Pet<span>Hero</span></div>
            </div>
            <br>
            <div class="login hovers">
                    <input type="text" placeholder="Nombre de usuario" name="user" required><br>
                    <input type="password" placeholder="Contraseña" name="password" required><br>
                    <div class="ac_type" required>      
                        Dueño <input type="radio" name="accountType" value="owner" required>
                        Guardián <input type="radio" name="accountType" value="guardian">
                    </div>
                    <input type="submit" value="Iniciar Sesión"><br>
                    
                <div class="text">
                <a href="<?php echo FRONT_ROOT ?>Home/ViewRegister"> No tienes una cuenta? </a>
            </div>
            <br>
                        
                     <?php if(isset($message)) 
                                { echo "<div class='message'><a>". $message."</a></div>";} ?>
            </div>
   </form>

<?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>