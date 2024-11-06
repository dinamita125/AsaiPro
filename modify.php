<?php
require_once 'Database.php';
require_once 'Crud.php';

$database = new Database();
$conexion = $database->getConexion();
$table = $_GET['table'];
$id = $_GET['id'];

$primaryKey = "id"; // Nombre predeterminado; cambia esto según la tabla

// Obtener el nombre de la clave primaria dinámicamente
$result = $conexion->query("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");
if ($result && $row = $result->fetch_assoc()) {
    $primaryKey = $row['Column_name'];
}

// Procesar el formulario al enviar
if ($_SERVER["REQUEST_METHOD"] == "POST" && $table) {
    $camposDatos = [];
    foreach ($_POST as $campo => $valor) {
        $camposDatos[$campo] = $valor;
    }
    $crud = new Crud($conexion, $table, $camposDatos);
    $resultado = $crud->modificarRegistro($id);
    echo "<p>$resultado</p>";
} else {
    // Mostrar el formulario para modificar el registro
    $query = "SELECT * FROM $table WHERE $primaryKey = $id";
    $resultado = $conexion->query($query);
    if ($resultado && $resultado->num_rows > 0) {
        $registro = $resultado->fetch_assoc();
        echo "<form method='POST'>";
        foreach ($registro as $campo => $valor) {
            echo "<label>$campo</label><input type='text' name='$campo' value='$valor'><br>";
        }
        echo "<button type='submit'>Modificar</button>";
        echo "</form>";
    } else {
        echo "<p>No se encontró el registro para modificar.</p>";
    }
}

$database->closeConexion();
?>
