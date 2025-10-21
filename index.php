<?php
	require_once "./config/APP.php";
	require_once "./controller/viewController.php";
		
	$template = new viewController();
	$template->get_template_controller();