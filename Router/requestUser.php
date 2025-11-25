<?php
$peticionAjax=true;
require_once ("../config/APP.php");
//petición a usuario
if(isset($_POST['guardarUsuario']) || isset($_POST['id_up']) || isset($_POST['id_del'])){
    /*--------- Instancia al controlador ---------*/
    require_once ("../controller/userController.php");
    $userController = new userController();

    /*--------- Agregar un usuario ---------*/
    if(isset($_POST['nombre_reg'])){
        echo $userController->add_user_controller();
    }
    
    /*--------- Editar un usuario ---------*/
    if(isset($_POST['id_up'])){
        echo $userController->update_user_controller();
    }
    
    /*--------- Eliminar un usuario ---------*/
    if(isset($_POST['id_del'])){
        echo $userController->delete_user_controller();
    }
   
}else {
    session_start(['name'=>APP_NAME]);
    session_unset();
    session_destroy();
    header("Location: ".APP_URL."login/");
}