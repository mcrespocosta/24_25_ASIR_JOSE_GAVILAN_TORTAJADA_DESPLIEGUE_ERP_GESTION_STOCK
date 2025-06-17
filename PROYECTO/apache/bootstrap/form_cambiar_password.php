<?php

session_start();
if(!isset($_SESSION['nombre'])){
    header("Location:login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="css/styles.css" />
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

                    <?php 
                        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
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
                    <h2 class="h4 text-center mb-4">Cambiar Contraseña</h2>
                    <form action="cambiar_password.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Contraseña Actual</label>
                            <input type="password" id="current_password" name="current_password" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nueva Contraseña</label>
                            <input type="password" id="new_password" name="new_password" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required />
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Cambiar Contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
