<?php 
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "No hay sesión activa"; // Para depuración
    header('Location: login.php'); // Redirigir si no está logueado
    exit();
} else {
    echo "Sesión activa: " . $_SESSION['usuario']; // Para depuración
}

include_once 'templates/header.php';
include_once 'db/Conexion.php';
include_once 'consultas.php';
?>
    <div class="container">
        <div class="row">
            <div class="col text-center mt-3 "  >
                <h1>LIBROS</h1>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4 ">
            <?php foreach (libro($con) as $key => $value) { ?>
            <div class="col mt-5">
            <div class="card h-100 text-center" style="width: 14rem;">
                <img src="DBphp/<?=$value['fotos'] ?>" class="card-img-top d-block mx-auto" alt="Sin imagen" style="max-width: 200px; height: 300px; object-fit: cover; ">
                <div class="card-body">
                    <h5 class="card-title"><?=$value['titulo'] ?></h5>
                    <p class="card-text"><?=$value['descripcion'] ?></p>
                    <a href="#" class="btn btn-primary">Leer</a>
                </div>
                </div>
            </div> <?php }?>
        </div> 
        <p> principal</p>
    </div>
    <div class="d-grid m-2">
		<a href="logout.php" class="text-center">
		<button type="button" class="btn btn-success bt-sm">cerrar secion</button>
		</a>
	</div>
    <div class="container">
    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']); ?></h1>
    <div class="d-grid m-2">
        <a href="logout.php" class="text-center">
            <button type="button" class="btn btn-success">Cerrar sesión</button>
        </a>
    </div>
    <!-- Resto del contenido -->
</div>


<?php 
include 'templates/footer.php';

?>