<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:index.php");
}
$logof = filter_input(INPUT_POST, 'logoff');

if (isset($logof)) {
    session_destroy();
    $_SESSION = array();
    setcookie("PHPSESSID", "", -3600);
    header("Location:index.php");
}
$upload = filter_input(INPUT_POST, 'aceptar');
if (isset($upload)) {
    if ($_FILES["fichero"]["size"] > 500000) {
        $msj = "Fichero demasiado grande";
    } else {
        $nombreFichero = $_FILES['fichero']['name'];
        $origen = $_FILES['fichero']['tmp_name'];
        $destino = "/var/usersds/" . $_SESSION['username'] . "/$nombreFichero";
        if (move_uploaded_file($origen, $destino)) {
            // $msj = "Fichero subido correctamente, espere a que el administrador lo acepte";
        } else {
            $msj = "Error al subir el fichero, contacte con el administrador";
        }
    }
}


$path = "/var/usersds/";
?>


<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Main</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/headerStyle.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/r-2.2.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/r-2.2.1/datatables.min.js"></script>
      <!--  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script> -->
        <style>
            .white{
                color:white;
            }


        </style>
    </head>

    <body onresize="deleteDiv()">

        <nav class="navbar navbar-default custom-header">
            <div class="container-fluid" >
                <div style="width: 50%; margin: 0 auto;" id="navHelp">
                    <div class="navbar-header" ><a class="navbar-brand navbar-link" href="#" style="font-size: 3em;">Cursore<span>Share </span> </a>
                        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse">
                        <ul class="nav navbar-nav links">
                            <li role="presentation" style="text-align: center;"><a href="main.php">Inicio </a></li>
                            <li role="presentation" style="text-align: center;"><a href="help.html"
                                                                                   onclick="window.open(this.href, '');
                                                                                           return false;">Ayuda</a></li>
                            <li role="presentation" style="text-align: center;"><a id="anadirsec" href="#">Añadir secuencia </a>
                                <div style="border: solid white 2px;display:none" id="subirF">
                                    <form action="main.php" method="POST" enctype="multipart/form-data">
                                        <label class="white"> Selecciona el fichero 
                                            <?php echo $msj ?> </label>
                                        <input type="file" name="fichero">
                                        <input type="submit" value="Aceptar" style="color:black;" name="aceptar">
                                    </form>

                                </div></li>

                            <li role="presentation" style="border: solid white 3px;border-radius: 4px;text-align: center"><a href="#"><?php echo $_SESSION['username'] ?> </a></li>
                        </ul>

                    </div>

                </div>
                <div style="float: right;">
                    <form action="main.php" method="POST">
                        <input type="submit" class="btn btn-primary" value="Desconectarse" name="logoff">
                    </form>
                </div>
            </div>
        </nav>
        <?php
        $count = 0;
        $count2 = 10000;
        $count3 = 20000;
        if (is_dir($path)) {
            $dh = opendir($path);
            if ($dh) {
                while (($file = readdir($dh)) !== false) {
                    if (!($file === ".") && !($file === "..")) {
                        $uploadUser = $path . "/" . $file;
                        if (is_dir($uploadUser)) {
                            $cc = opendir($uploadUser);
                            if ($cc) {
                                while (($cosa = readdir($cc)) !== false) {
                                    if (!($cosa === ".") && !($cosa === "..")) {
                                        $rutaFile = "$path$file/$cosa";

                                        copy($rutaFile, "jsons/" . $cosa);
                                        ?>
                                        <div class="col-sm-12 label-column" style="margin-bottom: 40px">
                                            <div class="py-5">
                                                <div class="container">
                                                    <div class="row" style="border: white solid 3px;border-radius: 20px;">
                                                        <div class="col-md-4 col-lg-4 col-xs-4" style=" height: 80px;border-radius: 20px 0px 0px 20px;">
                                                            <div class="row" style="height: 100%;">
                                                                <div class="col-md-2 col-md-offset-5 col-sm-2 col-sm-offset-5 col-xs-2 col-xs-offset-5" style="height:100%;width: 120px;">
                                                                    <img src="assets/img/mouse.png" alt="" style="width: 100%;height: 100%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4  col-sm-4 col-xs-4  " style="height: 80px">
                                                            <div class="row" style="height: 100%;">
                                                                <div style="height: 50%">
                                                                    <p style="width: 100%; text-align: center;color: white"><?php echo $cosa ?></p>
                                                                </div>
                                                                <button class="btn btn-primary" style="width: 100%;" id="<?php echo $count3 ?>" onclick="mostrarTabla(this.id, '<?php echo $count ?>', '<?php echo $count2 ?>', '<?php echo "jsons/$cosa" ?>')">Mostrar Secuencia</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-lg-4 col-xs-4" style="height: 80px;border-radius: 0px 20px 20px 0px;">
                                                            <div class="row" style="height: 100%;">
                                                                <div class="col-md-2 col-md-offset-5 col-sm-2 col-sm-offset-5 col-xs-2 col-xs-offset-5" style="height:100%;width: 50%;">
                                                                    <p style="margin-top: 18%; color: white"><?php echo $file ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="display: none;width: 100%;" id="<?php echo $count ?>">
                                                        <table id="<?php echo $count2 ?>" class="display" width="100%" cellspacing="0" style="color: black;">
                                                            <thead>
                                                                <tr>
                                                                    <th class="white">Alias</th>
                                                                    <th class="white">Coordenadas</th>
                                                                    <th class="white">Duración</th>
                                                                    <th class="white">Doble</th>
                                                                    <th class="white">Es cuadrado</th>
                                                                    <th class="white">Coordenadas Cuadrado</th>
                                                                    <th class="white">Aleatorio</th>
                                                                    <th class="white">Randoms</th>
                                                                    <th class="white">Texto</th>
                                                                    <th class="white">Teclas</th>

                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                                <tr>
                                                                    <th class="white">Alias</th>
                                                                    <th class="white">Coordenadas</th>
                                                                    <th class="white">Duración</th>
                                                                    <th class="white">Doble</th>
                                                                    <th class="white">Es cuadrado</th>
                                                                    <th class="white">Coordenadas Cuadrado</th>
                                                                    <th class="white">Aleatorio</th>
                                                                    <th class="white">Randoms</th>
                                                                    <th class="white">Texto</th>
                                                                    <th class="white">Teclas</th>

                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        <div style="float: right;margin-top: 10px;">
                                                            <a href="jsons/<?php echo $cosa ?>" download target="_blank"> Descargar</a>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>




                                        <?php
                                        $count++;
                                        $count2++;
                                        $count3++;
                                    }
                                }
                                closedir($cc);
                            }
                        }
                    }
                }
                closedir($dh);
            }
        }
        ?>


    </div>

    <script>
        function deleteDiv() {
            if ($(window).width() < 560) {
                document.getElementById("navHelp").style = "";
            } else if ($(window).width() > 560) {
                document.getElementById("navHelp").style = "width: 70%; margin: 0 auto;";
            }
        }

        function mostrarTabla(id_button, id_div_tabla, id_tabla, ruta_fichero) {
            var table = document.getElementById(id_div_tabla).style.display;
            if (table === "none") {
                $("#" + id_div_tabla).fadeIn("slow", function () {
                    table = "block";
                    document.getElementById(id_button).innerHTML = "Ocultar Secuencia";
                });

            } else {
                $("#" + id_div_tabla).fadeOut("slow", function () {
                    table = "none";
                    document.getElementById(id_button).innerHTML = "Mostrar Secuencia";
                });
            }

            var dataElement = document.getElementById(id_tabla);
            if (!(dataElement.muestra === "true")) {
                $('#' + id_tabla).DataTable({
                    "ajax": ruta_fichero,
                    "columns": [
                        {"data": "alias"},
                        {"data": "coordenadas"},
                        {"data": "duracionClick"},
                        {"data": "doble"},
                        {"data": "esCuadrado"},
                        {"data": "coordenadasClick"},
                        {"data": "random"},
                        {"data": "Randoms"},
                        {"data": "sihayTexto"},
                        {"data": "teclasaEscribir"}
                    ],
                    "ordering": false,
                    "responsive": true
                });
                dataElement.muestra = "true";

            }
        }



