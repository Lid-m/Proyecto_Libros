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
					LISTA DE LIBROS
				</div>
				<div class="p-4">
					<table class="table">
						<thead>
							<tr>
								<th>Titulo</th>
								<th>ISBN</th>
								<th>Autor</th>
								<th>Editorial</th>
								<th colspan="2">Operaciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach (libro($con) as $key => $value) { ?>
								<tr>
									<td><?=$value['titulo'] ?></td>
									<td><?=$value['isbn'] ?></td>
									<td><?=$value['nombre']." ".$value['apePaterno'] ?></td>
									<td><?=$value['editorial'] ?></td>
									<td>
										<a href="libros.php?edit=editar&idLibro=<?=$value['idLibro'] ?>">
											<button type="button" class="btn btn-success btn-sm">Editar</button>
										</a>
									</td>
									<td>
										
										<!-- Boton de eliminacion -->
										<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalElim<?=$value['idLibro']?>">Eliminar</button>
										
										<!-- Modal de eliminacion -->
										<div class="modal fade" id="modalElim<?=$value['idLibro']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h1 class="modal-title fs-5" id="staticBackdropLabel">Advertencia</h1>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													Esta segur@ que desea eliminar el libro: <?=$value['titulo'] ?> ?
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
													<a href="libros.php?del=eliminar&idLibro=<?=$value['idLibro'] ?>&idAutor=<?=$value['idAutor']?>">
													<button type="button" class="btn btn-primary">Estoy seguro</button></a>
												</div>
											</div>
										</div>
										</div>

									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-4">
		<?php if (!isset($_GET['edit'])) { ?>
			<div class="card">
				<div class="card-header">
					Adicionar Libro
				</div>
				<form action="consultas.php" method="post" enctype="multipart/form-data">
					<div class="m-2">
						<label class="form-label">Titulo
							<input type="text" class="form-control" name="txtTitulo" autofocus>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">ISBN
							<input type="text" class="form-control" name="txtIsbn" autofocus>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">Editorial
							<input type="text" class="form-control" name="txtEditorial" autofocus>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">Nro. de Paginas
							<input type="text" class="form-control" name="txtPaginas" autofocus>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">seleccionar imagen
							<input type="file" class="form-control" name="fotos" autofocus>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">Seleccionar Autor
							<select name="txtAutor" id="idAutor">
								<option value="">
									Seleccionar
								</option>
								<?php foreach (autor($con) as $key => $value) { ?>
								<option value="<?=$value['idAutor'] ?>">
									<?=$value['nombre']." ".$value['apePaterno']." ".$value['apeMaterno'] ?>
								</option>

								<?php } ?>

							</select>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">Descripcion
							<input type="text" class="form-control" name="txtDescripcion" autofocus>
						</label>
					</div>
					<div class="m-2">
						<div class="d-grid">
							<input type="hidden" name="add" value="addLibro">
							<input type="submit" class="btn btn-primary" value="Registrar">
						</div>	
					</div>
				</form>
			</div>
		<?php } 
			else { ?>
				<div class="card">
				<div class="card-header">
					Modificar Libro --> idLibro = <?=$datosLibro['idLibro']?>
					idAutor = <?=$datosLibro['idAutor']?> 
				</div>
				<form action="consultas.php" method="post" enctype="multipart/form-data">
					<div class="m-2">
						<label class="form-label">Titulo
							<input type="text" class="form-control" name="txtTitulo" value="<?=$datosLibro['titulo'] ?>" autofocus>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">ISBN
							<input type="text" class="form-control" name="txtIsbn" value="<?=$datosLibro['isbn'] ?>" autofocus>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">Editorial
							<input type="text" class="form-control" name="txtEditorial" value="<?=$datosLibro['editorial'] ?>" autofocus>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">Nro. de Paginas
							<input type="text" class="form-control" name="txtPaginas" value="<?=$datosLibro['paginas'] ?>" autofocus>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">Nueva imagen
							<input type="file" class="form-control" name="foto"  autofocus>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">Seleccionar Autor
							<select name="txtAutor" id="idAutor">
								<option value="<?=$datosLibro['idAutor'] ?>">
									<?=$datosLibro['nombre']." ".$datosLibro['apePaterno'].$datosLibro['apeMaterno'] ?>
								</option>
								<?php foreach (autor($con) as $key => $value) { ?>
								<option value="<?=$value['idAutor'] ?>">
									<?=$value['nombre']." ".$value['apePaterno'].$value['apeMaterno'] ?>
								</option>

								<?php } ?>

							</select>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">Descripcion
							<input type="text" class="form-control" name="txtDescripcion" value="<?=$datosLibro['descripcion'] ?>" autofocus>
						</label>
					</div>
					<div class="m-2">
						<div class="d-grid">
							<input type="hidden" name="editar" value="editarLibro">
									<!-- id de los registros a cambiar -->
							<input type="hidden" name="txtIdLibro" value="<?=$datosLibro['idLibro']?>">
							<input type="hidden" name="txtIdAutor" value="<?=$datosLibro['idAutor']?>">
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