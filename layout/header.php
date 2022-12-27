<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de clientes</title>

    <link rel="stylesheet" href="./resources/bootstrap-5/css/bootstrap.min.css">

    <link href="./resources/assets/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="./resources/assets/fontawesome/css/brands.css" rel="stylesheet">
    <link href="./resources/assets/fontawesome/css/solid.css" rel="stylesheet">

    <link href="./layout/styles/styles.css" rel="stylesheet">

    <script src="./resources/jquery/jquery.min.js"></script>
    <script src="./resources/bootstrap-5/js/bootstrap.min.js"></script>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Gestión de clientes</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Empleados
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="index.php?controller=employees&action=get">Ver listado de empleados</a></li>
                                <li><a class="dropdown-item" href="index.php?controller=employees&action=show_add_form">Agregar nuevo empleado</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <?php session_start(); if(isset($_SESSION['message'])): ?>
        <div class="d-flex justify-content-center" id="alert">
            <div class="alert alert-info text-center" role="alert"><?= $_SESSION['message'] ?></div>
        </div>
    <?php unset($_SESSION['message']); endif; ?>