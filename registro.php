<?php
include("./simple-php-captcha.php");


session_start();
$_SESSION['captcha'] = simple_php_captcha();
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/formStyle.css">
    </head>

    <body>
        <div class="row formStyle">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-horizontal custom-form cmxform" action="register.php" method="POST" id="validateForm">
                    <h1>Registro </h1>
                    <div class="form-group">
                        <div class="col-sm-4 label-column">
                            <label class="control-label" for="name-input-field">Nombre de usuario</label>
                        </div>
                        <div class="col-sm-6 input-column">
                            <input class="inputStyle" type="text" name="inputUsername" required="" id="inputUsername">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 label-column">
                            <label class="control-label" for="pawssword-input-field">Contraseña</label>
                        </div>
                        <div class="col-sm-6 input-column">
                            <input class="inputStyle" type="password" name="inputPassword" id="inputPassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 label-column">
                            <label class="control-label" for="repeat-pawssword-input-field">Repetir contraseña</label>
                        </div>
                        <div class="col-sm-6 input-column">
                            <input class="inputStyle" type="password"  id="confir_inputPassword" name="confir_inputPassword">
                        </div>
                    </div>

                    <div>
                        <img src="<?php echo $_SESSION['captcha']['image_src'] ?>"  alt="CAPTCHA code" style="width: 25%;height: 120px;">
                        <div class="control-label"  style="text-align: center;">Resuelve el captcha</div>
                        <?php if ($_GET['fail'] === "true") { ?>
                            <div class="alert alert-warning">
                                Captcha incorrecto, intentalo de nuevo.
                            </div>
                        <?php }
                        ?>
                        <input type="text" class="inputStyle" id="captcha" name="captcha" style="width: 50%;margin: 0 auto;">
                    </div>
                    <div class="checkbox">
                         <?php if ($_GET['notcheck'] === "true") { ?>
                            <div class="alert alert-warning">
                                Debes aceptar las condiciones.
                            </div>
                        <?php } ?>
                        <label>
                            <input type="checkbox" id="ok" name="ok">
                            He leido y acepto los terminos de uso.</label>
                    </div>

                    <input class="btn btn-default submit-button" type="submit" value="Aceptar">
                    <a href="index.php">  Volver</a>
                </form>
            </div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.validate.js"></script>
        <script src="assets/js/additional-methods.js"></script>
        <script type="text/javascript">
          $("#validateForm").validate({
                rules: {
                    inputUsername: {
                        required: true,
                        minlength: 3
                    },
                    inputPassword: {
                        required: true,
                        minlength: 8
                    },
                    confir_inputPassword: {
                        required: true,
                        minlength: 8,
                        equalTo: "#inputPassword"
                    }
                },
                messages: {
                    inputUsername: {
                        required: "Por favor, indroduce un nombre de usuario",
                        minlength: "El nombre de usuario debe ser mayor de 2 caracteres"
                    },
                    inputPassword: {
                        required: "Debes añadir una contraseña",
                        minlength: "La contraseña debe ser al menos de 8 caracteres"
                    },
                    confir_inputPassword: {
                        required: "Debes confirmar la contraseña",
                        minlength: "La contraseña debe ser al menos de 8 caracteres",
                        equalTo: "La contraseña debe ser la misma"
                    }
                }
            });



        </script>
    </body>

</html>