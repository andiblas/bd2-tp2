
<?php

// Conectando y seleccionado la base de datos

$dbconn = pg_connect("host=localhost dbname=tp2 port=5434 user=postgres password=demo")
or die('No se ha podido conectar: ' . pg_last_error());

//intentando chequear
$usuario = $_POST['nnombre'];
$pass = $_POST['npassword'];
$query = "SELECT * FROM persona where usuario='". $usuario ."'";
$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
$passHash =  hash('sha512', $pass);


if($row = pg_fetch_array($result)){
    if($row['clave'] == $passHash){
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['clave'] = $passHash;
        header("Location: principal.php");
    }
    else{
	    echo '<script>alert("Clave incorrecta"); window.location.href="login.html";</script>';
    }
}
else{
    echo '<script>alert("Usuario incorrecto"); window.location.href="login.html";</script>';
}

// Liberando el conjunto de resultados
pg_free_result($result);

// Cerrando la conexión
pg_close($dbconn);

?>
