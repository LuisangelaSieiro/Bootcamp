<?php
	
	if($peticionAjax){
		require_once "../config/SERVER.php";
	}else{
		require_once "./config/SERVER.php";
	}

	class mainModel{

		/*--------- Funcion conectar a BD ---------*/
		protected static function conectar(){
			$conexion = new PDO(SGBD, USER, PASS);
			$conexion->exec("SET CHARACTER SET utf8");
			return $conexion;
		}


		/*--------- Funcion ejecutar consultas simples ---------*/
		protected static function ejecutar_consulta_simple($consulta){
			$sql=self::conectar()->prepare($consulta);
			$sql->execute();
			return $sql;
		}


		/*--------- Encriptar cadenas ---------*/
		public function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}


		/*--------- Desencriptar cadenas ---------*/
		protected static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}


		/*--------- Funcion generar codigos aleatorios ---------*/
		protected static function generar_codigo_aleatorio($letra,$longitud,$numero){
			for($i=1; $i<=$longitud; $i++){
				$aleatorio= rand(0,9);
				$letra.=$aleatorio;
			}
			return $letra."-".$numero;
		}


		/*--------- Funcion limpiar cadenas ---------*/
		protected static function clean_string($cadena){
			$cadena=trim($cadena);
			$cadena=stripslashes($cadena);
			$cadena=str_ireplace("<script>", "", $cadena);
			$cadena=str_ireplace("</script>", "", $cadena);
			$cadena=str_ireplace("<script src", "", $cadena);
			$cadena=str_ireplace("<script type=", "", $cadena);
			$cadena=str_ireplace("SELECT * FROM", "", $cadena);
			$cadena=str_ireplace("DELETE FROM", "", $cadena);
			$cadena=str_ireplace("INSERT INTO", "", $cadena);
			$cadena=str_ireplace("DROP TABLE", "", $cadena);
			$cadena=str_ireplace("DROP DATABASE", "", $cadena);
			$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
			$cadena=str_ireplace("SHOW TABLES", "", $cadena);
			$cadena=str_ireplace("SHOW DATABASES", "", $cadena);
			$cadena=str_ireplace("<?php", "", $cadena);
			$cadena=str_ireplace("?>", "", $cadena);
			$cadena=str_ireplace("--", "", $cadena);
			$cadena=str_ireplace(">", "", $cadena);
			$cadena=str_ireplace("<", "", $cadena);
			$cadena=str_ireplace("[", "", $cadena);
			$cadena=str_ireplace("]", "", $cadena);
			$cadena=str_ireplace("^", "", $cadena);
			$cadena=str_ireplace("==", "", $cadena);
			$cadena=str_ireplace(";", "", $cadena);
			$cadena=str_ireplace("::", "", $cadena);
			$cadena=stripslashes($cadena);
			$cadena=trim($cadena);
			return $cadena;
		}

		/*---------- Funcion verificar datos (expresion regular) ----------*/
		protected static function verificar_datos($filtro,$cadena){
			if(preg_match("/^".$filtro."$/", $cadena)){
				return false;
			}else{
				return true;
			}
		}


		/*--------- Funcion verificar fechas ---------*/
		protected static function verificar_fecha($fecha){
			$valores=explode('-', $fecha);
			if(count($valores)==3 && checkdate($valores[1],$valores[2],$valores[0])){
				return false;
			}else{
				return true;
			}
		}

		/*---------- Funcion buscar datos ----------*/
		protected static function buscar_datos($tabla,$campo,$busqueda){
			$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM $tabla WHERE $campo LIKE '%$busqueda%' ORDER BY $campo ASC";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			return $datos;
		} /*--  Fin Funcion --*/

		/*---------- Funcion buscar valor ----------*/
		protected static function buscar_valor($tabla,$campo,$busqueda,$valor){
			$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM $tabla WHERE $campo='$busqueda' ORDER BY $campo ASC";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$dato = $datos->fetch();
			$respuesta = $dato[$valor];
			return $respuesta;
		} /*--  Fin Funcion --*/


		/*---------- Funcion obtener nombre de mes ----------*/
		public function obtener_nombre_mes($mes){
			switch($mes){
				case 1:
					$nombre_mes="enero";
				break;
				case 2:
					$nombre_mes="febrero";
				break;
				case 3:
					$nombre_mes="marzo";
				break;
				case 4:
					$nombre_mes="abril";
				break;
				case 5:
					$nombre_mes="mayo";
				break;
				case 6:
					$nombre_mes="junio";
				break;
				case 7:
					$nombre_mes="julio";
				break;
				case 8:
					$nombre_mes="agosto";
				break;
				case 9:
					$nombre_mes="septiembre";
				break;
				case 10:
					$nombre_mes="octubre";
				break;
				case 11:
					$nombre_mes="noviembre";
				break;
				case 12:
					$nombre_mes="diciembre";
				break;
				default:
					$nombre_mes="No definido";
				break;
			}
			return $nombre_mes;
		} /*--  Fin Funcion --*/


		/*----------  Funcion generar select ----------*/
		public function generar_select($datos,$campo_db){
			$check_select='';
			$text_select='';
			$count_select=1;
			$select='';
			foreach($datos as $row){

				if($campo_db==$row){
					$check_select='selected=""';
					$text_select=' (Actual)';
				}

				$select.='<option value="'.$row.'" '.$check_select.'>'.$count_select.' - '.$row.$text_select.'</option>';

				$check_select='';
				$text_select='';
				$count_select++;
			}
			return $select;
		} /*--  Fin Funcion --*/

		/*----------  Funcion generar select ----------*/
		public function generar_select_db($tabla, $campo_id, $campo_mostrar, $selected = null){

			$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM $tabla ORDER BY 1 ASC";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			$select='';
			foreach($datos as $rows){
				$campo = '';
				$seleccionado = (($selected == $rows[$campo_id])?"selected":"");
				if(is_array($campo_mostrar)){
					foreach($campo_mostrar as $data){
						$campo .= $rows[$data].' ';
					}
				}else{
					$campo = $rows[$campo_mostrar];
				}

				$select.='<option value="'.$rows[$campo_id].'" '.$seleccionado.'>'.strtoupper($campo).'</option>';
			}
			
			return $select;
		} /*--  Fin Funcion --*/


	}