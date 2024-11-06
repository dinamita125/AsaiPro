<?php
class Crud {
    private $conexion;
    private $tableName;
    private $camposDatos;

    public function __construct($conexion, $tableName, $camposDatos) {
        $this->conexion = $conexion;
        $this->tableName = $tableName;
        $this->camposDatos = $camposDatos;
    }

    public function guardarRegistro() {
        $campos = array_keys($this->camposDatos);
        $valores = array_values($this->camposDatos);
    
        // Excluye la columna de clave primaria si es auto_increment
        $result = $this->conexion->query("SHOW KEYS FROM $this->tableName WHERE Key_name = 'PRIMARY'");
        $primaryKey = $result->fetch_assoc();
        if ($primaryKey && $primaryKey['Column_name'] && strpos($primaryKey['Extra'], 'auto_increment') !== false) {
            $pkColumn = $primaryKey['Column_name'];
            $pkIndex = array_search($pkColumn, $campos);
            if ($pkIndex !== false) {
                unset($campos[$pkIndex]);
                unset($valores[$pkIndex]);
            }
        }
    
        $camposStr = implode(", ", $campos);
        $placeholders = implode(", ", array_map(function($v) { return "'$v'"; }, $valores));
    
        $sql = "INSERT INTO $this->tableName ($camposStr) VALUES ($placeholders)";
    
        if ($this->conexion->query($sql) === TRUE) {
            return "Registro insertado correctamente.";
        } else {
            return "Error al insertar registro: " . $this->conexion->error;
        }
    }    

    public function modificarRegistro($id) {
        // Obtener el nombre de la clave primaria dinámicamente
        $primaryKey = "id"; // Valor predeterminado
        $result = $this->conexion->query("SHOW KEYS FROM $this->tableName WHERE Key_name = 'PRIMARY'");
        if ($result && $row = $result->fetch_assoc()) {
            $primaryKey = $row['Column_name'];
        }

        $camposActualizados = [];
        foreach ($this->camposDatos as $campo => $valor) {
            $camposActualizados[] = "$campo = '$valor'";
        }
        $camposActualizadosStr = implode(", ", $camposActualizados);

        $sql = "UPDATE $this->tableName SET $camposActualizadosStr WHERE $primaryKey = $id";

        if ($this->conexion->query($sql) === TRUE) {
            return "Registro modificado correctamente.";
        } else {
            return "Error al modificar registro: " . $this->conexion->error;
        }
    }

    public function eliminarRegistro($id) {
        // Obtener el nombre de la clave primaria dinámicamente
        $primaryKey = "id"; // Valor predeterminado
        $result = $this->conexion->query("SHOW KEYS FROM $this->tableName WHERE Key_name = 'PRIMARY'");
        if ($result && $row = $result->fetch_assoc()) {
            $primaryKey = $row['Column_name'];
        }

        $sql = "DELETE FROM $this->tableName WHERE $primaryKey = $id";
        if ($this->conexion->query($sql) === TRUE) {
            return "Registro eliminado correctamente.";
        } else {
            return "Error al eliminar registro: " . $this->conexion->error;
        }
    }
}
?>
