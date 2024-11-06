<?php
class Database {
    private $host = "localhost";
    private $username = "root";  // Cambia por tu usuario de base de datos
    private $password = "";  // Cambia por tu contraseña de base de datos
    private $dbname = "gestion_asai";
    public $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function getConexion() {
        return $this->conexion;
    }

    public function closeConexion() {
        $this->conexion->close();
    }
}
?>
