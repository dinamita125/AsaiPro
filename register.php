<?php
require_once 'Database.php';
require_once 'Crud.php';

$database = new Database();
$conexion = $database->getConexion();

$table = $_GET['table'] ?? null;
$camposDatos = [];

// Procesar el formulario al enviar
if ($_SERVER["REQUEST_METHOD"] == "POST" && $table) {
    foreach ($_POST as $campo => $valor) {
        if ($campo !== 'id') { // Ignora el campo 'id' si es auto_increment
            $camposDatos[$campo] = $valor;
        }
    }
    $crud = new Crud($conexion, $table, $camposDatos);
    $resultado = $crud->guardarRegistro();
    echo "<p>$resultado</p>";
}

$database->closeConexion();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Datos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Registrar Datos en <?php echo htmlspecialchars($table); ?></h1>
    </header>
    <div class="container">
        <form method="POST">
            <?php
            if ($table) {
                // Generar campos de entrada según la tabla
                switch ($table) {
                    case "Proveedor":
                        echo "<label>Nombre</label><input type='text' name='Nombre' required>";
                        echo "<label>Ubicacion</label><input type='text' name='Ubicacion' required>";
                        echo "<label>Telefono</label><input type='text' name='Telefono' required>";
                        echo "<label>Producto</label><input type='text' name='Producto' required>";
                        break;
                    
                    case "Insumos":
                        echo "<label>Nombre</label><input type='text' name='Nombre' required>";
                        echo "<label>Cantidad</label><input type='number' name='Cantidad' required>";
                        echo "<label>Codigio</label><input type='text' name='Codigio' required>";
                        echo "<label>id_proveedor</label><input type='number' name='id_proveedor' required>";
                        break;

                    case "Persona":
                        echo "<label>Nombre</label><input type='text' name='Nombre' required>";
                        echo "<label>CI</label><input type='text' name='CI' required>";
                        echo "<label>Telefono</label><input type='text' name='Telefono' required>";
                        echo "<label>Grado_profesional</label><input type='text' name='Grado_profesional'>";
                        echo "<label>Estado_civil</label><input type='text' name='Estado_civil'>";
                        break;

                    case "Funciones":
                        echo "<label>Nombre_funcion</label><input type='text' name='Nombre_funcion' required>";
                        echo "<label>Descripcion</label><textarea name='Descripcion' required></textarea>";
                        echo "<label>Localizacion</label><input type='text' name='Localizacion' required>";
                        break;

                    case "Turno":
                        echo "<label>Hora_inicio</label><input type='time' name='Hora_inicio' required>";
                        echo "<label>Hora_fin</label><input type='time' name='Hora_fin' required>";
                        echo "<label>id_personal</label><input type='number' name='id_personal' required>";
                        echo "<label>Tipo_turno</label><input type='text' name='Tipo_turno' required>";
                        break;

                    case "Personal_Campo":
                        echo "<label>id_funciones</label><input type='number' name='id_funciones' required>";
                        echo "<label>id_personal</label><input type='number' name='id_personal' required>";
                        echo "<label>id_turno</label><input type='number' name='id_turno' required>";
                        break;

                    case "Bolsas":
                        echo "<label>id_despulpado</label><input type='number' name='id_despulpado' required>";
                        echo "<label>id_personal</label><input type='number' name='id_personal' required>";
                        echo "<label>Numero_lote</label><input type='number' name='Numero_lote' required>";
                        echo "<label>Concentracion</label><input type='number' step='0.01' name='Concentracion' required>";
                        echo "<label>Fecha_elaboracion</label><input type='date' name='Fecha_elaboracion' required>";
                        echo "<label>Fecha_vencimiento</label><input type='date' name='Fecha_vencimiento' required>";
                        break;

                    case "Existencia":
                        echo "<label>id_bolsa</label><input type='number' name='id_bolsa' required>";
                        echo "<label>Cantidad_bolsas</label><input type='number' name='Cantidad_bolsas' required>";
                        echo "<label>id_congelador</label><input type='number' name='id_congelador' required>";
                        break;

                    case "Cliente":
                        echo "<label>Nombre</label><input type='text' name='Nombre' required>";
                        echo "<label>Telefono</label><input type='text' name='Telefono' required>";
                        echo "<label>CI</label><input type='text' name='CI' required>";
                        echo "<label>Lugar</label><input type='text' name='Lugar' required>";
                        break;

                    case "Ventas":
                        echo "<label>id_pedido</label><input type='number' name='id_pedido' required>";
                        echo "<label>id_bolsa</label><input type='number' name='id_bolsa' required>";
                        echo "<label>cantidad_vendida</label><input type='number' name='cantidad_vendida' required>";
                        echo "<label>id_personal_ventas</label><input type='number' name='id_personal_ventas' required>";
                        echo "<label>precio_unitario</label><input type='number' step='0.01' name='precio_unitario' required>";
                        echo "<label>total_venta</label><input type='number' step='0.01' name='total_venta' required>";
                        echo "<label>metodo_pago</label><input type='text' name='metodo_pago' required>";
                        echo "<label>descuento</label><input type='number' step='0.01' name='descuento'>";
                        echo "<label>id_transporte</label><input type='text' name='id_transporte' required>";
                        echo "<label>impuestos</label><input type='number' step='0.01' name='impuestos' required>";
                        echo "<label>id_cliente</label><input type='text' name='id_cliente' required>";
                        echo "<label>NIT</label><input type='text' name='NIT'>";
                        break;

                    case "Pedido":
                        echo "<label>Cantidad_bolsas</label><input type='number' name='Cantidad_bolsas' required>";
                        echo "<label>Fecha</label><input type='date' name='Fecha' required>";
                        echo "<label>id_personal_ventas</label><input type='number' name='id_personal_ventas' required>";
                        break;

                    // Agregar más casos según las tablas necesarias
                }
                echo "<button type='submit'>Registrar</button>";
            } else {
                echo "<p>Tabla no seleccionada.</p>";
            }
            ?>
        </form>
        <a href="index1.php"><button type="button">Volver</button></a>
    </div>
</body>
</html>
