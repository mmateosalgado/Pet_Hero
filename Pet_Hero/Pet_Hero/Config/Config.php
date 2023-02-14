<?php namespace Config;


    define("ROOT", dirname(__DIR__) . "/");
    //Path to your project's root folder
    define("FRONT_ROOT", "/Ejercicios/Pet_Hero/Pet_Hero/Pet_Hero/");
    define("IMG_ROOT",ROOT."Views/Images");
    //EL ROOT DE ROMU:  /1Actividades/Pet_Hero/Pet_Hero/Pet_Hero/
    //EL ROOT DE SALGA: /FACULTAD XAMP/PET_HERO/Pet_Hero/Pet_Hero/Pet_Hero/
    //EL ROOT DE FERRA: /Ejercicios/Pet_Hero/Pet_Hero/Pet_Hero/
    define("VIEWS_PATH", "Views/");
    define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
    //define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
    define("IMG_PATH", FRONT_ROOT.VIEWS_PATH . "Images/");

    define("DB_HOST", "localhost");
    define("DB_NAME", "Pet_Hero");
    define("DB_USER", "root");
    define("DB_PASS", "");

    /*ZONA HORARIA*/
    date_default_timezone_set("America/Argentina/Buenos_Aires");

    /*MAILER*/
    define("HOST_MAIL", "smtp.gmail.com");
    define("USERNAME", "reserves.pethero@gmail.com");
    define("APP_PSW", "voxsasv");




?>




