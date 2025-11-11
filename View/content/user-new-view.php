<div class="container-fluid">
    <nav class="mb-4">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo APP_URL; ?>user-new/">Registrar usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo APP_URL; ?>user-list/">Lista de usuarios</a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid card-body">
        <h1 class="h3 mb-4 text-gray-800">Registrar Usuario</h1>
        <form class="FormularioAjax" action="<?php echo APP_URL; ?>router/requestUser.php" method="POST" data-form="save" autocomplete="off">
            <input type="hidden" name="guardarUsuario" value="1">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputName">NOMBRE *</label>
                    <input type="text" class="form-control" id="inputName" name="nombre-reg" maxlength="35" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,35}" >
                </div>
                <div class="form-group col-md-6">
                    <label for="inputUser">USUARIO *</label>
                    <input type="text" class="form-control" id="inputUser" name="usuario-reg" maxlength="20" pattern="[a-zA-ZñÑ0-9]{5,20}" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPassword1">CONTRASEÑA *</label>
                    <input type="password" class="form-control" id="inputPassword1" name="password1-reg" maxlength="35" pattern="[a-zA-Z0-9ñÑ*$.#]{5,35}">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword2">REPETIR CONTRASEÑA *</label>
                    <input type="password" class="form-control" id="inputPassword2" name="password2-reg" maxlength="35" pattern="[a-zA-Z0-9ñÑ*$.#]{5,35}" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail">CORREO *</label>
                    <input type="email" class="form-control" id="inputEmail" name="email-reg" >
                </div>
                <div class="form-group col-md-6">
                    <label for="inputTelfn">TELEFONO </label>
                    <input type="tel" class="form-control" id="inputTelfn" name="telefono-reg" >
                </div>
            </div>
            <div class="form-group">
                
            </div>
            <div class="form-row ">
                <div class="form-group col-md-6">
                    <label for="inputType">TIPO DE USUARIO *</label>
                    <select id="inputType" class="form-control" name="tipo-reg" >
                        <option value="" selected="" disable="">Seleccione una opcion</option>
                        <option value="1" >ADMINISTRADOR</option >
                        
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputStatus">ESTATUS *</label>
                    <select id="inputStatus" class="form-control" name="estatus-reg" >
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

