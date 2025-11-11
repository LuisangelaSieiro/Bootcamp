<?php
	$peticionAjax=true;
	require_once "../config/APP.php";

    // petición a usuario
    if(isset($_POST['nombre-reg'])) { 
        /*--------- Instancia al controlador ---------*/


        require_once "../controller/userController.php";
        $userController = new userController();
        /*--------- Agregar usuario ---------*/
        if(isset($_POST['nombre-reg'])) {
              echo $userController->add_user_controller();
        }
           
    }else {
        session_start(['name'=>APP_NAME]);
        session_unset();
        session_destroy();
        header("Location: ".APP_URL."login/");
        exit();
    }