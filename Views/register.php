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
                    <input type="text" placeholder="Nombre de usuario" name="user" required><br>
                    <input type="text" placeholder="Nombre y Apellido" name="name" required><br>
                    <input type="text" placeholder="Email" name="email" required><br>
                    <input type="password" placeholder="Contraseña" name="password" required><br>
                    <input type="date" name="date" max="20-01-01" required><br>
                    <div class="ac_type" required>      
                        Dueño <input type="radio" name="accountType">
                        Guardián <input type="radio" name="accountType">
                    </div>
                    <div class="ac_type">      
                        Mujer <input type="radio" name="sexo">
                        Hombre <input type="radio" name="sexo">
                        Otro <input type="radio" name="sexo">
                    </div>
                    <input type="button" value="Registrarse"><br>
                    <div class="text"> Al registrarte, aceptas nuestras Condiciones, la Política de privacidad y la Política de cookies.
                     <br> <a href="<?php echo FRONT_ROOT?>Home/ViewRegister"> Ya tienes una cuenta? </a>
                    </div>
            </div>
            
          
    </body>

</html>