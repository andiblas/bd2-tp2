
<?php
// Conectando y seleccionado la base de datos
$dbconn = pg_connect("host=localhost dbname=tp2 port=5434 user=postgres password=demo")
or die('No se ha podido conectar: ' . pg_last_error());


//intentando chequear
$passVieja = $_POST['npasswordVieja'];
$passNueva = $_POST['npasswordNueva'];
session_start();
$queryCon = "Select * from persona where usuario='". $_SESSION['usuario'] ."';";
$queryAct = "UPDATE persona SET clave='". $passNueva ."' where usuario='". $_SESSION['usuario'] ."' and clave='". $passVieja . "';";
$result = pg_query($queryCon) or die('La consulta fallo: ' . pg_last_error());
$num = pg_num_rows($result);
$row = pg_fetch_array($result);

if($row['clave']!=$passVieja){
    echo "clave incorrecta";
}else{
    $result = pg_query($queryAct) or die('La consulta fallo: ' . pg_last_error());
    header("Location: login.html");
}

// Liberando el conjunto de resultados
pg_free_result($result);

// Cerrando la conexión
pg_close($dbconn);

?>

