<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de productos</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
	
		.mensaje_error {
			font-color: red;
			
		}
		.content {
			margin-top: 80px;
		}
	</style>
	
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	 
			
           
	<div class="container">
			
		<div class="content">
			<div class="col-sm-6">
			
				<h2>Login</h2>
				<hr />
				
				<form class="form-horizontal" action="" method="post">
					<div class="form-group">
						<label class="col-sm-3 control-label">Usuario</label>
						<div class="col-sm-6">
							<input type="text" name="nombre"  class="form-control" placeholder="Nombre usuario" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Contraseña</label>
						<div class="col-sm-6">
							<input type="password" name="clave"  class="form-control" placeholder="Contraseña" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">&nbsp;</label>
						<div class="col-sm-6">
							<input type="submit" name="login" class="btn btn-sm btn-primary" value="Ingresar">
							
							
						</div>
					</div>
					<?php
						if(isset($_POST['login'])){
	
						$usr = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
						$key = mysqli_real_escape_string($con,(strip_tags($_POST["clave"],ENT_QUOTES)));

						$sql = mysqli_query($con, "SELECT * FROM usuario WHERE nombre='$usr'");
						
						if(mysqli_num_rows($sql) == 0){
							echo '<div class="alert alert-danger"><strong>Usuario incorrecto</strong></div>';	
							
						}else{
						
							//$clave = mysqli_query($con, "SELECT * FROM usuario WHERE nombre='$usr'");
							$rowUser = mysqli_fetch_assoc($sql);
							
						
							$decoded = utf8_decode(base64_decode($rowUser ['clave'] ));
			
						
							if (strcmp($decoded, $key)===0 ){
								$_SESSION["user"] = $rowUser ['nombre'];
								$_SESSION["rol"] = $rowUser ['rol'];
								header("Location: index.php");
							}
							else {
				
								echo '<div class="alert alert-danger"><strong>Contraseña incorrecta</strong></div>';	
							}
						}	
					} 	
				
					?>

				</form>
			</div>
			<div class="col-sm-6">
			
				<h2>Crear usuario</h2>
				<hr />
				<form class="form-horizontal" action="" method="post">
					<div class="form-group">
						<label class="col-sm-3 control-label">Nuevo Usuario</label>
						<div class="col-sm-6">
							<input type="text" name="nombre"  class="form-control" placeholder="Nombre usuario" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"> Contraseña</label>
						<div class="col-sm-6">
							<input type="password" name="clave"  class="form-control" placeholder="Contraseña" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">&nbsp;</label>
						<div class="col-sm-6">
							<input type="submit" name="signup" class="btn btn-sm btn-secondary" value="Nuevo">
						</div>
					</div>
					<?php
						
						if(isset($_POST['signup'])){
							$usr = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
							$key = mysqli_real_escape_string($con,(strip_tags($_POST["clave"],ENT_QUOTES)));

							
							$encoded = base64_encode(utf8_encode($key));

							$sql = mysqli_query($con, "SELECT * from usuario WHERE nombre='$usr'");
							if(mysqli_num_rows($sql) == 0){
							
				
							$insert = mysqli_query($con, "INSERT INTO usuario VALUES('$usr','$encoded', 'U')") or die(mysqli_error());
							if($insert){
								
									
									echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
								}else{
									echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
								}		
							}
							else {
								echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. Usuario ya existente!</div>';
								
							}
						}
						?>
				</form>
			</div>
				
	   </div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</body>
</html>