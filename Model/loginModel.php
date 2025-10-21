<?php
    require_once "mainModel.php";

    class loginModel extends mainModel{
            
            /*--------- Funcion iniciar sesion ---------*/
            protected static function log_in_model($data){
                $sql=self::conectar()->prepare("SELECT * FROM usuario WHERE usuario_username=:Username AND usuario_password=:Password AND usuario_estatus=1");
                $sql->bindParam(":Username",$data['username']);
                $sql->bindParam(":Password",$data['password']);
                $sql->execute();
                return $sql;
            }
    }