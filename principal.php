
<?php

session_start();
$dbconn = pg_connect("host=localhost dbname=tp2 port=5434 user=postgres password=demo")
or die('No se ha podido conectar: ' . pg_last_error());
$query = "SELECT * FROM persona where usuario='". $_SESSION['usuario'] ."'";
$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
$row = pg_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Login</title></head>
<body>
<div>
    <label>Bienvenido <?php echo $row['apellido']?>, <?php echo $row['nombre']?> </label>
    <form method="POST" action="cambioClave.html">
        <div>
            <br />
            <button type="submit">Cambiar contraseña</button>
        </div>
    </form>
</div>
</body>
</html>