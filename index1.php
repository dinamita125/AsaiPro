<?php
require_once 'Database.php';

// Inicializa la conexión a la base de datos
$database = new Database();
$conexion = $database->getConexion();

// Define las tablas de tu base de datos
$tablas = ["Proveedor", "Insumos", "Persona", "Funciones", "Turno", "Personal_Campo", 
           "Personal_Planta", "Personal_Ventas", "Lote", "Cosecha", "Recepcion", 
           "Despulpado", "Bolsas", "Congelador", "Existencia", "Cliente", "Transporte", 
           "Pedido", "Ventas", "Asistencia", "Salario"];

// Función para mostrar registros de la tabla
function mostrarRegistrosTabla($conexion, $table) {
    $query = "SELECT * FROM $table";
    $resultado = $conexion->query($query);

    if ($resultado && $resultado->num_rows > 0) {
        echo "<h2 class='text-center my-4'>Registros de la tabla: $table</h2>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-striped table-bordered'>";
        echo "<tr class='table-primary'>";
        $columns = array_keys($resultado->fetch_assoc());
        foreach ($columns as $column) {
            echo "<th>$column</th>";
        }
        echo "<th>Acciones</th>";
        echo "</tr>";

        $resultado->data_seek(0);
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>$cell</td>";
            }
            echo "<td>";
            echo "<a href='modify.php?table=$table&id={$row[array_key_first($row)]}' class='btn btn-warning btn-sm mx-1'>Modificar</a>";
            echo "<a href='delete.php?table=$table&id={$row[array_key_first($row)]}' class='btn btn-danger btn-sm mx-1'>Eliminar</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p class='text-center text-muted'>No hay registros en la tabla $table.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Entidades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <header class="bg-dark text-white text-center py-3">
        <h1>Gestión de Entidades</h1>
    </header>

    <!-- Botón para regresar al panel de control -->
    <div class="container text-center mt-4">
        <a href="index.php" class="btn btn-primary">Volver al Panel de Control</a>
    </div>

    <div class="container mt-4">
        <div class="row">
            <?php 
            $contador = 0; // Inicializar el contador
            foreach ($tablas as $tabla): ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h3 class="card-title"><?php echo $tabla; ?></h3>
                            <a href="register.php?table=<?php echo $tabla; ?>" class="btn btn-success btn-sm mt-2 w-100">Agregar</a>
                            <a href="index1.php?mostrar_tabla=<?php echo $tabla; ?>" class="btn btn-info btn-sm mt-2 w-100">Mostrar Tabla</a>
                            <a href="modify.php?table=<?php echo $tabla; ?>&id=ID_AQUI" class="btn btn-warning btn-sm mt-2 w-100">Modificar</a>
                            <a href="delete.php?table=<?php echo $tabla; ?>&id=ID_AQUI" class="btn btn-danger btn-sm mt-2 w-100">Eliminar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php
        // Verificar si se solicitó mostrar una tabla
        if (isset($_GET['mostrar_tabla'])) {
            $tablaSeleccionada = $_GET['mostrar_tabla'];
            mostrarRegistrosTabla($conexion, $tablaSeleccionada);
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Cierra la conexión al final de la página
$database->closeConexion();
?>
