<?php 
	include_once 'db/Conexion.php';
	// instanciamos el objeto para la clase Conexion
	$conexion = new Conexion;
	$con = $conexion->conectar();
	//var_dump($con);
/*********************************8
 * funcion libro(), devuelve el resultado de la consulta para ver los datos de la tabla libro
 * ********************************/
function libro($conect){
	// almacenamos en la variable $sql la consulta ala tabla libro
	$sql = $conect->query('SELECT * FROM libro l INNER JOIN autorlibro al ON l.idLibro=al.idLibro INNER JOIN autor a ON al.idAutor=a.idAutor');
	// ejecutamos la consulta a traves del metodo execute()
	$sql->execute();
	// almacenamos en una variable la consulta, que en este caso tiene mas de un registro, por ello llamamos al metodo fetchAll(), si el resutado de la consulta es solo un registro, llamamos al metodo fetch();
	$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($resultado);
	return $resultado;
}
//var_dump(libro($con));


/*********************************8
 * funcion autor(), devuelve los datos de la tabla autor
 * ********************************/
function autor($conect){
	$sql = $conect->query('SELECT * FROM autor');
	$sql->execute();
	$res_autor = $sql->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($res_autor);
	return $res_autor;
}
/*********************************8
 * funcion addLibro(), para adicionar libro
 * ********************************/
if (isset($_POST['add'])) {
	function addLibro($conect){
		// recuperamos los datos del Formulario
		$titulo = $_POST['txtTitulo'];
		$isbn = $_POST['txtIsbn'];
		$editorial = $_POST['txtEditorial'];
		$paginas = $_POST['txtPaginas'];
		$idAutor = $_POST['txtAutor'];
		$descripcion = $_POST['txtDescripcion'];
		//Variable para la imagen
		$imagen='';
		if (isset($_FILES['fotos'])) {
			$file = $_FILES['fotos'];
			$nombre = $file['name'];
			$tipo = $file['type'];
			$ruta_provicional = $file['tmp_name'];
			$size = $file['size'];
			$dimenciones = getimagesize($ruta_provicional);
			$width = $dimenciones[0];
			$height = $dimenciones[1];
			$carpeta = "img/";
			if($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/jfif'){
				echo "Error, el archivo no es una imagen";
			}
			else if ($size >3*1024*1024){
				echo "el tamño permitido es de 3MB";
			} else {
				$src = $carpeta.$nombre;
				// MOVER EL ARCHIVO A LA CARPETA DESEADA
				move_uploaded_file($ruta_provicional, $src);
				$imagen = "../img/".$nombre;
			}
		}
		// print_r($_POST);
		// CONSULTA PARA ADICIONAR EL LIBRO EN LA TABLA libro
		$sql_insert = 'INSERT INTO libro(titulo, isbn, editorial, paginas, fotos, descripcion)VALUES(?,?,?,?,?,?)';
		// PREPARAMOS LA CONSULTA
		$sent_insert = $conect->prepare($sql_insert);
		$sent_insert->execute(array($titulo, $isbn, $editorial,$paginas, $imagen, $descripcion));
		// obtenemos el id del ultimo registro insertado en la taba libro
		$idGenerado =  $conect->lastInsertId();
		//var_dump($idGenerado);
		// Consulta para registrar idAutor, idLibro en la tabla autorLibro
		$sql_insert = 'INSERT INTO autorlibro(idAutor, idLibro)VALUES(?,?)';
		// PREPARAMOS LA CONSULTA
		$sent_insert = $conect->prepare($sql_insert);
		$sent_insert->execute(array($idAutor,$idGenerado));
		header('location:libros.php');
	}
	addLibro($con);
}
/**************************************
 * funcion datosLibrosEdit(), muestra los datos del libro seleccionado en el formulario
 *************************************/
