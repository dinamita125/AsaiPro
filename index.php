<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Açaí</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        h1 {
            color: #4b0082;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sucursal Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index1.php">Gestión de Entidades</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard -->
    <div class="container mt-4 text-center">
        <h1>Panel de Control</h1>
        <div class="row mt-4">
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card bg-primary text-white text-center">
                    <div class="card-body">
                        <h3>Clientes</h3>
                        <p class="count">5</p>
                        <p>Total de clientes registrados</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card bg-success text-white text-center">
                    <div class="card-body">
                        <h3>Empleados</h3>
                        <p class="count">6</p>
                        <p>Personal activo</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card bg-warning text-white text-center">
                    <div class="card-body">
                        <h3>Productos</h3>
                        <p class="count">17</p>
                        <p>Productos en catálogo</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card bg-info text-white text-center">
                    <div class="card-body">
                        <h3>Ventas Hoy</h3>
                        <p class="count">0</p>
                        <p>Facturas generadas hoy</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas realizar esta acción?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="confirmAction(true)">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Éxito -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="success-message">
                    Has eliminado correctamente
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showModal(actionType) {
            const modal = new bootstrap.Modal(document.getElementById("confirmModal"));
            document.getElementById("confirmModal").setAttribute("data-action", actionType);
            modal.show();
        }

        function confirmAction(isConfirmed) {
            const actionType = document.getElementById("confirmModal").getAttribute("data-action");

            if (isConfirmed) {
                const successModal = new bootstrap.Modal(document.getElementById("successModal"));
                const successMessage = document.getElementById("success-message");

                if (actionType === "delete") {
                    successMessage.innerText = "Has eliminado correctamente";
                } else if (actionType === "modify") {
                    successMessage.innerText = "Has modificado correctamente";
                }

                successModal.show();
            }
        }

        function deleteRecord() {
            showModal("delete");
        }

        function modifyRecord() {
            showModal("modify");
        }
    </script>
</body>
</html>
