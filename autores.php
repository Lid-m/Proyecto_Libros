<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        echo "No hay sesión activa"; // Para depuración
        header('Location: login.php'); // Redirigir si no está logueado
        exit();
    } else {
        echo "Sesión activa: " . $_SESSION['usuario']; // Para depuración
    }
    include_once 'consultas.php';
    include_once 'templates/header.php';

?>

<div class="container py-4">
    <div class="row justify-content-center">
    <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    LISTA DE AUTORES
                </div>
                <div class="p-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (autor($con) as $key => $value) { ?>
                                <tr>
                                    <td><?=$value['nombre'] ?></td>
                                    <td><?=$value['apePaterno'] ?></td>
                                    <td><?=$value['apeMaterno'] ?></td>
                                    <td>
										<a href="autores.php?editAutor=editar&idAutor=<?=$value['idAutor'] ?>">
											<button type="button" class="btn btn-success btn-sm">Editar</button>
										</a>
									</td>
									<td>
										<a href="autores.php?delAutor=eliminar&idAutor=<?=$value['idAutor']?>">
											<button type="button" class="btn btn-danger btn-sm">Eliminar</button>
										</a>
									</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">

        <?php if (!isset($_GET['editAutor'])) { ?>

            <div class="card">
                <div class="card-header">
                    Adicionar Autor
                </div>
                <form action="consultas.php" method="post">
                    <div class="m-2">
                        <label class="form-label">Nombre
                            <input type="text" class="form-control" name="txtNombre" autofocus>
                        </label>
                    </div>
                    <div class="m-2">
                        <label class="form-label">Apellido Paterno
                            <input type="text" class="form-control" name="txtPaterno" autofocus>
                        </label>
                    </div>
                    <div class="m-2">
                        <label class="form-label">Apellido Materno
                            <input type="text" class="form-control" name="txtMaterno" autofocus>
                        </label>
                    </div>
                    <div class="m-2">
						<div class="d-grid">
							<input type="hidden" name="addAutor" value="addAutor">
							<input type="submit" class="btn btn-primary" value="Registrar">
						</div>	
					</div>
                </form>
            </div>
            <?php } 
			else { ?>
            <div class="card">
				<div class="card-header">
					Modificar Autor --> idAutor=<?=$datosAutor['idAutor']?> 
				</div>
				<form action="consultas.php" method="post">
					<div class="m-2">
						<label class="form-label">Nombre
							<input type="text" class="form-control" name="txtNombre" value="<?=$datosAutor['nombre'] ?>" autofocus>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">Apellido Paterno
							<input type="text" class="form-control" name="txtPaterno" value="<?=$datosAutor['apePaterno'] ?>" autofocus>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">Apellido Materno
							<input type="text" class="form-control" name="txtMaterno" value="<?=$datosAutor['apeMaterno'] ?>" autofocus>
						</label>
					</div>
					<div class="m-2">
						<div class="d-grid">
							<input type="hidden" name="editarAutor" value="editarAutor">
									<!-- id de los registros a cambiar -->
							
							<input type="hidden" name="txtIdAutor" value="<?=$datosAutor['idAutor']?>">
							<input type="submit" class="btn btn-primary" value="Guardar cambio">
						</div>	
					</div>
				</form>
			</div>
		<?php } ?>	
        </div>
    </div>
</div>
<?php
include_once 'templates/footer.php';
?>