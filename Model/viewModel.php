<?php
	class viewModel{

		/*--------- Modelo obtener vistas ---------*/
		protected static function get_view_model($view){
			$whiteList=[
				"dashboard","user-new","user-list","user-update","user-type-new","user-type-list","user-type-update"
			];
			if(in_array($view, $whiteList)){
				if(is_file("./view/content/".$view."-view.php")){
					$content="./view/content/".$view."-view.php";
				}else{
					$content="404";
				}
			}elseif($view=="login" || $view=="index"){
				$content="login";
			}else{
				$content="404";
			}
			return $content;
		}
	}