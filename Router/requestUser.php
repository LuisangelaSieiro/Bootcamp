<?php
$peticionAjax=true;
require_once ("../config/APP.php");
//petición a usuario
if(isset($_POST['guardarUsuario'])){
    /*--------- Instancia al controlador ---------*/
    require_once ("../controller/userController.php");
    $userController = new userController();

    /*--------- Agregar un usuario ---------*/
    if(isset($_POST['nombre_reg'])){
        echo $userController->add_user_controller();
    }
    
    /*--------- Editar un usuario ---------*/
    

    /*--------- Eliminar un usuario ---------*/
   

}