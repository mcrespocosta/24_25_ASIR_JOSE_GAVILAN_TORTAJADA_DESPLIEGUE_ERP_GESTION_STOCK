<?php

session_start();
if(!isset($_SESSION['nombre'])){
    header("Location:login.html");
    exit;
}?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Producto</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">VideoGames STORE</a>
            <div id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                    </li>

                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="form_crear_users.php">Crear Usuario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="form_cambiar_password.php">Cambiar Contraseña</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="añadir_productos.php">Añadir Productos</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="p-4 bg-white rounded shadow-sm">
                    <h2 class="h4 text-center mb-4">Añadir Producto</h2>

                    <form action="guardar_producto.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Producto</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" id="precio" name="precio" class="form-control" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" id="cantidad" name="cantidad" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="proveedor" class="form-label">Proveedor</label>
                            <select id="proveedor" name="proveedor" class="form-control" required>
                                <?php
                                include 'functions.php'; // Archivo con la función de conexión

                                $SQL = "SELECT id, nombre FROM proveedores";
                                $resultado = conexionBD($SQL);

                                while ($row = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen del Producto</label>
                            <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Sube una imagen del producto (formatos admitidos: JPEG, PNG).</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Guardar Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

