<!DOCTYPE html>
<html>

    <head>
        <!-- <LINK REL=StyleSheet HREF="css/style.css" TYPE="text/css" MEDIA=screen> -->
    </head>
    <body>
    <div class="body"></div>
            <div class="grad"></div>
            <div class="header">
                <div>Pet<span>Hero</span></div>
            </div>
            <br>
            <div class="login">
                    <input type="text" placeholder="Nombre de usuario" name="user" required><br>
                    <input type="password" placeholder="Contraseña" name="password" required><br>
                    <input type="button" value="Iniciar Sesión"><br>
                    <div class="text">
                    <a><?php echo "FRONT_ROOT.Home/Index" ?></a>
                    <a href="<?php echo FRONT_ROOT ?>Home/Index"> No tienes una cuenta? </a>
                    </div>
                </div>
    </body>
</html>