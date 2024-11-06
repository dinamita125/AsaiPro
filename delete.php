<?php
require_once 'Database.php';

$database = new Database();
$conexion = $database->getConexion();

if (isset($_GET['table']) && isset($_GET['id'])) {
    $table = $_GET['table'];
    $id = $_GET['id'];

    // Detecta la columna primaria según la tabla
    $primaryKey = 'id'; // Valor por defecto

    // Ajusta la columna primaria dependiendo de la tabla
    switch ($table) {
        case 'Proveedor':
            $primaryKey = 'id_proveedor';
            break;
        case 'Insumos':
            $primaryKey = 'id_insumos';
            break;
        case 'Persona':
            $primaryKey = 'id_personal';
            break;
        case 'Funciones':
            $primaryKey = 'id_funciones';
            break;
        case 'Turno':
            $primaryKey = 'id_turno';
            break;
        case 'Personal_Campo':
            $primaryKey = 'id_personal_campo';
            break;
        case 'Personal_Planta':
            $primaryKey = 'id_personal_planta';
            break;
        case 'Personal_Ventas':
            $primaryKey = 'id_persona_ventas';
            break;
        case 'Lote':
            $primaryKey = 'id_Lote';
            break;
        case 'Cosecha':
            $primaryKey = 'id_cosecha';
            break;
        case 'Recepcion':
            $primaryKey = 'id_recepcion';
            break;
        case 'Despulpado':
            $primaryKey = 'id_recepcion';
            break;
        case 'Bolsas':
            $primaryKey = 'id_bolsas';
            break;
        case 'Congelador':
            $primaryKey = 'id_congelador';
            break;
        case 'Existencia':
            $primaryKey = 'id_existencia';
            break;
        case 'Cliente':
            $primaryKey = 'CI'; // Asumiendo que CI es clave primaria
            break;
        case 'Transporte':
            $primaryKey = 'Tipo_transporte'; // Cambiar si hay otro identificador
            break;
        case 'Pedido':
            $primaryKey = 'id_pedido';
            break;
        case 'Ventas':
            $primaryKey = 'id_venta';
            break;
        case 'Asistencia':
            $primaryKey = 'id_asistencia';
            break;
        case 'Salario':
            $primaryKey = 'id_salario';
            break;
        default:
            // Usa "id" como predeterminado si no hay una columna específica
            break;
    }

    // Verifica si es necesario eliminar registros relacionados en otras tablas antes de eliminar el principal
    if ($table === 'Proveedor') {
        $conexion->query("DELETE FROM Insumos WHERE id_proveedor = $id");
    }

    // Ahora elimina el registro en la tabla principal
    $query = "DELETE FROM $table WHERE $primaryKey = $id";

    if ($conexion->query($query) === TRUE) {
        echo "Registro eliminado correctamente";
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
}

$database->closeConexion();
?>
