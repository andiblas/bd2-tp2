
<?php
// Conectando y seleccionado la base de datos
$dbconn = pg_connect("host=localhost dbname=tp2 port=5434 user=postgres password=demo")
or die('No se ha podido conectar: ' . pg_last_error());

//intentando chequear
$nombre= $_POST['nombre'];
$apellido= $_POST['apellido'];
$usuario= $_POST['nnombre'];
$pass = $_POST['npassword'];
session_start();
$query = "INSERT INTO usuario VALUES ('". $nombre ."','". $apellido ."','". $usuario ."','". $pass . "');";

$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

header("Location: login.html");

// Liberando el conjunto de resultados
pg_free_result($result);

// Cerrando la conexión
pg_close($dbconn);

?>

