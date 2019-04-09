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
			<h2>Datos del productos &raquo; Editar datos</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			
            $sql = mysqli_query($con, "SELECT * FROM producto WHERE codigo='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
            if(isset($_POST['save'])){
				$codigo		     = mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));//Escanpando caracteres 
				$titulo		     = mysqli_real_escape_string($con,(strip_tags($_POST["titulo"],ENT_QUOTES)));//Escanpando caracteres 
				$descripcion	 = mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));//Escanpando caracteres 
				$foto	 = mysqli_real_escape_string($con,(strip_tags($_POST["foto"],ENT_QUOTES)));//Escanpando caracteres 
				$precio	     = mysqli_real_escape_string($con,(strip_tags($_POST["precio"],ENT_QUOTES)));//Escanpando caracteres 
				$proveedor		 = mysqli_real_escape_string($con,(strip_tags($_POST["proveedor"],ENT_QUOTES)));//Escanpando caracteres 
				$stock		 = mysqli_real_escape_string($con,(strip_tags($_POST["stock"],ENT_QUOTES)));//Escanpando caracteres 
				$estado			 = mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));//Escanpando caracteres  
				
				$update = mysqli_query($con, "UPDATE producto SET titulo='$titulo', descripcion='$descripcion', foto='$foto', precio=$precio, proveedor='$proveedor', stock=$stock, estado='$estado' WHERE codigo='$nik'") or die(mysqli_error());
				if($update){
					header("Location: edit.php?nik=".$nik."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Código</label>
					<div class="col-sm-2">
						<input type="text" name="codigo" value="<?php echo $row ['codigo']; ?>" class="form-control" placeholder="Codigo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Titulo</label>
					<div class="col-sm-4">
						<input type="text" name="titulo" value="<?php echo $row ['titulo']; ?>" class="form-control" placeholder="Titulo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Descripción</label>
					<div class="col-sm-4">
						<input type="text" name="descripcion" value="<?php echo $row ['descripcion']; ?>" class="form-control" placeholder="Descripción" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Foto</label>
					<div class="col-sm-4">
						<input type="text" name="foto" value="<?php echo $row ['foto']; ?>" class="form-control" placeholder="Foto" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Precio</label>
					<div class="col-sm-3">
						<input type="text" name="precio" class="form-control" placeholder="Precio" value="<?php echo $row ['precio']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Proveedor</label>
					<div class="col-sm-3">
						<input type="text" name="proveedor" value="<?php echo $row ['proveedor']; ?>" class="form-control" placeholder="Proveedor" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">stock</label>
					<div class="col-sm-3">
						
						<input type="text" name="stock" value="<?php echo $row ['stock']; ?>" class="form-control" placeholder="Stock" required>
					</div>
                    
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Estado</label>
					<div class="col-sm-3">
						<select name="estado" class="form-control">
							<option value="">- Selecciona estado -</option>
                            <option value="A" <?php if ($row ['estado']=='A'){echo "selected";} ?>>Activo</option>
							<option value="I" <?php if ($row ['estado']=='I'){echo "selected";} ?>>Inactivo</option>
							
						</select> 
					</div>
                   
                </div>
			
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</body>
</html>