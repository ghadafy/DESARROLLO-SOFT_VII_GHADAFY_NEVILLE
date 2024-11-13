<?php
require_once 'helper.php';
class db
{

    private static $pdo;

    public static function conexion()
    {

        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $password = getenv('DB_PASS');

        try {
            // Crear la instancia PDO solo si no existe aún
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, "");
            // Establecer el modo de error a excepción
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Si hay un error en la conexión, lo capturamos y mostramos el mensaje
            echo "Error de conexión: " . $e->getMessage();
            exit; // Salir si no se puede conectar
            return false;
        }


        // Retornar la conexión
        return self::$pdo;
    }
}
