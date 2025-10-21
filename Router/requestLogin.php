<?php
$peticionAjax=true;
require_once ("../config/APP.php");
//petición a usuario
if(isset($_POST['id_bc'])){
    /*--------- Instancia al controlador ---------*/
    require_once ("../controller/loginController.php");
    $loginController = new loginController();

    /*--------- cerrar sesion ---------*/
    if(isset($_POST['usuario']) && isset($_POST['token'])){
        echo $loginController->log_out_controller();
    }
    
    /*--------- Editar un usuario ---------*/
    

    /*--------- Eliminar un usuario ---------*/
   

}