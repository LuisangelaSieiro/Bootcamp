<?php
    if($peticionAjax){
        require_once "../model/loginModel.php";
    }else{
        require_once "./model/loginModel.php";
    }

    class loginController extends loginModel {
        // Controlador para iniciar sesion //
        public function log_in_controller(){
            /*== Limpiando los campos ==*/
            $username=mainModel::clean_string($_POST['username_login']);
            $password=mainModel::clean_string($_POST['password_login']);

            /*== Verificando campos vacios ==*/
            if($username=="" || $password==""){
                echo '
				<script>
					Swal.fire({
						title: "Ocurrio un error inesperado",
						text: "No has llenado todos los campos que son requeridos",
						icon: "error",
						confirmButtonText: "Aceptar"
					});
				</script>
				';
				exit();
            }

            /*== Verificando integridad de los datos ==*/
            if(mainModel::verificar_datos("[a-zA-Z0-9]{1,35}",$username)){
                echo '
				<script>
					Swal.fire({
						title: "Ocurrio un error inesperado",
						text: "El NOMBRE DE USUARIO no coincide con el formato solicitado",
						icon: "error",
						confirmButtonText: "Aceptar"
					});
				</script>
				';
				exit();
            }elseif(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$password)){
                echo '
				<script>
					Swal.fire({
						title: "Ocurrio un error inesperado",
						text: "La CLAVE no coincide con el formato solicitado",
						icon: "error",
						confirmButtonText: "Aceptar"
					});
				</script>
				';
				exit();
            }

            /*== Comprobando si el usuario existe ==*/
            $datosLogin=[
                "username"=>$username,
                "password"=>mainModel::encryption($password)
            ];

            $checkLogin=loginModel::log_in_model($datosLogin);

            if($checkLogin->rowCount()==1){
                $row=$checkLogin->fetch(PDO::FETCH_ASSOC);
                
                /*== Generando una nueva session ==*/
                session_start(['name'=>'BC']);
                $_SESSION['id_bc']=$row['usuario_id'];
                $_SESSION['nombre_bc']=$row['usuario_nombre'];
                $_SESSION['usuario_bc']=$row['usuario_username'];
                $_SESSION['tipo_bc']=$row['usuario_tipo'];
                $_SESSION['token_bc']=md5(uniqid(mt_rand(),true));

                return header('Location: '.APP_URL.'dashboard/');
            }else{
                echo '
                <script>
                    Swal.fire({
                        title: "Ocurrio un error inesperado",
                        text: "El NOMBRE DE USUARIO o la CLAVE son incorrectos",
                        icon: "error",
                        confirmButtonText: "Aceptar"
                    });
                </script>
                ';
                exit();
            }
        }/*-- Fin controlador --*/

        /*== Forzar cierre de sesion ==*/
        public function force_log_out_controller(){
            session_unset();
            session_destroy();
            if(headers_sent()){
                return header('Location: '.APP_URL.'login/');
            }else{
                return header('Location: '.APP_URL.'login/');
            }
        }/*-- Fin controlador --*/

        /*== cierre de sesion ==*/
        public function log_out_controller(){
            session_start(['name'=>'BC']);
            $token=mainModel::decryption($_POST['token']);
            $usuario=mainModel::decryption($_POST['usuario']);

            if($token==$_SESSION['token_bc'] && $usuario==$_SESSION['usuario_bc']){
                session_unset();
                session_destroy();
                $alert=[
					"Alerta"=>"redireccionar",
					"URL"=>APP_URL."login/"
				];
            }else{
                $alert=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se pudo cerrar la sesion en el sistema",
					"Tipo"=>"error"
				];
            }
            echo json_encode($alert);
        }/*-- Fin controlador --*/
    }/*-- Fin de la clase --*/

