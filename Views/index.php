<!DOCTYPE html>
<html>

    <head>
        <LINK REL=StyleSheet HREF="css/style.css" TYPE="text/css" MEDIA=screen>
    </head>
    <body>
    <div class="body"></div>
            <div class="grad"></div>
            <div class="header">
                <div>Pet<span>Hero</span></div>
            </div>
            <br>
            <div class="login">
                    <input type="text" placeholder="Nombre de usuario" name="user"><br>
                    <input type="password" placeholder="Contraseña" name="password"><br>
                    <input type="button" value="Iniciar Sesión"><br>
                    <div class="text">
                    <?php echo (FRONT_ROOT);?>
                    <a href="<?php echo ("http://localhost/".FRONT_ROOT."/Views/register.php");?>"> No tienes una cuenta? </a>
                    </div>
                </div>
    </body>
</html>