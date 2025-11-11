<?php 
    if($peticionAjax){
        require_once "../model/userModel.php";
    }else{
        require_once "./model/userModel.php";
    }

    class userController extends userModel{
        public function add_user_controller(){
             $alert = [
                    "Alerta" => "simple",
                    "Titulo" => "",
                    "Texto" => "",
                    "Tipo" => "success"
                ];
                echo json_encode($alert);
                exit();
                // Recibiendo los datos del formulario
            $nombre = mainModel::clean_string($_POST['nombre-reg']);
            $usuario = mainModel::clean_string($_POST['usuario-reg']);
            $password = mainModel::clean_string($_POST['password1-reg']);
            $password2 = mainModel::clean_string($_POST['password2-reg']);
            $email = mainModel::clean_string($_POST['email-reg']);
            $telefono = mainModel::clean_string($_POST['telefono-reg']);
            $tipo = mainModel::clean_string($_POST['tipo-reg']);
            $estatus = mainModel::clean_string($_POST['estatus-reg']);

            /*== comprobar campos vacios ==*/
            if($nombre == "" || $usuario == "" || $password == "" || $password2 == "" || $email == "" || $tipo == "" || $estatus == ""){
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
            

            if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,35}",$nombre)){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El NOMBRE no coincide con el formato solicitado: [a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,35}",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}

            if(mainModel::verificar_datos("[a-zA-Z0-9]{5,20}",$usuario)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"El USUARIO no coincide con el formato solicitado: [a-zA-Z0-9]{5,20}",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if($password != "" && $password2 != ""){
                if($password != $password2){
                    $alert = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto" => "Las contraseñas que acabas de ingresar no coinciden",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alert);
                    exit();
                }else{
                    $password = mainModel::encryption($password);
                }
            }  
            
            /*== Verificando integridad de los datos ==*/
            if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$password)){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"La CONTRASEÑA no coincide con el formato solicitado: [a-zA-Z0-9$@.-]{7,100}",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
                exit();
            }

            /*== Comprobando email ==*/
			if($email!=""){
				if(filter_var($email,FILTER_VALIDATE_EMAIL)){
					$check_email=mainModel::ejecutar_consulta_simple("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
					if($check_email->rowCount()>0){
						$alerta=[
							"Alerta"=>"simple",
							"Titulo"=>"Ocurrió un error inesperado",
							"Texto"=>"El EMAIL ingresado ya se encuentra registrado en el sistema",
							"Tipo"=>"error"
						];
						echo json_encode($alerta);
						exit();
					}
				}else{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"Ha ingresado un correo no valido",
						"Tipo"=>"error"
					];
					echo json_encode($alerta);
					exit();
				}
			}

            /*== Comprobando telefono ==*/
            if($telefono!=""){
                if(mainModel::verificar_datos("[0-9()+]{8,20}",$telefono)){
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrió un error inesperado",
                        "Texto"=>"El TELEFONO no coincide con el formato solicitado: [0-9()+]{8,20}",
                        "Tipo"=>"error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            
            /*== Comprobando tipo de usuario ==*/
            if($tipo != "1" /*&& $tipo != "Editor" && $tipo != "Supervisor" && $tipo != "Cliente"*/){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"El TIPO DE USUARIO seleccionado no es valido",
                    "Tipo"=>"error"
                ];
                echo json_encode($alerta);
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

            $data_user_reg = [
                "Nombre" => $nombre,
                "Usuario" => $usuario,
                "Password" => $password,
                "Email" => $email,
                "Telefono" => $telefono,
                "Tipo" => $tipo,
                "Estatus" => $estatus
            ];

            $add_user = userModel::add_user_model($data_user_reg);

            if($add_user->rowCount() == 1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"Usuario registrado",
                    "Texto"=>"El usuario se registro con exito en el sistema",
                    "Tipo"=>"success"
                ];
            }else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos podido registrar el usuario",
                    "Tipo"=>"error"
                ];
            }
            echo json_encode($alerta);
        } /* Fin del controlador */

        // public function update_user_controller(){
        //     // Recibiendo el id
		// 	$id=mainModel::decryption($_POST['usuario-id-up']);
		// 	$id=mainModel::clean_string($id);

        //     // Comprobando el usuario en la base de datos
		// 	$check_user=mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usuario_id='$id'");
		// 	if($check_user->rowCount()<=0){
		// 		$alerta=[
		// 			"Alerta"=>"simple",
		// 			"Titulo"=>"Ocurrió un error inesperado",
		// 			"Texto"=>"No hemos encontrado el usuario en el sistema",
		// 			"Tipo"=>"error"
		// 		];
		// 		echo json_encode($alerta);
		// 		exit();
		// 	}else{
		// 		$campos=$check_user->fetch();
		// 	}


        //     $nombre = mainModel::clean_string($_POST['nombre-up']);
        //     $usuario = mainModel::clean_string($_POST['usuario-up']);
        //     $password = mainModel::clean_string($_POST['password-up']);
        //     $password2 = mainModel::clean_string($_POST['password2-up']);
        //     $email = mainModel::clean_string($_POST['email-up']);
        //     $telefono = mainModel::clean_string($_POST['telefono-up']);
        //     $tipo_usuario = mainModel::clean_string($_POST['tipo-up']);
        //     $estatus = mainModel::clean_string($_POST['estatus-up']);

        //     /*== comprobar campos vacios ==*/
        //     if($nombre == "" || $usuario == "" || $email == "" || $tipo_usuario == "" || $estatus == ""){
        //         $alert = [
        //             "Alerta" => "simple",
        //             "Titulo" => "Ocurrió un error inesperado",
        //             "Texto" => "No has llenado todos los campos que son obligatorios",
        //             "Tipo" => "error"
        //         ];
        //         echo json_encode($alert);
        //         exit();     
        //     }

        //     /*== Verificando integridad de los datos ==*/
        //     if(mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,35}",$nombre)){
        //         $alert = [
        //             "Alerta" => "simple",
        //             "Titulo" => "Ocurrió un error inesperado",
        //             "Texto" => "El NOMBRE no coincide con el formato solicitado: [a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,35}",
        //             "Tipo" => "error"
        //         ];
        //         echo json_encode($alert);
        //         exit();
        //     } 
            
        //     if(mainModel::verificar_datos("[a-zA-Z0-9]{5,35}",$usuario)){
        //         $alert = [
        //             "Alerta" => "simple",
        //             "Titulo" => "Ocurrió un error inesperado",
        //             "Texto" => "El USUARIO no coincide con el formato solicitado: [a-zA-Z0-9]{5,35}",
        //             "Tipo" => "error"
        //         ];
        //         echo json_encode($alert);
        //         exit();
        //     }

        //     if(mainModel::verificar_datos("[0-9()+]{8,20}",$telefono)){
        //         $alerta=[
        //             "Alerta"=>"simple",
        //             "Titulo"=>"Ocurrió un error inesperado",
        //             "Texto"=>"El TELEFONO no coincide con el formato solicitado: [0-9()+]{8,20}",
        //             "Tipo"=>"error"
        //         ];
        //         echo json_encode($alerta);
        //         exit();
        //     }

        //     /*== Comprobando usuario ==*/
		// 	if($usuario!=$campos['usuario_usuario']){
		// 		$check_user=mainModel::ejecutar_consulta_simple("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
		// 		if($check_user->rowCount()>0){
		// 			$alerta=[
		// 				"Alerta"=>"simple",
		// 				"Titulo"=>"Ocurrió un error inesperado",
		// 				"Texto"=>"El NOMBRE DE USUARIO ingresado ya se encuentra registrado en el sistema",
		// 				"Tipo"=>"error"
		// 			];
		// 			echo json_encode($alerta);
		// 			exit();
		// 		}	
		// 	}


		// 	/*== Comprobando email ==*/
		// 	if($email!=$campos['usuario_email'] && $email!=""){
		// 		if(filter_var($email,FILTER_VALIDATE_EMAIL)){
		// 			$check_email=mainModel::ejecutar_consulta_simple("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
		// 			if($check_email->rowCount()>0){
		// 				$alerta=[
		// 					"Alerta"=>"simple",
		// 					"Titulo"=>"Ocurrió un error inesperado",
		// 					"Texto"=>"El nuevo email ingresado ya se encuentra registrado en el sistema",
		// 					"Tipo"=>"error"
		// 				];
		// 				echo json_encode($alerta);
		// 				exit();
		// 			}
		// 		}else{
		// 			$alerta=[
		// 				"Alerta"=>"simple",
		// 				"Titulo"=>"Ocurrió un error inesperado",
		// 				"Texto"=>"Ha ingresado un correo no valido",
		// 				"Tipo"=>"error"
		// 			];
		// 			echo json_encode($alerta);
		// 			exit();
		// 		}
		// 	}

        //     /*== Comprobando telefono ==*/
        //     if($telefono!=$campos['usuario_telefono'] && $telefono!=""){
        //         $check_phone=mainModel::ejecutar_consulta_simple("SELECT usuario_telefono FROM usuario WHERE usuario_telefono='$telefono'");
        //         if($check_phone->rowCount()>0){
        //             $alerta=[
        //                 "Alerta"=>"simple",
        //                 "Titulo"=>"Ocurrió un error inesperado",
        //                 "Texto"=>"El TELEFONO ingresado ya se encuentra registrado en el sistema",
        //                 "Tipo"=>"error"
        //             ];
        //             echo json_encode($alerta);
        //             exit();
        //         }
        //     }

        //     /*== Comprobando tipo de usuario ==*/
        //     if($tipo_usuario!=$campos['usuario_tipo'] && $tipo_usuario!=""){
        //         if($tipo_usuario!="Administrador" && $tipo_usuario!="Editor" && $tipo_usuario!="Supervisor"){
        //             $alerta=[
        //                 "Alerta"=>"simple",
        //                 "Titulo"=>"Ocurrió un error inesperado",
        //                 "Texto"=>"El TIPO DE USUARIO seleccionado no es valido",
        //                 "Tipo"=>"error"
        //             ];
        //             echo json_encode($alerta);
        //             exit();
        //         }
        //     }

        //     /*== Comprobando estatus ==*/
        //     if($estatus!=$campos['usuario_estatus'] && $estatus!=""){
        //         if($estatus!="1" && $estatus!="0"){
        //             $alerta=[
        //                 "Alerta"=>"simple",
        //                 "Titulo"=>"Ocurrió un error inesperado",
        //                 "Texto"=>"El ESTATUS seleccionado no es valido",
        //                 "Tipo"=>"error"
        //             ];
        //             echo json_encode($alerta);
        //             exit();
        //         }
        //     }
            
        //     $data_user_update = [
        //         "Nombre" => $nombre,
        //         "Usuario" => $usuario,
        //         "Email" => $email,
        //         "Telefono" => $telefono,
        //         "Tipo" => $tipo_usuario,
        //         "Estatus" => $estatus,
        //         "ID" => $id
        //     ];  

        //     if($password != ""){
        //         if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$password)){
        //             $alerta=[
        //                 "Alerta"=>"simple",
        //                 "Titulo"=>"Ocurrió un error inesperado",
        //                 "Texto"=>"La CONTRASEÑA no coincide con el formato solicitado: [a-zA-Z0-9$@.-]{7,100}",
        //                 "Tipo"=>"error"
        //             ];
        //             echo json_encode($alerta);
        //             exit();
        //         }
        //         if($password!=$password2){
        //             $alerta=[
        //                 "Alerta"=>"simple",
        //                 "Titulo"=>"Ocurrió un error inesperado",
        //                 "Texto"=>"Las contraseñas que acaba de ingresar no coinciden",
        //                 "Tipo"=>"error"
        //             ];
        //             echo json_encode($alerta);
        //             exit();
        //         }else{
        //             $data_user_update["Password"]=mainModel::encryption($password);
        //         }
        //     }

        //     $update_user = userModel::update_user_model($data_user_update);
        //     if($update_user){
        //         $alerta=[
        //             "Alerta"=>"recargar",
        //             "Titulo"=>"Usuario actualizado",
        //             "Texto"=>"El usuario se actualizo con exito en el sistema",
        //             "Tipo"=>"success"
        //         ];
        //     }else{
        //         $alerta=[
        //             "Alerta"=>"simple",
        //             "Titulo"=>"Ocurrió un error inesperado",
        //             "Texto"=>"No hemos podido actualizar el usuario",
        //             "Tipo"=>"error" 
        //         ];
        //     }
        //     echo json_encode($alerta);
        //     exit();
        // } /* Fin del controlador */

        // public function delete_user_controller(){
        //     $id = mainModel::decryption($_POST['id_user_del']);
        //     $id = mainModel::clean_string($id);

        //     $check_user = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id='$id'");
        //     if($check_user->rowCount() <= 0){
        //         $alerta = [
        //             "Alerta" => "simple",
        //             "Titulo" => "Ocurrió un error inesperado",
        //             "Texto" => "No hemos encontrado el usuario en el sistema",
        //             "Tipo" => "error"
        //         ];
        //         echo json_encode($alerta);
        //         exit();
        //     }else{
        //         $check_user_2 = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id='$id' AND usuario_id!='1'");
        //         if($check_user_2->rowCount() <= 0){
        //             $alerta = [
        //                 "Alerta" => "simple",
        //                 "Titulo" => "Ocurrió un error inesperado",
        //                 "Texto" => "No puedes eliminar el usuario principal del sistema",
        //                 "Tipo" => "error"
        //             ];
        //             echo json_encode($alerta);
        //             exit();
        //         }
        //     }

        //     $delete_user = userModel::delete_user_model($id);
        //     if($delete_user->rowCount() == 1){
        //         $alerta = [
        //             "Alerta" => "recargar",
        //             "Titulo" => "Usuario eliminado",
        //             "Texto" => "El usuario se ha eliminado con exito del sistema",
        //             "Tipo" => "success"
        //         ];
        //     }else{
        //         $alerta = [
        //             "Alerta" => "simple",
        //             "Titulo" => "Ocurrió un error inesperado",
        //             "Texto" => "No hemos podido eliminar el usuario",
        //             "Tipo" => "error"
        //         ];
        //     }
        //     echo json_encode($alerta);
        // } /* Fin del controlador */

    } /* Fin del archivo */ 




