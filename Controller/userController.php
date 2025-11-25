<?php
    if($peticionAjax){
        require_once "../model/userModel.php";
    }else{
        require_once "./model/userModel.php";
    }

class userController extends userModel {
    /*== Controlador para agregar un usuario ==*/
    public function  add_user_controller(){
        // $alert = [
        //     "Alerta" => "simple",
        //     "Titulo" => "todo bien",
        //     "Texto" => "",
        //     "Tipo" => "success"
        // ];
        // echo json_encode($alert);
        // exit();
        /*== recibir campos via post ==*/
        $nombre = mainModel::clean_string($_POST['nombre_reg']);
        $usuario = mainModel::clean_string($_POST['usuario_reg']);
        $password = mainModel::clean_string($_POST['password_reg']);
        $password2 = mainModel::clean_string($_POST['password2_reg']);
        $email = mainModel::clean_string($_POST['email_reg']);
        $telefono = mainModel::clean_string($_POST['telefono_reg']);
        $tipo = mainModel::clean_string($_POST['tipo_reg']);
        $estatus = mainModel::clean_string($_POST['estatus_reg']);
        
        /*== comprobar campos vacios ==*/
        if($nombre=="" || $usuario=="" || $password=="" || $password2=="" || $telefono=="" || $tipo=="" || $estatus==""){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();
        }

        /*== Verificando integridad de los datos ==*/

        if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,50}", $nombre)){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Campo Nombre no coincide con el formato solicitado: [a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,50}",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();
        }

        if(mainModel::verificar_datos("[a-zA-ZñÑ0-9]{5,35}", $usuario)){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Campo Usuario no coincide con el formato solicitado: [a-zA-ZñÑ0-9]{5,35}",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();
        }

        // if(mainModel::verificar_datos("a-zA-Z0-9ñÑ]{7,35}", $password)){
        //     $alert = [
        //         "Alerta" => "simple",
        //         "Titulo" => "Ocurrió un error inesperado",
        //         "Texto" => "El Campo Contraseña no coincide con el formato solicitado: [a-zA-Z0-9ñÑ*$.#]{7,35}",
        //         "Tipo" => "error"
        //     ];
        //     echo json_encode($alert);
        //     exit();
        // }

        if(mainModel::verificar_datos("[a-zA-Z0-9ñÑ]{7,35}", $password2)){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Campo Repetir Contraseña no coincide con el formato solicitado: [a-zA-Z0-9ñÑ*$.#]{7,35}",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();
        }

        if($password != $password2){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Las contraseñas no coinciden",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();
        }

        /*== Comprobando email ==*/
        if($email!=""){
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                $check_email=mainModel::ejecutar_consulta_simple("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
                if($check_email->rowCount()>0){
                    $alert=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrió un error inesperado",
                        "Texto"=>"El EMAIL ingresado ya se encuentra registrado en el sistema",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alert);
                    exit();
                }
            }else{
                $alert=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"Ha ingresado un correo no valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alert);
                exit();
            }
        }

        if(mainModel::verificar_datos("[0-9+]{11,15}",$telefono)){
            $alert=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"El Campo Telefono no coincide con el formato solicitado:[0-9+]{11,15}",
                "Tipo"=>"error"
            ];
            echo json_encode($alert);
            exit();
        }

        if($tipo==""){
            $alert=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"Selecione un tipo de usuario",
                "Tipo"=>"error"
            ];
            echo json_encode($alert);
            exit();
        }

        if($estatus!=0 && $estatus!=1){
            $alert=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"El estutus del usuario no es valido",
                "Tipo"=>"error"
            ];
            echo json_encode($alert);
            exit();
        }

        $password = mainModel::encryption($password);

        $data = [
            "Nombre" => $nombre,
            "Username" => $usuario,
            "Password" => $password,
            "Email" => $email,
            "Telefono" => $telefono,
            "Tipo" => $tipo,
            "Estatus" => $estatus
        ];

        $add_user = userModel::add_user_model($data);

        if($add_user->rowCount() == 1){
            $alert = [
                "Alerta" => "limpiar",
                "Titulo" => "Usuario registrado",
                "Texto" => "El usuario se ha registrado con éxito",
                "Tipo" => "success"
            ];
        }else{
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se ha podido registrar el usuario",
                "Tipo" => "error"
            ];
        }
        
        echo json_encode($alert);
        exit();
    }/*-- Fin controlador --*/

    /*== Controlador para listar usuarios ==*/
    public function list_user_controller(){
        $id_bc = $_SESSION['id_bc'];
        $query = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usuario_id != 1 AND usuario_id != $id_bc ORDER BY usuario_nombre ASC");
        $datos = $query->fetchAll();

        $table = '<div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Tipo Usuario</th>
                        <th class="text-center">Estatus</th>
                        <th class="text-center">Modificar</th>
                        <th class="text-center">Eliminar</th>
                    </tr>
                </thead>
                <tbody>';
        if($query->rowCount() > 0){
            $num = 0;
            foreach($datos as $rows){
                $num++;
                $table .= '<tr>
                    <td class="text-center">'.$num.'</td>
                    <td class="text-center">'.$rows['usuario_nombre'].'</td>
                    <td class="text-center">'.$rows['usuario_email'].'</td>
                    <td class="text-center">'.mainModel::buscar_valor("tipo_usuario","tipo_usuario_id",$rows['usuario_tipo'],"tipo_usuario_descripcion").'</td>
                    <td class="text-center">';
                    if($rows['usuario_estatus'] == 1){
                        $table .= '<span class="badge badge-success">Activo</span>';
                    }else{
                        $table .= '<span class="badge badge-danger">Inactivo</span>';
                    }
                    $table .= '</td>
                    <td class="text-center">
                        <a href="'.APP_URL.'user-update/'.mainModel::encryption($rows['usuario_id']).'/" class="btn btn-primary">
                            <i class="fas fa-fw fa-wrench"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <form class="FormularioAjax" action="'.APP_URL.'router/requestUser.php" method="POST" data-form="delete" autocomplete="off">
                            <input type="hidden" name="id_del" value="'.mainModel::encryption($rows['usuario_id']).'">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>';
            }
        }else{
            $table .= '<tr>
                <td colspan="8" class="text-center">No hay registros en el sistema</td>
            </tr>';
        }
            
        $table .= '</tbody>
            </table>';
        $table .= '</div>';
        
        return $table;

    }/*-- Fin controlador --*/

    /*== Controlador para modificar usuario ==*/
    public function update_user_controller(){  
        // recibir id//
        $id = mainModel::decryption($_POST['id_up']);
        $id = mainModel::clean_string($id);

        // recibir campos via post //
        $nombre = mainModel::clean_string($_POST['nombre_up']);
        $usuario = mainModel::clean_string($_POST['usuario_up']);
        $email = mainModel::clean_string($_POST['email_up']);
        $telefono = mainModel::clean_string($_POST['telefono_up']);
        $tipo = mainModel::clean_string($_POST['tipo_up']);
        $estatus = mainModel::clean_string($_POST['estatus_up']);

        /*== comprobar campos vacios ==*/
        if($nombre=="" || $usuario=="" || $telefono=="" || $tipo=="" || $estatus==""){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();

             if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,50}", $nombre)){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Campo Nombre no coincide con el formato solicitado: [a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,50}",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();
        }

        if(mainModel::verificar_datos("[a-zA-ZñÑ0-9]{5,35}", $usuario)){
            $alert = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Campo Usuario no coincide con el formato solicitado: [a-zA-ZñÑ0-9]{5,35}",
                "Tipo" => "error"
            ];
            echo json_encode($alert);
            exit();
        }

         if($email!=""){
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                $check_email=mainModel::ejecutar_consulta_simple("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
                if($check_email->rowCount()>0){
                    $alert=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrió un error inesperado",
                        "Texto"=>"El EMAIL ingresado ya se encuentra registrado en el sistema",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alert);
                    exit();
                }
            }else{
                $alert=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"Ha ingresado un correo no valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alert);
                exit();
            }
        }

        if(mainModel::verificar_datos("[0-9+]{11,15}",$telefono)){
            $alert=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"El Campo Telefono no coincide con el formato solicitado:[0-9+]{11,15}",
                "Tipo"=>"error"
            ];
            echo json_encode($alert);
            exit();
        }

        if($tipo==""){
            $alert=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"Selecione un tipo de usuario",
                "Tipo"=>"error"
            ];
            echo json_encode($alert);
            exit();
        }

        if($estatus!=0 && $estatus!=1){
            $alert=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"El estutus del usuario no es valido",
                "Tipo"=>"error"
            ];
            echo json_encode($alert);
            exit();
        }
        $data_user_model = [
            "ID" => $id,
            "Nombre" => $nombre,
            "Username" => $usuario,
            "Email" => $email,
            "Telefono" => $telefono,
            "Tipo" => $tipo,
            "Estatus" => $estatus
        ];

    // actualizar usuario //
    $update_user = userModel::update_user_model($data_user_up);
    if($update_user->rowCount() == 1){
        $alert = [
            "Alerta" => "recargar",
            "Titulo" => "Usuario actualizado",
            "Texto" => "Los datos del usuario han sido actualizados con éxito",
            "Tipo" => "success"
        ];
    }else{
        $alert = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "No se ha podido actualizar los datos del usuario",
            "Tipo" => "error"
        ]; 

        }
        echo json_encode($alert);
        exit();
    }
}// fin controlador

    /*== Controlador para eliminar usuario ==*/
    public function delete_user_controller(){
        // recibir el id del usuario //
        $id = mainModel::decryption($_POST['id_del']);
        $id = mainModel::clean_string($id);

    // comprobar si el usuario existe //
    $check_user = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id='$id'");
    if($check_user->rowCount()<=0){
        $alert = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "El usuario que intenta eliminar no existe en el sistema",
            "Tipo" => "error"
        ];
        echo json_encode($alert);
        exit();
    }
    // eliminar el usuario //
    $delete_user = userModel::delete_user_model($id);
    if($delete_user->rowCount() == 1){
        $alert = [
            "Alerta" => "recargar",
            "Titulo" => "Usuario eliminado",
            "Texto" => "El usuario ha sido eliminado del sistema",
            "Tipo" => "success"
        ];
    }else{
        $alert = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "No se ha podido eliminar el usuario",
            "Tipo" => "error"
        ];
    }
    echo json_encode($alert);
    exit();

    }// fin controlador

    /*== Controlador para mostrar datos de usuario ==*/
    public function show_user_controller($type, $id){
        //limpiar datos//
        $type = mainModel::clean_string($type);
        $id = mainModel::decryption($id);
        $id = mainModel::clean_string($id);

            if($type == "Only"){
                $query = userModel::data_user_model($type, $id);
                if($query->rowCount() == 1){
                    $data = $query->fetch();
                }else{
                    $data = false;
                }
            }elseif($type == "Count"){
                $query = userModel::data_user_model($type, $id);
                $data = $query->rowCount();
            }elseif($type == "All"){
                $query = userModel::data_user_model($type, $id);
                $data = $query->fetchAll();

            }else{
                $data = false;
            }
            return $data;
        }
    }// fin controlador