function datosLibroEdit($conect) {
	$idLibro = $_GET['idLibro'];
	//consulta
	$sql = 'SELECT * FROM libro l INNER JOIN autorlibro al ON l.idLibro=al.idLibro INNER JOIN autor a ON al.idAutor=a.idAutor WHERE l.idLibro=?';
	$sent = $conect->prepare($sql);
	$sent->execute(array($idLibro));
	$res = $sent->fetch();
	return $res;
}
if(isset($_GET['edit'])) {
	$datosLibro = datosLibroEdit($con);
}
/*********************************8
 * funcion editLibro(), mididica datos en la tabla libro Libro
 * ********************************/
	function editLibro($conect){
		// recuperamos los datos del Formulario
		//ids para las condiciones del UPDATE
		$idLibro = $_POST['txtIdLibro'];
		$idAutorLibro = $_POST['txtIdAutor'];
	
		// datos para combiar el las tablas
		$titulo = $_POST['txtTitulo'];
		$isbn = $_POST['txtIsbn'];
		$editorial = $_POST['txtEditorial'];
		$paginas = $_POST['txtPaginas'];
		$descripcion = $_POST['txtDescripcion'];
		$idAutor = $_POST['txtAutor'];
		// print_r($_POST);
		// var_dump($editorial);

		$imagen='';
		if (isset($_FILES['foto'])) {
			$file = $_FILES['foto'];
			$nombre = $file['name'];
			$tipo = $file['type'];
			$ruta_provicional = $file['tmp_name'];
			$size = $file['size'];
			$dimenciones = getimagesize($ruta_provicional);
			$width = $dimenciones[0];
			$height = $dimenciones[1];
			$carpeta = "img/";
			if($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/jfif'){
				echo "Error, el archivo no es una imagen";
			}
			else if ($size >3*1024*1024){
				echo "el tamño permitido es de 3MB";
			} else {
				$src = $carpeta.$nombre;
				// MOVER EL ARCHIVO A LA CARPETA DESEADA
				move_uploaded_file($ruta_provicional, $src);
				$imagen = "../img/".$nombre;
			}
		} else {echo "No se recibio imagen";}

		// Sentencia para editar datos de la tabla libro
		$sql_edit_lib = 'UPDATE libro SET titulo=?, isbn=?, editorial=?, paginas=?, fotos=?, descripcion=? WHERE idLibro=?';
		$sent_edit_lib = $conect->prepare($sql_edit_lib);
		$sent_edit_lib->execute(array($titulo, $isbn, $editorial, $paginas, $imagen, $descripcion, $idLibro));
		// Sentencia para editar datos de la tabla autorLibro
		$sql_edit_al = 'UPDATE autorlibro SET idAutor=? WHERE idAutor=? AND idLibro=?';
		$sent_edit_al = $conect->prepare($sql_edit_al);
		$sent_edit_al->execute(array($idAutor, $idAutorLibro, $idLibro));
		// Cerramos la conxion a la DB para la sendtencia 
		$sent_edit_lib = null;
		$sent_edit_al = null;
		$conect = null;
		//Redireccionamos a Libros.php
		header('location:libros.php');
		
	}
	if (isset($_POST['editar'])){
		editLibro($con);
	}
/*********************************8
 * funcion delLibro(), elimina registros libro y la relacion en la tabla autorLibro
 * ********************************/
function delLibro($cone) {
	// Recuperar los ids de los registros a eliminar
	$idLibro = $_GET['idLibro'];
	$idAutor = $_GET['idAutor'];
	// Consulta para eliminar registros de la tabla autorLibro
	$sql_del_al = 'DELETE FROM autorLibro WHERE idAutor=? AND idLibro=?';
	$sent_del_al = $cone->prepare($sql_del_al);
	$sent_del_al->execute(array($idAutor, $idLibro));
	// Consulta para eliminar registro de la tabla libro
	$sql_del_l = 'DELETE FROM libro WHERE idLibro=?';
	$sent_del_l = $cone->prepare($sql_del_l);
	$sent_del_l->execute(array($idLibro));
	// Cerramos la conxion a la DB para la sentencia
	$sent_del_l = null;
	$sent_del_al = null;
	$cone = null;
	//reddireccionamos a libros.php
	header('location:libros.php');
}
if (isset($_GET['del'])) {
	delLibro($con);
}

/**-----------------------AUTOR-------------------------- */

/*********************************8
 * funcion addLibro(), para adicionar libro
 * ********************************/
if (isset($_POST['addAutor'])) {
	function addAutor($conect){
		// recuperamos los datos del Formulario
		$nombre = $_POST['txtNombre'];
		$apePaterno = $_POST['txtPaterno'];
		$apeMaterno = $_POST['txtMaterno'];
		//print_r($_POST);
		// CONSULTA PARA ADICIONAR EL un autor EN LA TABLA autor
		$sql_insert = 'INSERT INTO autor(nombre, apePaterno, apeMaterno)VALUES(?,?,?)';
		// PREPARAMOS LA CONSULTA
		$sent_insert = $conect->prepare($sql_insert);
		$sent_insert->execute(array($nombre, $apePaterno, $apeMaterno));
		// obtenemos el id del ultimo registro insertado en la taba autor
		$idGenerado =  $conect->lastInsertId();
		//var_dump($idGenerado);
		// Consulta para registrar idAutor, idLibro en la tabla autorLibro
		//$sql_insert = 'INSERT INTO autorlibro(idAutor, idLibro)VALUES(?,?)';
		// PREPARAMOS LA CONSULTA
		// $sent_insert = $conect->prepare($sql_insert);
		// $sent_insert->execute(array($idAutor,$idGenerado));
		header('location:autores.php');
	}
	addAutor($con);
}
/**************************************
 * funcion datosAutorEdit(), muestra los datos del autor seleccionado en el formulario
 *************************************/
