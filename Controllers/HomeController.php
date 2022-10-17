<?php
namespace Controllers;
class HomeController
{
    public function Index($messasge = "")
    {
        require_once(VIEWS_PATH."login.php");
    }

    public function ViewRegister()
    {
        require_once(VIEWS_PATH."register.php");
    }
}
?>