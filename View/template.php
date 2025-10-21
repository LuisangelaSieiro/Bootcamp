<!DOCTYPE html>
<html <?=LANG?> >
<head>
    <?php include_once("view/inc/head.php")?>
</head>

<body  id="page-top">
<?php
    $peticionAjax=false;
    require_once "./controller/viewcontroller.php";
    $ins_views = new viewController();

    $view=$ins_views->get_view_controller();

    if ($view=="login" || $view=="404") :
        require_once "./view/content/".$view."-view.php";
    else: 
        session_start(['name'=>'BC']);
        
        $page=explode("/", $_GET['views']);

        require_once "./controller/loginController.php";
        $lc = new loginController();

        if(!isset($_SESSION['token_bc']) || !isset($_SESSION['usuario_bc'])){
            $lc->force_log_out_controller();
            exit();
        }
    ?>
    <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include_once("view/inc/sidebar.php")?>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php include_once("view/inc/topbar.php")?>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <?php include  $view; ?>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include_once("view/inc/footer.php")?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <?php include_once("view/inc/logout.php")?>
    <?php endif ?>
    <!-- Script -->
    <?php include_once("view/inc/script.php")?>

</body>

</html>