<?php
	$con= mysqli_connect("localhost","adm_webgenerator","webgenerator2024","webgenerator");
	session_start(); 
	if(!isset($_SESSION['id_usuario'])){
    	header("Location: login.php");
	}
	if(isset($_GET['descargar'])){
		$dominio = $_GET['descargar'];
		shell_exec("zip -r $dominio.zip $dominio");
		header("Location: $dominio.zip");
	}
	if(isset($_GET['eliminar'])){
			$dominio = $_GET['eliminar'];
			shell_exec("rm -rf $dominio");
			mysqli_query($con,"DELETE FROM webs WHERE dominio='$dominio'");
			header("Location: panel.php");
	}
	$id_actual = $_SESSION['id_usuario'];
	if(isset($_GET['nombreWeb'])){
		$nom=trim($_GET['nombreWeb']);
		$dominio=$id_actual.$nom;
		$dominio=trim($dominio);
		$sql_buscar = "SELECT * FROM webs WHERE dominio = '$dominio'";
		$res_buscar = mysqli_query($con, $sql_buscar);
		if (mysqli_num_rows($res_buscar) > 0) {
			$msj = "ya existe ese dominio";
		}
		else{
			$sql="INSERT INTO webs (idUsuario, dominio) VALUES ('$id_actual', '$dominio')";
			$res= mysqli_query($con,$sql);
			if($res){
				shell_exec("./wix.sh $dominio");
			}
			else{
				$msj="no se pudo ingresar tu dominio";
			}
		}
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h1>bienvenide a tu panel</h1>
	<?php 
	echo "<a href='logout.php'>cerrar sesion de $id_actual</a>";
	?>
	<form action="./panel.php">
		generar web de:
		<input type="text" name="nombreWeb"><br>
		<input type="submit" value="crear web">
	</form>
	<?php 
		echo "mis paginas";
		echo "<ul>";

	echo "<ul>";

	if($_SESSION['usuario'] == 'admin@server.com'){
    		$sql = "SELECT * FROM webs";
		}
		else{
		    $sql = "SELECT * FROM webs WHERE idUsuario='$id_actual'";
		}
		$res = mysqli_query($con,$sql);
		if(mysqli_num_rows($res) > 0){
    		while($web = mysqli_fetch_array($res, MYSQLI_ASSOC)){
        		$url_dominio = $web['dominio'];
        		echo "<a href='./$url_dominio/index.php'>$url_dominio</a> ";
    		    echo "<a href='panel.php?descargar=$url_dominio'>descargar web</a> ";
    		    echo "<a href='panel.php?eliminar=$url_dominio'>eliminar</a>";
    		    echo "<br>";
    		}
		}
		else{
    		echo "no creaste ninguna pag web todavia";
		}
		echo "</ul>";
	 ?>
</body>
</html>
