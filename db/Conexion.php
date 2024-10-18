<?php
/**
 * Clase conexion, establece la conexion a la BD mediante em metodo PDO
 */
class Conexion
{
    private $db = 'mysql:host=localhost;dbname=biblioteca_php2';
    private $usuario = 'root';
    private $password = '';

    public function conectar() {
        try {
            $option = [
                PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($this->db, $this->usuario, $this->password, $option);
            //echo 'conectando...';
            return $pdo;
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
?>