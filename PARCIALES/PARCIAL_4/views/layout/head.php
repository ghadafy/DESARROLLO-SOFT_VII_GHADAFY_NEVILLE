<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="resources/css/materialize.css?v=<?= time(); ?>">
    </link>

    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="resources/js/app.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">


    <style>
        footer {
            border-top: 5px solid #01579b;
        }

        .encabezado {
            padding: 5px;
            padding-right: 20px;
            text-align: right;

        }

        .titulo {
            font-family: 'Roboto', sans-serif;
            color: white;
            margin-bottom: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 5px;
        }

        .encabezado {
            font-family: 'Roboto', sans-serif;
            font-size: medium;
            margin-bottom: 0;
            margin-top: 0;
        }

        .nombre {
            color: blue;
        }

        .cerrar {
            color: blue;
            font-weight: 300;
            font-size: large;

        }

        .cerrar a {
            display: flex;
            align-items: center;
            justify-content: flex-end;

        }

        .cerrar i {
            margin-left: 8px;
        }

        .aviso {
            font-family: 'Roboto', sans-serif;
            font-size: medium;
            margin-bottom: 0;
            margin-top: 0;
            color: red;
            padding-left: 20px;
        }
    </style>


    <title>BASE DE DATOS DE LIBROS</title>
</head>

<body>


    <div class="container no-margin ">

        <div class="row no-margin">

            <div class="col m12 no margin">

                <div class="#01579b light-blue darken-4 z-depth-2 white-text center-align">
                    <h4><a href="index.php" class="titulo">Base de datos de Libros</a></h4>
                </div>

            </div>
        </div>

        <div class="encabezado">

            <?php if (!isset($_SESSION['user'])) {

            ?>

                <div class="row">
                    <div class='col s4 center-align'></div>

                    <div class='col s4 center-align'>
                        <div id="g_id_onload" data-client_id="528282339510-0g5fv2f34pjst8pcl5otq09c3700ljck.apps.googleusercontent.com" data-callback="handleCredentialResponse">
                        </div>

                    </div>

                    <div class='col s4 center-align'></div>
                </div>
            <?php } else {


                if ($_SESSION) {
                    require_once 'controllers/usuarioController.php';
                    $usuario = new usuarioController();
                    $usuario->guardarUsuario();
                }
                echo "<div class='row'>";

                echo "<div class='col s6 left-align'> 
           <h5 class='valign-wrapper'>
               <img src=" . $_SESSION['user']['imagen'] . " alt='Imagen de perfil' style='width: 100px;' class='materialboxed responsive-img' > 
               &nbsp; Bienvenido(a) &nbsp; <span class='nombre'>" . $_SESSION['user']['nombre'] . "</span>
           </h5>
         </div>";


                echo "<div class='col s6 right-align'>
           <span class='cerrar'>
               <a href='?c=logout'> 
                   Cerrar sesión 
                   <i class='small material-icons'>exit_to_app</i> 
               </a>
           </span>
         </div>";

                echo "</div>";
            } ?>


        </div>