//            $("#buttonFont").click(function () {
//                var table = document.getElementById("table").style.display;
//                if (table === "none") {
//                    $("#table").fadeIn("slow", function () {
//                        table = "block";
//                        document.getElementById("buttonFont").innerHTML = "Ocultar Secuencia";
//                    });
//
//                } else {
//                    $("#table").fadeOut("slow", function () {
//                        table = "none";
//                        document.getElementById("buttonFont").innerHTML = "Mostrar Secuencia";
//                    });
//                }
//
//                var dataElement = document.getElementById("datTable");
//                if (!(dataElement.muestra === "true")) {
//                    var hola = "jsons/AbrirPestana.json";
//                    $('#datTable').DataTable({
//                        "ajax": hola,
//                        "columns": [
//                            {"data": "alias"},
//                            {"data": "coordenadas"},
//                            {"data": "duracionClick"},
//                            {"data": "doble"},
//                            {"data": "esCuadrado"},
//                            {"data": "coordenadasClick"},
//                            {"data": "random"},
//                            {"data": "Randoms"},
//                            {"data": "sihayTexto"},
//                            {"data": "teclasaEscribir"}
//                        ],
//                        "ordering": false
//                    });
//                    dataElement.muestra = "true";
//
//                }
//
//            });

        $("#anadirsec").click(function () {
            var table = document.getElementById("subirF").style.display;
            if (table === "none") {
                $("#subirF").fadeIn("slow", function () {
                    table = "block";
                });

            } else {
                $("#subirF").fadeOut("slow", function () {
                    table = "none";
                });
            }
        });
    </script>

</body>

</html>