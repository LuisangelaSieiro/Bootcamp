<?php 
    if($peticionAjax){
        require_once "../model/userTypeModel.php";
    }else{
        require_once "./model/userTypeModel.php";
    }

    class userTypeController extends userTypeModel{
        public function add_user_type_controller(){
            
             //Recibiendo datos del usuario
            $Descripcion = mainModel::clean_string($_POST['descripcion_reg']);
            $estatus = mainModel::clean_string($_POST['estatus_reg']);

            /*== comprobar campos vacios ==*/
            if($Descripcion == "" || $estatus == ""){
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "No has llenado todos los campos que son obligatorios",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*== Verificando integridad de los datos ==*/

            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,30}", $Descripcion)){
                $alert = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El Descripcion del tipo de usuario no coincide con el formato solicitado: [a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,30}",
                    "Tipo" => "error"
                ];
                echo json_encode($alert);
                exit();
            }

            /*== Comprobando estatus ==*/
                if($estatus != "1" && $estatus != "0"){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"El ESTATUS seleccionado no es valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $data_user_type_reg = [
                "Descripcion" => $Descripcion,
                "Estatus" => $estatus
            ];

            $add_user_type = userTypeModel::add_user_type_model($data_user_type_reg);

            if($add_user_type->rowCount() == 1){
                $alert = [
                    "Alerta" => "limpiar",
                    "Titulo" => "Tipo de usuario registrado",
                    "Texto" => "El tipo de usuario se ha registrado con éxito en el sistema",
                    "Tipo" => "success"
                ];
            }else{
                $alert = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El tipo de usuario no se ha registrado en el sistema",
                    "Tipo" => "error"
                ];
            }
            echo json_encode($alert);
            exit();
        }

        public function list_user_type_controller(){
            $query = mainModel::ejecutar_consulta_simple("SELECT * FROM tipo_usuario");
            $datos = $query->fetchAll();

            $table = '<div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">DESCRIPCIÓN</th>
                            <th class="text-center">ESTATUS</th>
                            <th class="text-center">ACTUALIZAR</th>
                            <th class="text-center">ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>';
            if($query->rowCount() > 0){
                $num = 0;
                foreach($datos as $rows){
                    $num++;
                    $table .= '<tr>
                        <td class="text-center">'.$num.'</td>
                        <td class="text-center">'.$rows['tipo_usuario_descripcion'].'</td>
                        <td class="text-center">';
                        if($rows['tipo_usuario_estatus'] == 1){
                            $table .= '<span class="badge badge-success">Activo</span>';
                        }else{
                            $table .= '<span class="badge badge-danger">Inactivo</span>';
                        }
                        $table .= '</td>
                        <td class="text-center">
                            <a href="'.APP_URL.'user-type-update/'.mainModel::encryption($rows['tipo_usuario_id']).'/" class="btn btn-primary">
                                <i class="fas fa-fw fa-wrench"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <form class="FormularioAjax" action="'.APP_URL.'router/requestUserType.php" method="POST" data-form="delete" autocomplete="off">
                                <input type="hidden" name="id_del" value="'.mainModel::encryption($rows['tipo_usuario_id']).'">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-fw fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>';
                }
            }else{
                $table .= '<tr>
                    <td colspan="5" class="text-center">No hay registros en el sistema</td>
                </tr>';
            }
                
            $table .= '</tbody>
                </table>';
            $table .= '</div>';
            
            return $table;

        }
        
        public function update_user_type_controller(){
            //recibir los datos del formulario
            $id = mainModel::decryption($_POST['id_up']);
            $id = mainModel::clean_string($id);
            $Descripcion = mainModel::clean_string($_POST['descripcion_up']);
            $estatus = mainModel::clean_string($_POST['estatus_up']);

            /*== comprobar campos vacios ==*/
            if($Descripcion == "" || $estatus == ""){
                $alerta = [
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"Todos los campos son obligatorios",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }
            /*== fin comprobar campos vacios ==*/

            /*== Verificando integridad de los datos ==*/

            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,30}", $Descripcion)){
                $alert = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El nombre del tipo de usuario no coincide con el formato solicitado: [a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,30}",
                    "Tipo" => "error"
                ];
                echo json_encode($alert);
                exit();
            }

            /*== Comprobando estatus ==*/
            if($estatus != "1" && $estatus != "0"){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"El ESTATUS seleccionado no es valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $data_user_type_up = [
                "ID" => $id,
                "Descripcion" => $Descripcion,
                "Estatus" => $estatus
            ];
            $update_user_type = userTypeModel::update_user_type_model($data_user_type_up);
            if($update_user_type){
                $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "Tipo de usuario actualizado",
                    "Texto" => "El tipo de usuario se ha actualizado con éxito en el sistema",
                    "Tipo" => "success"
                ];
            }else{
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El tipo de usuario no se ha actualizado en el sistema",
                    "Tipo" => "error"
                ];
            }
            echo json_encode($alerta);
            exit();
        }
        
        public function delete_user_type_controller(){
            $id = mainModel::decryption($_POST['id_del']);
            $id = mainModel::clean_string($id);

            // comprobar el tipo de usuario
            $check_user_type = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_tipo='$id'");
            if($check_user_type->rowCount() > 0){
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "No podemos eliminar este tipo de usuario ya que hay usuarios registrados con este tipo",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            
            
            $delete_user_type = userTypeModel::delete_user_type_model($id);
            if($delete_user_type){
                $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "Tipo de usuario eliminado",
                    "Texto" => "El tipo de usuario se ha eliminado con éxito en el sistema",
                    "Tipo" => "success"
                ];
            }else{
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El tipo de usuario no se ha eliminado en el sistema",
                    "Tipo" => "error"
                ];
            }
            echo json_encode($alerta);
            exit();
        }

        public function show_user_type_controller($type, $id){
            $type = mainModel::clean_string($type);
            $id = mainModel::decryption($id);
            $id = mainModel::clean_string($id);

            if($type == "Only"){
                $query = userTypeModel::data_user_type_model($type, $id);
                if($query->rowCount() == 1){
                    $data = $query->fetch();
                }else{
                    $data = false;
                }
            }elseif($type == "Count"){
                $query = userTypeModel::data_user_type_model($type, $id);
                $data = $query->rowCount();
            }elseif($type == "All"){
                $query = userTypeModel::data_user_type_model($type, $id);
                $data = $query->fetchAll();

            }else{
                $data = false;
            }
            return $data;
        }

    }