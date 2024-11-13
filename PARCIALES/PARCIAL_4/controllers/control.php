<?php
require_once 'models/libro.php';

class Control
{

    public function index()
    {
        if (isset($_SESSION['user'])) {
            $model = new Libro();
            $model->setEmail_usuario($_SESSION['user']['email']);
            $libros = $model->listarLibros();
            require_once 'views/home.php';
        }
    }


    public function login()
    {
        require_once 'views/login.php';
    }


    public function nuevo()
    {

        //Esta metodo lo utilizo para regitrar un dato nuevo y/o para editar un dato
        if (!isset($_REQUEST['id'])) {
            $lib = null;
        } else {
            require_once 'views/home.php';
        }

        require_once 'views/nuevo.php';
    }



    public function edicion()
    {

        //Esta metodo lo utilizo para regitrar un dato nuevo y/o para editar un dato
        if (isset($_REQUEST['id'])) {
            $model = new Libro();
            $model->setId_libro($_REQUEST['id']);
            $lib = $model->cargarDatos();
            if (!$lib) {
                echo "No se encontro el libro buscado...";
                $lib = null;
            }
        }

        require_once 'views/edicion.php';
    }


    public function guardar()
    {
        $errores = [];
        // Sanitizamos los datos
        $lib = new Libro();

        $lib->setEmail_usuario($_SESSION['user']['email']);
        $id_libro = htmlspecialchars(trim($_POST['id_libro']));
        $id_libro_google = htmlspecialchars(trim($_POST['id_libro_google']));
        $titulo = htmlspecialchars(trim($_POST['titulo']));
        $autor = htmlspecialchars(trim($_POST['autor']));
        $resena_personal = htmlspecialchars(trim($_POST['resena_personal']));


        $_SESSION['data']['email_usuario'] = $_POST['email_usuario'];
        $_SESSION['data']['id_libro'] = $_POST['id_libro'];
        $_SESSION['data']['id_libro_google'] = $_POST['id_libro_google'];
        $_SESSION['data']['titulo'] = $_POST['titulo'];
        $_SESSION['data']['autor'] = $_POST['autor'];
        $_SESSION['data']['resena_personal'] = $_POST['resena_personal'];


        // Validamos los datos
        if (empty($id_libro_google)) {
            $errores['id_libro_google'] = "El id del libro de google no puede estar vacío";
        } elseif (strlen($id_libro_google) > 255) {
            $errores['id_libro_google'] = "El id del libro de google no puede ser mayor de 255 caracteres";
        } else {
            $lib->setId_libro_google($id_libro_google);
        }

        if (empty($titulo)) {
            $errores['titulo'] = "El título del libro no puede estar vacío";
        } elseif (strlen($titulo) > 255) {
            $errores['titulo'] = "El título del libro no puede ser mayor de 255 caracteres";
        } else {
            $lib->setTitulo($titulo);
        }

        if (empty($autor)) {
            $errores['autor'] = "El autor del libro no puede estar vacío";
        } elseif (strlen($autor) > 255) {
            $errores['autor'] = "El autor del libro no puede ser mayor de 255 caracteres";
        } else {
            $lib->setAutor($autor);
        }
        $lib->setId_libro($id_libro);
        $lib->setResena_personal($resena_personal);

        // Determinar si es un nuevo libro o una edición
        $isEditing = isset($_POST['id_libro']) && (int)$_POST['id_libro'] > 0;

        // Si estamos editando, obtenemos la imagen actual de la base de datos
        if ($isEditing) {
            if (strlen($lib->setImagen_portada($_POST['imagen_portada']) > 0))
                $lib->setImagen_portada($_POST['imagen_portada']); // La imagen actual que ya tiene el libro en la base de datos
        }

        // Verificar y procesar la imagen solo si se está registrando o subiendo una nueva
        if (isset($_FILES['imagen_portada']) && $_FILES['imagen_portada']['error'] == UPLOAD_ERR_OK) {
            // Configuración de la carpeta y nombre de archivo
            $targetDir = "uploads/";
            $ruta = $_FILES["imagen_portada"]["name"];
            $targetFile = $targetDir . basename($_FILES["imagen_portada"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Verificar si el archivo es una imagen válida
            if (getimagesize($_FILES["imagen_portada"]["tmp_name"]) === false) {
                $errores['imagen_portada'] = "El archivo no es una imagen válida.";
            }

            // Verificar el tamaño del archivo (máximo 2MB)
            if ($_FILES["imagen_portada"]["size"] > 2000000) {
                $errores['imagen_portada'] = "El archivo es demasiado grande.";
            }

            // Verificar el tipo de archivo (solo JPG, PNG, JPEG)
            if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
                $errores['imagen_portada'] = "Solo se permiten archivos JPG, JPEG y PNG.";
            }

            // Si no hay errores, mover el archivo a la carpeta de destino
            if (empty($errores['imagen_portada']) && move_uploaded_file($_FILES["imagen_portada"]["tmp_name"], $targetFile)) {
                // Si se sube una nueva imagen, guardamos su ruta
                $lib->setImagen_portada($targetFile);
            }
        } elseif (!$isEditing) {
            // Si no estamos editando, la imagen es obligatoria
            $errores['imagen_portada'] = "Debe cargar una imagen de portada.";
        }


        // Si no hay errores, continuar con el proceso de guardar
        try {
            if (isset($_POST['id_libro']) && ((int)$_POST['id_libro'] > 0)) {
                // Si hay errores, los mostramos y terminamos la ejecución
                if (!empty($errores)) {
                    $_SESSION['errores'] = $errores;

                    header("Location: ?c=nuevo&id=" . $_POST['id_libro']);
                    return;
                } else {
                    $lib->actualizarLibro($lib);
                }
            } else {
                // Si hay errores, los mostramos y terminamos la ejecución
                if (!empty($errores)) {
                    $_SESSION['errores'] = $errores;

                    header("Location: ?c=nuevo");
                    return;
                } else {
                    $lib->registrarLibro();
                }
            }
            header('Location: index.php');
        } catch (Exception $e) {
            echo "Error al registrar o actualizar libro: " . $e->getMessage();
        }
    }


    public function guardarLibroApi()
    {

        // Verificamos que los datos del libro sean correctos
        if (isset($_POST['id_libro_google'], $_POST['titulo'], $_POST['autor'])) {
            try {
                $id_libro_google = htmlspecialchars(trim($_POST['id_libro_google']));
                $titulo =  htmlspecialchars(trim($_POST['titulo']));
                $autor = htmlspecialchars(trim($_POST['autor']));
                $imagen_portada = $_POST['imagen_portada'];

                // Creamos un objeto Libro y lo guardamos
                $libro = new Libro();
                $libro->setEmail_usuario($_SESSION['user']['email']);
                $libro->setId_libro_google($id_libro_google);
                $libro->setTitulo($titulo);
                $libro->setAutor($autor);
                $libro->setImagen_portada($imagen_portada);

                // Aquí podrías manejar la imagen si la subes junto al formulario

                // Llamamos al método para guardar el libro en la base de datos

                $libro->registrarLibro();
                header('Location: index.php');
            } catch (Exception $e) {
                echo "Error al tratar de registrar li desde la Api" . $e->getMessage();
            }
            // Redirigimos al listado de libros (o página de inicio)

        } else {
            echo "Faltan datos para guardar el libro.";
        }
    }


    public function eliminar()
    {

        $lib = new Libro();
        //Sanitizar y validar
        $id = $_GET['id'];
        try {
            $lib->borrarLibro($id);
            header('Location: index.php');
        } catch (Exception $e) {
            echo "Error " . $e->getMessage();
            header('Location: index.php');
        }
    }


    public function editar()
    {
        //Sanitizar y validar
        $id = $_GET['id'];
        $lib = new Libro();
        $lib->setId_libro($id);
        //  $lib->editar();

        require_once 'views/nuevo.php';
        // var_dump($dato);
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }


    public function iniciarRegistroUsuaurio()
    {
        $usuario = new usuarioController();
        $usuario->guardarUsuario();
        header('Location: index.php');
    }


    public function mostrarBuscarHome()
    {
        require_once 'views/resultados.php';
    }

    public function buscarLibros()
    {
        // Verificamos si el parámetro 'termino' se ha pasado para realizar la búsqueda
        if (isset($_REQUEST['termino'])) {
            $termino = $_REQUEST['termino'];

            // URL de la API de Google Books
            $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($termino);

            // Usamos file_get_contents para obtener los datos de la API
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            // Verificamos si la API devolvió resultados
            if (isset($data['items'])) {
                $libros = $data['items'];
                // Llamamos a la vista para mostrar los resultados de la búsqueda
                require_once 'views/resultados.php';
            } else {
                echo "No se encontraron resultados para la búsqueda.";
            }
        } else {
            // Si no se ha especificado término de búsqueda, mostramos la página de inicio
            $this->index();
        }
    }
}
