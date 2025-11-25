<?php
	$peticionAjax=true;
	require_once "../config/APP.php";
    //petición a tipo de usuario
    if (isset($_POST['guardarTipoUsuario']) || isset($_POST['id_up']) || isset($_POST['id_del'])) { 
        /*--------- Instancia al controlador ---------*/
        require_once "../controller/userTypeController.php";
        $userTypeController = new userTypeController();

        /*--------- Agregar un tipo de usuario ---------*/
        if(isset($_POST['descripcion_reg'])){
            echo $userTypeController->add_user_type_controller();
        }
        
        /*--------- Editar un tipo de usuario ---------*/
        if(isset($_POST['id_up'])){
            echo $userTypeController->update_user_type_controller();
        }

        /*--------- Eliminar un tipo de usuario ---------*/
        if(isset($_POST['id_del'])){
            echo $userTypeController->delete_user_type_controller();
        }
    
    }else {
        session_start(['name'=>APP_NAME]);
        session_unset();
        session_destroy();
        header("Location: ".APP_URL."login/");
        exit();
    }