function datosAutorEdit($conect) {
	$idAutor = $_GET['idAutor'];
	//consulta
	$sql = 'SELECT * FROM libro l INNER JOIN autorlibro al ON l.idLibro=al.idLibro INNER JOIN autor a ON al.idAutor=a.idAutor WHERE a.idAutor=?';
	$sent = $conect->prepare($sql);
	$sent->execute(array($idAutor));
	$res = $sent->fetch();
	return $res;
}
if(isset($_GET['editAutor'])) {
	$datosAutor = datosAutorEdit($con);
}
/*********************************8
 * funcion editAutor(), modifica datos en la tabla Autor
 * ********************************/
function editAutor($conect){
	// recuperamos los datos del Formulario
	//ids para las condiciones del UPDATE
	$idAutor = $_POST['txtIdAutor'];
	// $idAutorLibro = $_POST['txtIdAutor'];

	// datos para combiar el las tablas
	$nombre = $_POST['txtNombre'];
	$apePaterno = $_POST['txtPaterno'];
	$apeMaterno = $_POST['txtMaterno'];
	
	// print_r($_POST);
	// var_dump($editorial);

	// Sentencia para editar datos de la tabla Autor
	$sql_edit_autor = 'UPDATE autor SET nombre=?, apePaterno=?, apeMaterno=? WHERE idAutor=?';
	$sent_edit_autor = $conect->prepare($sql_edit_autor);
	$sent_edit_autor->execute(array($nombre, $apePaterno, $apeMaterno, $idAutor));
	// Sentencia para editar datos de la tabla autorLibro
	// $sql_edit_al = 'UPDATE autorlibro SET idAutor=? WHERE idAutor=? AND idLibro=?';
	// $sent_edit_al = $conect->prepare($sql_edit_al);
	// $sent_edit_al->execute(array($idAutor, $idAutorLibro, $idLibro));
	// Cerramos la conxion a la DB para la sendtencia 
	$sent_edit_autor = null;
	// $sent_edit_autor = null;
	$conect = null;
	//Redireccionamos a Libros.php
	header('location:autores.php');
	
}
if (isset($_POST['editarAutor'])){
	editAutor($con);
}
/*********************************8
 * funcion delAutor(), elimina registros autor
 * ********************************/
function delAutor($cone) {
	// Recuperar los ids de los registros a eliminar
	$idAutor = $_GET['idAutor'];
	
	// Consulta para eliminar registro de la tabla autor
	$sql_del_autor = 'DELETE FROM autor WHERE idAutor=?';
	$sent_del_autor = $cone->prepare($sql_del_autor);
	$sent_del_autor->execute(array($idAutor));
	// Cerramos la conxion a la DB para la sentencia
	$sent_del_autor = null;
	$cone = null;
	//reddireccionamos a autores.php
	header('location:autores.php');
}
if (isset($_GET['delAutor'])) {
	delAutor($con);
}

/*********************************8
 * funcion addUsuario(), para adicionar Usuarios
 * ********************************/
function addUsuario($cone){
	// recuperamos los datos del Formulario

	$usuario = htmlspecialchars(addslashes($_POST['txtUsuario']));
	$password = htmlspecialchars(addslashes($_POST['txtPass']));
// 		encriptamos el passwrod
	$passCod = password_hash($password, PASSWORD_DEFAULT, ['cost'=>12]);

	$sql = 'INSERT INTO usuarios(usuario, password)VALUES(?,?)';
	// PREPARAMOS LA CONSULTA
	$sent = $cone->prepare($sql);
	$sent->execute(array($usuario, $passCod));
	
	header('location:login.php');
}


if (isset($_POST['txtUsuario'])) {
addUsuario($con);
}
/*********************************8
* funcion usuario(), devuelve los datos de la tabla usuarios
* ********************************/
function usuario($cone) {
    $usuario = htmlspecialchars(addslashes($_POST['txtUsu']));
    $password = htmlspecialchars(addslashes($_POST['txtPas']));
    
    // Consulta para buscar el usuario
    $sql = 'SELECT * FROM usuarios WHERE usuario=?';
    
    // Preparamos la consulta
    $sent = $cone->prepare($sql);
    $sent->execute(array($usuario));
    $res = $sent->fetch(PDO::FETCH_ASSOC);
    
    if ($res) {
        // Verificamos la contraseña
        if (password_verify($password, $res['password'])) {
            session_start(); // Iniciar la sesión
            $_SESSION['usuario'] = $usuario; // Guardar el nombre de usuario en la sesión
            header('location:index.php'); // Redirigir a la página de inicio
            exit(); // Terminar el script
        }
    }
    // Si no se encontró el usuario o la contraseña es incorrecta
    header('location:login.php?error=credenciales'); // Redirigir al login con error
    exit(); // Terminar el script
}

if (isset($_POST['txtUsu'])) {
    usuario($con);
}
