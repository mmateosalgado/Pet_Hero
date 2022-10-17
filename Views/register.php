
<form action="" method="post">
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
                        Dueño <input type="radio" name="accountType" value="owner" required>
                        Guardián <input type="radio" name="accountType" value="guardian">
                    </div>
                    <div class="ac_type" >      
                        Mujer <input type="radio" name="gender" value="female" required>
                        Hombre <input type="radio" name="gender" value="male">
                        Otro <input type="radio" name="gender" value="other">
                    </div>
                    <input type="button" value="Registrarse"><br>
                    <div class="text"> Al registrarte, aceptas nuestras Condiciones, la Política de privacidad y la Política de cookies.
                     <br> <a href="<?php echo FRONT_ROOT?>Home/Index"> Ya tienes una cuenta? </a>
                    </div>
            </div>
</form>