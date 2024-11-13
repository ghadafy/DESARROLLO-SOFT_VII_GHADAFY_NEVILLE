<?php
class Usuario
{

    private $id_usuario;
    private $nombre;
    private $email;
    private $id_google;
    private $fecha_registro;
    public $conn;

    //getters 
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getId_google()
    {
        return $this->id_google;
    }

    public function getFecha_registro()
    {
        return $this->fecha_registro;
    }

    //setters
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setId_google($id_google)
    {
        $this->id_google = $id_google;
    }




    public function __construct()
    {
        try {
            $this->conn = db::conexion();
        } catch (PDOException $e) {
            echo "Error en DB " . $e->getMessage();
        }
    }


    public function obtenerUsuario()
    {
        $googleId = $this->getId_google();
        $email = $this->getEmail();

        $sql = "SELECT * FROM usuarios WHERE id_google = ? OR email = ?";
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute(array($googleId, $email));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si se encuentra un usuario, devolver los datos
            if ($result) {
                return $result;  // Retorna el usuario encontrado
            } else {
                return false;  // No se encuentra el usuario
            }
        } catch (PDOException $e) {
            echo "Error en la consulta a los usuarios: " . $e->getMessage();
            return false;
        }
    }


    public function actualizarUsuario()
    {
        $googleId = $this->getId_google();
        $name = $this->getNombre();
        $email = $this->getEmail();
        $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id_google = ?";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(array($name, $email, $googleId));
        } catch (PDOException $e) {
            echo "Error en la actualización de usuario" . $e->getMessage();
        }
    }


    public function insertarUsuario()
    {
        $googleId = $this->getId_google();
        $name = $this->getNombre();
        $email = $this->getEmail();
        $sql = "INSERT INTO usuarios (id_google, nombre, email) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute(array($googleId, $name, $email));
        } catch (PDOException $e) {
            echo "Error en la inserción de usuario" . $e->getMessage();
        }
    }
}
