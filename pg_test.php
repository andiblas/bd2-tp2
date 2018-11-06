	 	 	 	
<?php
// Conectando y seleccionado la base de datos
$dbconn = pg_connect("host=localhost dbname=tp2 port=5434 user=postgres password=demo")
or die('No se ha podido conectar: ' . pg_last_error());


//intentando chequear
$usuario = $_POST['nnombre'];
$pass = $_POST['npassword'];
$query = "SELECT * FROM usuario where usuario='". $usuario ."'";
$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

if($row = pg_fetch_array($result)){
if($row['clave'] == $pass){
/*session_start();
$_SESSION['usuario'] = $usuario;
header("Location: contenido.php");*/
echo "Hola";
}else{
header("Location: login.html");
exit();
}
}else{
header("Location: login.html");
exit();
}

/*
// Realizando una consulta SQL
$query = 'SELECT * FROM usuario';
$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
*/
// Imprimiendo los resultados en HTML
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
echo "\t<tr>\n";
foreach ($line as $col_value) {
echo "\t\t<td>$col_value</td>\n";
}
echo "\t</tr>\n";
}
echo "</table>\n";


// Liberando el conjunto de resultados
pg_free_result($result);

// Cerrando la conexión
pg_close($dbconn);
?>
