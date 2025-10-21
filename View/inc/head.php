<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title> <?php echo APP_NAME ?> </title>
<!-- jQuery V3.4.1 -->
<script src="<?php echo APP_URL; ?>view/js/jquery-3.6.0.min.js"></script>
<!-- Custom fonts for this template-->
<link href="<?php echo APP_URL; ?>view/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="<?php echo APP_URL; ?>view/css/sb-admin-2.css" rel="stylesheet">

<!-- Sweet Alert ALL v11.14.4 JS file-->
<script src="<?php echo APP_URL; ?>view/js/sweetalert2@11.js"></script>
<!-- Custom styles for this page -->
<link href="<?php echo APP_URL; ?>view/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<script>
    function goBackAndForceReload() {
        // Agregar un parámetro a la URL de la página actual para forzar recarga
        history.back();
        history.replaceState(null, null, location.href + "?reload=true");
    }
</script>