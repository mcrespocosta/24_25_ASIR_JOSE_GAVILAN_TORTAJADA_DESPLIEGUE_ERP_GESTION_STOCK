<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
    exit;
}

require('functions.php');

// Obtener filtro de búsqueda
$producto = isset($_GET['nombre_juego']) ? $_GET['nombre_juego'] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Virtual Chest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">VideoGames STORE</a>
            <div id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Inicio</a>
                    </li>
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="form_crear_users.php">Crear Usuario</a></li>
                        <li class="nav-item"><a class="nav-link" href="añadir_productos.php">Añadir Productos</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Virtual Chest</h1>
                <form method="GET" action="index.php">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nombre_juego" placeholder="Buscar productos" value="<?php echo htmlspecialchars($producto); ?>" />
                        <button class="btn btn-outline-light" type="submit">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <!-- Productos -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $sql = "SELECT id, nombre, precio, cantidad, img FROM productos WHERE nombre LIKE '%$producto%';";
                $result = conexionBD($sql);

                while ($producto = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Imagen -->
                            <img src="imagen.php?id=<?= $producto['id'] ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">

                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                    <p><strong>Precio:</strong> <?php echo (fmod($producto['precio'], 1) == 0) ? intval($producto['precio']) : number_format($producto['precio'], 2); ?>€</p>
                                    <p><strong>Cantidad:</strong> <?php echo $producto['cantidad']; ?></p>
                                </div>
                            </div>
                            <!-- Botón Editar -->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="editar_producto.php?id=<?php echo $producto['id']; ?>">Editar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
    </footer>

    <!-- Core theme JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
