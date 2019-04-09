<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de productos</title

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
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
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include("nav.php");?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Datos del Producto &raquo; Agregar datos</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$codigo		     = mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));//Escanpando caracteres 
				$titulo		     = mysqli_real_escape_string($con,(strip_tags($_POST["titulo"],ENT_QUOTES)));//Escanpando caracteres 
				$descripcion	 = mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));//Escanpando caracteres 
				$foto	 = mysqli_real_escape_string($con,(strip_tags($_POST["foto"],ENT_QUOTES)));//Escanpando caracteres 
				$precio	     = mysqli_real_escape_string($con,(strip_tags($_POST["precio"],ENT_QUOTES)));//Escanpando caracteres 
				$proveedor		 = mysqli_real_escape_string($con,(strip_tags($_POST["proveedor"],ENT_QUOTES)));//Escanpando caracteres 
				$stock		 = mysqli_real_escape_string($con,(strip_tags($_POST["stock"],ENT_QUOTES)));//Escanpando caracteres 
				$estado			 = mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));//Escanpando caracteres 
				
			

				$cek = mysqli_query($con, "SELECT * FROM producto WHERE codigo='$codigo'");
				if(mysqli_num_rows($cek) === 0){
						$insert = mysqli_query($con, "INSERT INTO producto(codigo, titulo, descripcion, foto, precio, proveedor, stock, estado)
															VALUES('$codigo','$titulo', '$descripcion', '$foto', '$precio', '$proveedor', '$stock', '$estado')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
					 
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. código exite!</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Código</label>
					<div class="col-sm-2">
						<input type="text" name="codigo" class="form-control" placeholder="Código" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Titulo</label>
					<div class="col-sm-4">
						<input type="text" name="titulo" class="form-control" placeholder="Titulo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Descripción</label>
					<div class="col-sm-4">
						<input type="text" name="descripcion" class="form-control" placeholder="Descripción" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Foto</label>
					<div class="col-sm-4">
						<input type="file" name="foto" class="form-control" required placeholder="Foto">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Precio</label>
					<div class="col-sm-3">
						<input name="precio" class="form-control" placeholder="Precio">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Proveedor</label>
					<div class="col-sm-3">
						<input type="text" name="proveedor" class="form-control" placeholder="Proveedor" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Stock</label>
					<div class="col-sm-3">
						<input type="text" name="stock" class="form-control" placeholder="Stock" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Estado</label>
					<div class="col-sm-3">
						<select name="estado" class="form-control">
							<option value=""> ----- </option>
                           <option value="A">Activo</option>
							<option value="I">Inactivo</option>
							
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>
