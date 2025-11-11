<?php
	require_once "./model/viewModel.php";
	class viewController extends viewModel{

		/*--------- Controlador obtener plantilla ---------*/
		public function get_template_controller(){
			return require_once "./view/template.php";
		}

		/*--------- Controlador obtener vistas ---------*/
		public function get_view_controller(){
			if(isset($_GET['views'])){
				$route=explode("/", $_GET['views']);
				$response=viewModel::get_view_model($route[0]);
			}else{
				$response="login";
			}
			return $response;
		}
	}