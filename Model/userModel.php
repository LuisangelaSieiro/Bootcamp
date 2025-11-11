<?php
    require_once "./mainModel.php";
    /*--------- Modelo de usuario ---------*/
    class userModel extends mainModel{
        protected function add_user_model($data){
            $sql = mainModel::conectar()->prepare("INSERT INTO usuario(usuario_nombre,usuario_username,usuario_password,usuario_email,usuario_telefono,usuario_tipo,usuario_estatus) VALUES(:Nombre,:Usuario,:Password,:Email,:Telefono,:Tipo,:Estatus)");
            $sql->bindParam(":Nombre", $data['Nombre']);
            $sql->bindParam(":Usuario", $data['Username']);
            $sql->bindParam(":Password", $data['Password']);
            $sql->bindParam(":Email", $data['Email']);
            $sql->bindParam(":Telefono", $data['Telefono']);
            $sql->bindParam(":Tipo", $data['Tipo']);
            $sql->bindParam(":Estatus", $data['Estatus']);
            $sql->execute();
            return $sql;
        }
        
        protected function update_user_model($data){
            $sql = mainModel::conectar()->prepare("UPDATE usuario SET usuario_nombre=:Nombre,usuario_username=:Usuario,usuario_password=:Password,usuario_email=:Email,usuario_telefono=:Telefono,usuario_tipo=:Tipo,usuario_estatus=:Estatus WHERE usuario_id=:ID");
            $sql->bindParam(":ID", $data['ID']);
            $sql->bindParam(":Nombre", $data['Nombre']);
            $sql->bindParam(":Usuario", $data['Username']);
            $sql->bindParam(":Password", $data['Password']);
            $sql->bindParam(":Email", $data['Email']);
            $sql->bindParam(":Telefono", $data['Telefono']);
            $sql->bindParam(":Tipo", $data['Tipo']);
            $sql->bindParam(":Estatus", $data['Estatus']);
            $sql->execute();
            return $sql;
        }

        protected function delete_user_model($id){
            $sql = mainModel::conectar()->prepare("DELETE FROM usuario WHERE usuario_id=:ID");
            $sql->bindParam(":ID", $id);
            $sql->execute();
            return $sql;
        }

        protected function data_user_model($type, $id){
            if($type == "Only"){
                $sql = mainModel::conectar()->prepare("SELECT * FROM usuario WHERE usuario_id=:ID");
                $sql->bindParam(":ID", $id);
            }elseif($type == "Count"){
                $sql = mainModel::conectar()->prepare("SELECT usuario_id FROM usuario WHERE usuario_id!=1");
            }
            $sql->execute();
            return $sql;
        }
    }