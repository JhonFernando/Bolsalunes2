<?php



$mysqli = new MySQLi("localhost", "root","aaaaaaaa", "u925523509_bolsa");
		if ($mysqli -> connect_errno) {
			die( "Fallo la conexión a MySQL: (" . $mysqli -> mysqli_connect_errno() 
				. ") " . $mysqli -> mysqli_connect_error());
		}
		else

// Si todo va bien en $pdo tendremos el objeto que gestionará la conexión con la base de datos.
// mysql_connect("localhost","root","aaaaaaaa");
//mysql_select_db("u925523509_bolsa");
?>