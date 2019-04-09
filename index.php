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
	<link href="css/style_nav.css" rel="stylesheet">

	<style>

    .titulo {
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 18px;
    }
	.div_photo {
		width: 100px;
		height: 100px;
		background-color: gray;
	}
		.content {
			margin-top: 80px;
		}
	</style>

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include('nav.php');?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Lista de productos</h2>
			<hr />

			<?php
			if(isset($_GET['aksi']) == 'delete'){
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES))); //Codigo de producto
				$cek = mysqli_query($con, "SELECT * from producto WHERE codigo='$nik'"); //Retorno de la consulta de producto
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($con, "DELETE from producto WHERE codigo='$nik'");
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>

			<form class="form-inline" method="get">
				<div class="form-group">
				
					<select name="filter" class="form-control" onchange="form.submit()">  <!--form.submit= invoca el metodo que envia el formulario  -->
						<?php $filter = (isset($_GET['filter']) ? ($_GET['filter']) : NULL);  
						
							if (strcmp($_SESSION["rol"] , 'U')===0 ) {
								$filter = (isset($_GET['filter']) ? ($_GET['filter']) : 'A');  
							}
						?> <!-- pregunta si fue seteada en un metofo GET ":" = else-->
						
						<option value="0"<?php if($filter == '0'){ echo 'selected'; } ?>>Filtros de datos de productos</option> <!-- escribe "selected" --> 
						<option value="A" <?php if($filter == 'A'){ echo 'selected'; } ?>>Activo</option>
						<option value="I" <?php if($filter == 'I'){ echo 'selected'; } ?>>Inactivo</option>
						<option value="" <?php if($filter == ''){ echo 'selected'; } ?>>Todos</option>
                        
					</select>
					
				</div>
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th>No</th>
					<th>Código</th>
					<th>Descripcion</th>
                    
                    <th>Proveedor</th>
					<th>Stock</th>
					<th>Estado</th>
                    <th>Acciones</th>
				</tr>
				<?php
				if($filter){
					$sql = mysqli_query($con, "SELECT * from producto WHERE estado='$filter' ORDER BY codigo ASC"); //selecciona el producto ordenado de forma ascendente
				}else{
					$sql = mysqli_query($con, "SELECT * FROM producto ORDER BY codigo ASC"); //Los ordena sin estar filtrado
				}
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){ //pregunta si existen rwo y asocia toda la variable $row para consultarla por campo 
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['codigo'].'</td> <!-- valor a imprimir -->
							<td>
							<div class="row">
								<div class="col-sm-4">
									<div class="div_photo " ><img src=images/'.$row['foto'].' width="100" height="100"> <!-- concatena nombre de foto a la ruta -->
									
									</div>	
								</div>
								<div class="col-sm-8">
								    <div class="titulo">'.$row['titulo'].'</div>  <!-- Toma el titulo de la base -->
									<div class="titulo" style="font-size: 20px;"><b>$ '.$row['precio'].'</b></div>
                                    <br>
									'.$row['descripcion'].' <!--codigo php incrustado -->
								</div>

							</div>
							
							
							</td>
                            
                            <td>'.$row['proveedor'].'</td>
							<td>'.$row['stock'].'</td>
                    		<td>';
							if($row['estado'] == 'A'){
								echo '<span class="label label-success">Activo</span>'; //otorga clase diferentes al span (color)
							}
                            else if ($row['estado'] != 'A' ){
								echo '<span class="label label-info">Inactivo</span>';
							}

					
						if (strcmp($_SESSION["rol"] , 'A')===0 ){ //compara el primer argumento con el segundo si son iguales es = a 0
												                  //$_Session["rol"] pregunta si el rol del usuario es administrador o cliente
							echo '
								</td>
								<td>
								
								
									<a href="edit.php?nik='.$row['codigo'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true">
									
									</span></a>
									
									<a href="index.php?aksi=delete&nik='.$row['codigo'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['descripcion'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>  
								</td>
							</tr>
							';
							
						}
							else {
						
							
							echo '
								</td>
								<td> ';
								
								if($row['estado'] != 'I') { // Si es distinto de "I"nactivo va a la opcion comprar
							
									echo '
							
								
									<a href="buy.php?nik='.$row['codigo'].'" title="Comprar" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true">
									
									</span></a>';
								
								}
								echo '
								</td>
							</tr> 
							'; 
							
						}
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div><center>
	<p>&copy; Sistemas Web <?php echo date("Y");?></p> <!--Signo de copyright -->
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
