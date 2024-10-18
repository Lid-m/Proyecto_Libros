<?php 
include_once 'consultas.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="lib/bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>

<div class="container py-4">
	<div class="row justify-content-center">
		<div class="col-md-4">
		
			<div class="card">
				<div class="card-header">
					Registro de Usuario
				</div>
				<form action="consultas.php" method="post" enctype="multipart/form-data">
					<div class="m-2">
						<label class="form-label">Usuario
							<input type="text" class="form-control" name="txtUsuario" autofocus>
						</label>
					</div>
					<div class="m-2">
						<label class="form-label">Password
							<input type="text" class="form-control" name="txtPass" autofocus>
						</label>
					</div>
					
					<div class="d-grid">
                        <input type="submit" class="btn btn-primary" value="Registrar">
					</div>
                    <div class="d-grid m-2">
						<a href="registroUsu.php" class="text-center">
							<button type="button" class="btn btn-success bt-sm">Cancelar!!!</button>
						</a>
					</div>
			</div>
		
			
			
		</div>
	</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="lib/bootstrap-5.3.3/js/bootstrap.min.js"></script>
</body>
</html>