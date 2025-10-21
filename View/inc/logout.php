<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Listo para partir?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <form class="FormularioAjax" action="<?php echo APP_URL ?>router/requestLogin.php" method="POST" data-form="load" autocomplete="off">
                    <input type="hidden" name="id_bc" value="<?php echo $lc->encryption($_SESSION['id_bc']); ?>">
                    <input type="hidden" name="token" value="<?php echo $lc->encryption($_SESSION['token_bc']); ?>">
                    <input type="hidden" name="usuario" value="<?php echo $lc->encryption($_SESSION['usuario_bc']); ?>">
                    <button type="submit" class="btn btn-primary">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>