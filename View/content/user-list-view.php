<div class="container-fluid">
    <nav class="mb-4">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link " href="<?php echo APP_URL; ?>user-type-new/">Registrar usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo APP_URL; ?>user-type-list/">Lista de usuarios</a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid card-body">
        <h1 class="h3 mb-4 text-gray-800">Listado de Usuario</h1>
    </div>   
    <!-- DataTales Example -->
    <div class="card mb-4">
        <div class="card-body">
        <?php 
            require_once "./controller/userController.php";
            $ins_user = new userController();

            echo $ins_user->list_user_controller();
        ?> 
        </div>
    </div>
    

</div>
<script>
    const SERVERURL="<?php echo APP_URL ?>";
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
            "url": SERVERURL+"/view/js/dataTables-Español.json"
            }
        });
    });
</script>