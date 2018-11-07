
<?php
// Conectando y seleccionado la base de datos
$dbconn = pg_connect("host=localhost dbname=tp2 port=5434 user=postgres password=demo")
or die('No se ha podido conectar: ' . pg_last_error());


//intentando chequear
$usuario = $_POST['nnombre'];
$pass = $_POST['npassword'];
$query = "SELECT * FROM persona where usuario='". $usuario ."'";
$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

if($row = pg_fetch_array($result)){
    if($row['clave'] == $pass){
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['clave'] = $pass;
        header("Location: principal.php");
    }else{
        header("Location: login.html");
        exit();
    }
}else{
    header("Location: login.html");
    exit();
}

// Liberando el conjunto de resultados
pg_free_result($result);

// Cerrando la conexión
pg_close($dbconn);
?>
