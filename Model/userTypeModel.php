<?php
    require_once "mainModel.php";
    /*--------- Modelo tipo de usuario ---------*/
    class userTypeModel extends mainModel{

        protected function add_user_type_model($data){
            $sql = mainModel::conectar()->prepare("INSERT INTO tipo_usuario(tipo_usuario_descripcion,tipo_usuario_estatus) VALUES(:Descripcion,:Estatus)");
            $sql->bindParam(":Descripcion", $data['Descripcion']);
            $sql->bindParam(":Estatus", $data['Estatus']);
            $sql->execute();
            return $sql;
        }
        
        protected function update_user_type_model($data){
            $sql = mainModel::conectar()->prepare("UPDATE tipo_usuario SET tipo_usuario_descripcion=:Descripcion,tipo_usuario_estatus=:Estatus WHERE tipo_usuario_id=:ID");
            $sql->bindParam(":ID", $data['ID']);
            $sql->bindParam(":Descripcion", $data['Descripcion']);
            $sql->bindParam(":Estatus", $data['Estatus']);
            $sql->execute();
            return $sql;
        }

        protected function delete_user_type_model($id){
            $sql = mainModel::conectar()->prepare("DELETE FROM tipo_usuario WHERE tipo_usuario_id=:ID");
            $sql->bindParam(":ID", $id);
            $sql->execute();
            return $sql;
        }

        protected function data_user_type_model($type, $id){
            if($type == "Only"){
                $sql = mainModel::conectar()->prepare("SELECT * FROM tipo_usuario WHERE tipo_usuario_id=:ID");
                $sql->bindParam(":ID", $id);
            }elseif($type == "Count"){
                $sql = mainModel::conectar()->prepare("SELECT tipo_usuario_id FROM tipo_usuario WHERE tipo_usuario_id!=1");
            }elseif($type == "All"){
                $sql = mainModel::conectar()->prepare("SELECT * FROM tipo_usuario WHERE tipo_usuario_estatus=1 ORDER BY tipo_usuario_id DESC");
            }
            $sql->execute();
            return $sql;
        }
    }