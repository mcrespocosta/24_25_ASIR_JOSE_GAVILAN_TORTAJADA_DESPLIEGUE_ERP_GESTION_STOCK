<?php

session_start();
if(!isset($_SESSION['nombre'])){
    header("Location:login.html");
    exit;
}
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
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
                    <h2 class="h4 text-center mb-4">Crear Usuario</h2>

                    <form action="crear_new_user.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de Usuario</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" id="nacimiento" name="nacimiento" class="form-control" required />
                        </div>
                        
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select id="rol" name="rol" class="form-control" required>
                                <option value="empleado">Empleado</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        

                        <button type="submit" class="btn btn-primary w-100">Crear Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
