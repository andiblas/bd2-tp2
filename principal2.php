<?php
session_start();
$dbconn = pg_connect("host=localhost dbname=tp2 port=5434 user=postgres password=demo")
or die('No se ha podido conectar: ' . pg_last_error());
$query = "SELECT * FROM persona where usuario='". $_SESSION['usuario'] ."'";
$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
$row = pg_fetch_array($result);


$querys = 'SELECT u1.nombre as nombre1, u1.apellido as apellido1, u2.nombre as nombre2, u2.apellido as apellido2
		FROM persona as u1, persona as u2 
		WHERE u1.id != u2.id 
			AND u1.id < u2.id
			AND NOT EXISTS (
				SELECT p3.peliculaid FROM pelis_que_vio as p3 where p3.usuarioid = u1.id OR p3.usuarioid = u2.id
				EXCEPT (
					SELECT p1.peliculaid FROM pelis_que_vio as p1, pelis_que_vio as p2 
						WHERE p1.usuarioid = u1.id AND p2.usuarioid = u2.id 
							AND p1.peliculaid = p2.peliculaid
				)
			) 
			order by u1.id;';

$results = pg_query($querys) or die('La consulta fallo: ' . pg_last_error());
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Login</title></head>
<body>
<div>
    <h1>Bienvenido <?php echo $row['apellido']?>, <?php echo $row['nombre']?> </h1>
<h3>Listado de usuarios que vieron las mismas peliculas</h3>
 <table CELLSPACING="10"><head>
	<style type="text/css" media="all">
table {
border: red 4px solid;
border-collapse: collapse; 
}
th{
border-bottom: 3px solid red;
background-color: #DDD;
} 
 tr:nth-of-type(odd) {
background-color: lightblue;
}

</style>
	</head>
	<tr>
		<th scope="col">&lt </th>
		<th scope="col"> </th>
		<th scope="col">USUARIO 1 </th>
		<th scope="col"> </th>
		<th scope="col">  ;  </th>
		<th scope="col"> </th>
		<th scope="col">USUARIO 2</th>
		<th scope="col"> </th>
		<th scope="col"> &gt</th>
	</tr>
	<tr align="center">
		<th scope="col">&lt </th>
		<th scope="col">APELLIDO</th> 
		<th scope="col">, </th> 
		<th scope="col">NOMBRE</th>
		<th scope="col">  ; </th>
		<th scope="col">APELLIDO</th>
		<th scope="col">, </th>
		<th scope="col">NOMBRE</th>
		<th scope="col"> &gt</th>
	</tr>
  
<?php
	while ($line = pg_fetch_array($results, null, PGSQL_ASSOC)) {
	$nombre1 = $line['nombre1'];
	$nombre2 = $line['nombre2'];
	$apellido1 = $line['apellido1'];
	$apellido2 = $line['apellido2'];
	echo "<tr>";
	echo "<td align=\"center\">&lt </td><td align=\"center\">".$apellido1."</td><td align=\"center\">, </td><td align=\"center\">".$nombre1."</td><td align=\"center\">  ;  </td><td align=\"center\">".$apellido2."</td><td align=\"center\">, </td><td align=\"center\">".$nombre2."</td><td align=\"center\"> &gt</td>";
	echo "</tr>";	
}
?>

</table>
    <form method="POST" action="cambioClave.html">
        <div>
            <br />
            <button type="submit">Cambiar contraseña</button>
        </div>
    </form>
</div>
</body>
</html>
