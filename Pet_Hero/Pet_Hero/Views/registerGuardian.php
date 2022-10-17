<form action="<?php echo FRONT_ROOT . "Home/Login"?>" method="post">

            <div class="header">
                <div>Pet<span>Hero</span></div><br>
                <div>Guard<span>ianes:</span></div>
            </div>
            <br>
            <div class="login">
                    <input type="text" placeholder="Cuil" name="cuil" required><br>
                    <input type="number" placeholder="Precio por hora" name="precioPorHora" min="0" step="50" required><br>
                    <input type="submit" value="Terminar Registro"><br>
                    <div class="text">
                    </div>
                </div>
   </form>