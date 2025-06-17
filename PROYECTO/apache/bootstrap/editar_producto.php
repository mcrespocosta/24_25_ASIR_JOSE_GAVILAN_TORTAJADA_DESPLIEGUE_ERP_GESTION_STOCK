<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
    exit;
}

require('functions.php');

// Obtener ID del producto
$id_producto = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consultar datos del producto
$sql = "SELECT nombre, precio, cantidad, img FROM productos WHERE id = $id_producto";
$result = conexionBD($sql);
$producto = mysqli_fetch_assoc($result);

if (!$producto) {
    echo "<p>Producto no encontrado.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="p-4 bg-white rounded shadow-sm">
                    <h2 class="h4 text-center mb-4">Editar Producto</h2>
                    <form action="actualizar_producto.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id_producto; ?>">

                        <div class="mb-3 text-center">
                            <img src="<?php echo $imagen; ?>" alt="Imagen del producto" class="img-fluid mb-3" style="max-height: 200px;">
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Producto</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" id="precio" name="precio" class="form-control" step="0.01" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" id="cantidad" name="cantidad" class="form-control" value="<?php echo htmlspecialchars($producto['cantidad']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Actualizar Imagen</label>
                            <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Deja este campo vacío si no deseas cambiar la imagen.</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Actualizar Producto</button>
                    </form>
                    <form action="eliminar_producto.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto?');">
                        <input type="hidden" name="id" value="<?php echo $id_producto; ?>">
                        <button type="submit" class="btn btn-danger w-100 mt-2">Eliminar Producto</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
