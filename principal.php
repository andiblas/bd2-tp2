
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
    <center>
        <form method="POST" action="actualizador.php">
            <div>
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $row['nombre']?>"/>
                <br />
            </div>
            <div>
                <label>Apellido:</label>
                <input type="text" name="apellido" value="<?php echo $row['apellido']?>"/>
                <br />
            </div>
            <div>
                <label>Usuario:</label>
                <input type="text" name="nnombre" value="<?php echo $row['usuario']?>" readonly/>
                <br />
            </div>
            <div>
                <label>Clave:</label>
                <input type="text" name="npassword" value="<?php echo $row['clave']?>"/>
                <br />
            </div>
            <button type="submit">Actualizar y Salir</button>
        </form>
    </center>
</div>
</body>
</html>