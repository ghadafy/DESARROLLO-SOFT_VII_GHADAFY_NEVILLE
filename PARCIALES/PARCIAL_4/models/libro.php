<?php


class Libro
{
    private $id_libro;
    private $email_usuario;
    private $id_libro_google;
    private $titulo;
    private $autor;
    private $imagen_portada;
    private $resena_personal;
    public $conn;


    //Getters
    public function getId_libro()
    {
        return $this->id_libro;
    }

    public function getEmail_usuario()
    {
        return $this->email_usuario;
    }

    public function getId_libro_google()
    {
        return $this->id_libro_google;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getImagen_portada()
    {
        return $this->imagen_portada;
    }

    public function getResena_personal()
    {
        return $this->resena_personal;
    }

    //Setters

    public function setId_libro($id_libro)
    {
        $this->id_libro = $id_libro;
    }

    public function setEmail_usuario($email_usuario)
    {
        $this->email_usuario = $email_usuario;
    }

    public function setId_libro_google($id_libro_google)
    {
        $this->id_libro_google = $id_libro_google;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function setImagen_portada($imagen_portada)
    {
        $this->imagen_portada = $imagen_portada;
    }

    public function setResena_personal($resena_personal)
    {
        $this->resena_personal = $resena_personal;
    }



    //Constructor

    public function __construct()
    {
        try {
            $this->conn = db::conexion();
        } catch (PDOException $e) {
            echo "Error en DB " . $e->getMessage();
        }
    }


    //Metodos
    public function listarLibros()
    {
        try {

            $sql = "SELECT id_libro, email_usuario, id_libro_google, titulo, autor, imagen_portada, resena_personal, fecha_guardado
            FROM libros_guardados
            WHERE email_usuario = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($this->getEmail_usuario()));
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error en listar libros " . $e->getMessage();
            return false;
        }
    }

    public function registrarLibro()
    {
        try {
            //Otra forma mas corta de hacer un insert
            $sql = "INSERT INTO libros_guardados(email_usuario, id_libro_google, titulo, autor, imagen_portada, resena_personal) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);

            $email_usuario = $this->getEmail_usuario();
            $id_libro_google = $this->getId_libro_google();
            $titulo = $this->getTitulo();
            $autor = $this->getAutor();
            $imagen_portada = $this->getImagen_portada();
            $resena_personal = $this->getResena_personal();

            $stmt->execute(array($email_usuario, $id_libro_google, $titulo, $autor, $imagen_portada, $resena_personal));
            return true;
        } catch (PDOException $e) {
            echo "Error en registrar libro " . $e->getMessage();
            return false;
        }
    }




    public function borrarLibro($id)
    {
        try {
            $sql  = "DELETE FROM libros_guardados WHERE id_libro = ?";

            $stmt =  $this->conn->prepare($sql);


            $stmt->execute(array($id));
            return true;
        } catch (PDOException $e) {
            echo "Error al borrar libro " . $e->getMessage();
            return false;
        }
    }


    public function cargarDatos()
    {
        try {
            $sql = "SELECT id_libro, email_usuario, id_libro_google, titulo, autor, imagen_portada, resena_personal, fecha_guardado FROM libros_guardados WHERE id_libro = ?";
            $stmt = $this->conn->prepare($sql);
            $id = $this->getId_libro();
            $stmt->execute(array($id));
            return  $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error buscando libro " . $e->getMessage();
            return false;
        }
    }


    public function actualizarLibro($dato)
    {

        $id_libro = $dato->id_libro;
        $email_usuario = $dato->email_usuario;
        $id_libro_google = $dato->id_libro_google;
        $titulo = $dato->titulo;
        $autor = $dato->autor;
        $imagen_portada = $dato->imagen_portada;
        $resena_personal = $dato->resena_personal;
        try {
            if (strlen($imagen_portada) != 0) {
                $sql = "UPDATE libros_guardados set email_usuario=?, id_libro_google=?, titulo=?, autor=?, imagen_portada=?, resena_personal=? WHERE id_libro = ?";

                $stmt = $this->conn->prepare($sql);

                $stmt->execute(array($email_usuario, $id_libro_google, $titulo, $autor, $imagen_portada, $resena_personal, $id_libro));
            } else {
                $sql = "UPDATE libros_guardados set email_usuario=?, id_libro_google=?, titulo=?, autor=?, resena_personal=? WHERE id_libro = ?";

                $stmt = $this->conn->prepare($sql);

                $stmt->execute(array($email_usuario, $id_libro_google, $titulo, $autor,  $resena_personal, $id_libro));
            }
        } catch (PDOException $e) {
            echo "Error al actualizar libro " . $e->getMessage();
            return false;
        }
    }
}
