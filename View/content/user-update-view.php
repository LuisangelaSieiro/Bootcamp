<div class="container-fluid">
    <nav class="mb-4">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo APP_URL; ?>user-new/">Modificar usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo APP_URL; ?>user-list/">Lista de usuarios</a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid card-body">
        <h1 class="h3 mb-4 text-gray-800">Modificar Usuario</h1>
        <?php 
        require_once "./controller/userController.php";
        $ins_user = new userController();
        $datos = $ins_user->show_user_controller("Only",$page[1]);
        ?>

        <form class="FormularioAjax" action="<?php echo APP_URL; ?>router/requestUser.php" method="POST" data-form="save" autocomplete="off">
            <input type="hidden" name="id_up" value="<?php echo $page[1]; ?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputName">NOMBRE *</label>
                    <input type="text" class="form-control" id="inputName" name="nombre_up" value="<?php echo $datos['usuario_nombre']; ?> " maxlength="35" >
                </div>
                <div class="form-group col-md-6">
                    <label for="inputUser">USUARIO *</label>
                    <input type="text" class="form-control" id="inputUser" name="usuario_up" value="<?php echo $datos['usuario_username']; ?>" maxlength="40"  >
                </div>
            </div>
        
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail">CORREO *</label>
                    <input type="email" class="form-control" id="inputEmail" name="email_up" value="<?php echo $datos['usuario_email']; ?> " >
                </div>
                <div class="form-group col-md-6">
                    <label for="inputTelfn">TELEFONO </label>
                    <input type="tel" class="form-control" id="inputTelfn" name="telefono_up" value="<?php echo $datos['usuario_telefono']; ?> ">
                </div>
            </div>
            
            <div class="form-row ">
                <div class="form-group col-md-6">
                    <label for="inputType">TIPO DE USUARIO *</label>
                    <select id="inputType" class="form-control" name="tipo_up" >
                        <option selected>SELECCIONE UN TIPO DE USUARIO</option>
                        <?php
                        echo $lc->generar_select_db("tipo_usuario","tipo_usuario_id","tipo_usuario_descripcion",$datos['usuario_tipo']);
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputStatus">ESTATUS *</label>
                    <select id="inputStatus" class="form-control" name="estatus_up" >
                        <option  <?php $selected = ($datos['usuario_estatus']==1) ? "selected" : ""; ?>value="1" >ACTIVO</option >
                        <option  <?php $selected = ($datos['usuario_estatus']==0) ? "selected" : ""; ?> value="0" >INACTIVO</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-12 text-center mt-3">
                <a href="<?php echo APP_URL ?>user_list" class="btn btn-secondary">VOLVER</a>
                <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
            </div>
            <div class="form-group col-md-12 text-center mt-1">
                <p class="h5" >Los campos marcados con * son obligatorios </p>
            </div>
        </form>
    </div>

</div>

