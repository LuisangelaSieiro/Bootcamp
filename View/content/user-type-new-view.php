<div class="container-fluid">
    <nav class="mb-4">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo APP_URL; ?>user-type-new/">Registrar Tipo de usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo APP_URL; ?>user-type-list/">Lista de Tipo de usuarios</a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid card-body">
        <h1 class="h3 mb-4 text-gray-800">Registrar tipo de Usuario</h1>
        <form class="FormularioAjax" action="<?php echo APP_URL; ?>router/requestUserType.php" method="POST" data-form="save" autocomplete="off">
            <input type="hidden" name="guardaTipoUsuario" value="1">
            <div class="form-row ">
                <div class="form-group col-md-6">
                    <label for="inputName">DESCRIPCIÓN *</label>
                    <input type="text" class="form-control" id="inputName" name="descripcion_reg" maxlength="30" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,30}" >
                </div>
                <div class="form-group col-md-6">
                    <label for="inputStatus">ESTATUS *</label>
                    <select id="inputStatus" class="form-control" name="estatus_reg">
                        <option  value="1" selected>ACTIVO</option >
                        <option value="0" >INACTIVO</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-12 text-center mt-3">
                <button type="reset" class="btn btn-secondary">LIMPIAR</button>
                <button type="submit" class="btn btn-primary">GUARDAR</button>
            </div>
            <div class="form-group col-md-12 text-center mt-1">
                <p class="h5" >Los campos marcados con * son obligatorios </p>
            </div>
        </form>
        
    </div>

</div>
