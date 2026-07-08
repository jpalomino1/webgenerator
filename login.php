<?php 
	$con= mysqli_connect("wefwf","wefwf","wefwf","1few2");
	$msj="";
	session_start();
	if(isset($_GET['usuario']) && isset($_GET['password'])){
		$usuario=trim($_GET['usuario']);
		$password=trim($_GET['password']);
		$sql= "SELECT * FROM usuarios WHERE email = '$usuario' AND password = '$password' ";
		$res= mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0){
			$fila = mysqli_fetch_row($res);
      		$_SESSION['id_usuario'] = $fila[0]; 
    		$_SESSION['usuario'] = $fila[1];
			header("Location:panel.php");
		}else{
			$msj= "Usuario o Contraseña incorrectos";
		}
	}	
	else{
		echo "";
	}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>webgenerator Juana Palomino</title>
</head>
<body>
	
	<h1>webgenerator Juana Palomino</h1>
	<form action="login.php" method="GET">
		ingresa mail
		<input type="text" name="usuario" placeholder="Ingresar mail"><br>
		ingresa contraseña
		<input type="password" name="password"><br>
		<input type="submit" value="ingresar"><br>
		<a href="./register.php">no tienes cuenta?</a>
	</form>
	<?php 
		if(isset($msj)){
			echo $msj;
		}
	 ?>
</body>
</html>