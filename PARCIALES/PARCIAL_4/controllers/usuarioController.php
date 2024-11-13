<?php

require_once 'models/usuario.php';


class usuarioController
{

    private $usuarioModel;


    public function __construct()
    {
        $this->usuarioModel = new Usuario();
    }



    public function guardarUsuario()
    {
        // Verificar si el usuario ya existe

        $this->usuarioModel->setEmail($_SESSION['user']['email']);
        $this->usuarioModel->setId_google($_SESSION['user']['id_google']);
        $this->usuarioModel->setNombre($_SESSION['user']['nombre']);

        // Si el usuario existe, actualizarlo, si no, insertarlo
        if ($this->usuarioModel->obtenerUsuario()) {
            // Actualizar el usuario
            $this->usuarioModel->actualizarUsuario();
        } else {
            // Insertar un nuevo usuario
            $this->usuarioModel->insertarUsuario();
        }

        // Responder con éxito
        return true;
        echo json_encode(['success' => true, 'message' => 'Usuario guardado correctamente']);
    }
}
