<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="lib/bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <header><!--Encabezado de la pagina-->


    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Biblioteca</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="libros.php">Libros</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reportes</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="reportes/reporte.php" target="_blank">Lista de libros</a></li>
            <li><a class="dropdown-item" href="reportes/reporte2.php" target="_blank">Lista de libros 2</a></li>
            <li><a class="dropdown-item" href="reportes/reporteAsignacion.php" target="_blank">Matricula</a></li>
          </ul>
          
        </li>
        <li class="nav-item">
          <a class="nav-link" href="autores.php">Autores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>

      
        <p>encabezado</p>

    </header>