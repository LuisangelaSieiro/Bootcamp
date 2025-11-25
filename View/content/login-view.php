<div class="bg-gradient-login">   
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center ">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">¡Bienvenido de nuevo!</h1>
                                    </div>
                                    <form action="" method="POST" autocomplete="off" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="username_login" name="username_login" aria-describedby="emailHelp"
                                                placeholder="Introduzca su usuario...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password_login" name="password_login" placeholder="Contraseña">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">LOG IN</button>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password">¿Has olvidado tu contraseña?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
<?php
    if(isset($_POST['username_login']) && isset($_POST['password_login'])) {
        require_once './controller/loginController.php';
        $ins_login = new loginController();
        echo $ins_login->log_in_controller();
    }
?>