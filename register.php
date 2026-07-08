<?php 
	$con= mysqli_connect("mattpefeom.ar","1efef","verger","1grewgew");
	$msj="";
	if(isset($_GET['usuario']) && isset($_GET['password1']) && isset($_GET['password2'])){
		$usuario=trim($_GET['usuario']);
		$passwordUno=trim($_GET['password1']);
		$passwordDos=trim($_GET['password2']);
		if($passwordUno==$passwordDos){
			$sql_buscar = "SELECT * FROM usuarios WHERE email = '$usuario'";
			$res_buscar = mysqli_query($con, $sql_buscar);
			if (mysqli_num_rows($res_buscar) > 0) {
				$msj = "ell email ya se encuentra registrado";
			}
			else{
				$sql="INSERT INTO usuarios (email, password) VALUES ('$usuario', '$passwordUno')";
				$res= mysqli_query($con,$sql);
				if($res){
					header("Location:login.php");
				}
				else{
					$msj="datos incorrectos";
				}
			}
		}
		else{
			$msj="las contrasenas no coinciden";
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
 	<title>registrate</title>
 </head>
 <body>
 	<h1>Registrarse es simple</h1>
 	<form action="register.php">
		ingresa mail
		<input type="text" name="usuario" placeholder="Ingresar mail"><br>
		ingresa contraseña
		<input type="password" name="password1"><br>
		repetir contraseña
		<input type="password" name="password2"> <br>
		<input type="submit" value="registrarse"><br>
		<a href="./login.php">iniciar sesion</a>
	</form>
	<?php 
		if(isset($msj)){
			echo $msj;
		}
	 ?>
 </body>
 </html>