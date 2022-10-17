   <form action="<?php echo FRONT_ROOT . "Home/Login"?>" method="post">

            <div class="header">
                <div>Pet<span>Hero</span></div>
            </div>
            <br>
            <div class="login">
                    <input type="text" placeholder="Nombre de usuario" name="user" required><br>
                    <input type="password" placeholder="Contraseña" name="password" required><br>
                    <div class="ac_type" required>      
                        Dueño <input type="radio" name="accountType" value="owner" required>
                        Guardián <input type="radio" name="accountType" value="guardian">
                    </div>
                    <input type="submit" value="Iniciar Sesión"><br>
                    <div class="text">
                    <a> <?php if(isset($message)) 
                                { echo $message;} ?></a>
                    <a href="<?php echo FRONT_ROOT ?>Home/ViewRegister"> No tienes una cuenta? </a>
                    </div>
                </div>
   </form>
