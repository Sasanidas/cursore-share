<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/loginStyle.css">
    </head>

    <body>
        <div class="loginForm">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-3 col-md-12 col-md-offset-3 col-sm-12 col-sm-offset-3 col-xs-12 col-xs-offset-3">
                    <img src="assets/img/desktop(1).png" style="width: 120px" alt="mainImage">
                </div>
            </div>
            <div>
                <p class="formTitle"> Cursore Share v0.1 </p>
            </div>
            <form class="loginFormStyle" action="login.php" method="POST">
                <?php if ($_GET['fail'] === "true") { ?>
                <div class="alert alert-warning" style="text-align: center;font-size: ">
                        Datos incorrectos.
                    </div>
                <?php }
                ?>
                <input class="inputStyle" type="text" required="" placeholder="Nombre Usuario" autofocus="" id="inputUsername" name="inputUsername">
                <input class="inputStyle" type="password" required="" placeholder="Password" id="inputPassword" name="inputPassword">
                <button class="btn btn-primary btn-block btn-lg btn-signin" type="submit">Entrar </button>
            </form>
            <div class="row"><a href="registro.php" class="forgot-password">Registrarse </a></div>
            <div class="row"><a href="#" class="forgot-password"> ¿Olvidates tu contraseña?</a></div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>

</html>