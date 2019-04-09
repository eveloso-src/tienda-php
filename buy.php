<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
										
			

			<h2>Comprar producto</h2>
			<hr />

			<?php
			$prod = $_GET['nik'];
	
			$sql = mysqli_query($con, "SELECT * from producto WHERE codigo='$prod'");
			$row = mysqli_fetch_assoc($sql);
			if(isset($_POST['add'])){
				//echo 'compra';
			
			
					if(isset($_POST['nik']) && !empty($_POST['nik'])) // Pregunta si esta seteado la vareable nik (codigo de producto) es diferente de vacio 
					{
						$id = $_POST['nik'];
						//echo 'nik: ' ;
						//include('conexion.php');
					 
						$producto = mysqli_query($con, "SELECT * FROM producto WHERE codigo='$id'");
						$row = mysqli_fetch_assoc($producto);
						
						$resto = $row ['stock'];

						
						if ($resto > 0) 
						{
							
							
							$update = "UPDATE producto SET stock = stock - 1 WHERE codigo = '".$id."'";
						
								
								if (mysqli_query($con, $update))
								{
									echo "Record updated successfully";
										
								} 
								else 
								{
									echo "Error updating record: " . mysqli_error($con);
								}
						}
						else
						{
							echo 'No quedan más en existencia';
						}

						
						
						//die;
					}

			
			
			
			
			}
			
			
			echo '			
			<form class="form-inline" method="post">
			
				<div class="row">
					<div class="col-sm-4">
						<div class="div_photo " ><img src=images/'.$row['foto'].' width="200" height="200" class="img-fluid">
						
						</div>	
					</div>
					<div class="col-sm-6">
						<div class="titulo">'.$row['titulo'].'</div>
						<div class="titulo" style="font-size: 20px;"><b>$ '.$row['precio'].'</b></div>
						<br>
						<div class="titulo"><u>
						Descripción: </u>
						</div><br>
						'.$row['descripcion'].'
					</div>
					<input type="hidden" id="nik" name="nik" value="'.$prod.'"/>
					<div class="col-sm-2">
						<input type="submit" name="add" class="btn btn-sm btn-danger" value="Confirmar compra" 
						onClick="updateId('.$prod.'); submit();">
						<!--data-toggle="modal" data-target="#exampleModal"-->
						<br><br>
						<div style="display: none" id="mensaje" class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Operacion realizada</div>	
			</div>	

				</div>
				
				<div class="row">
					<div class="col-sm-4">
						<br>
					</div>
					<div class="col-sm-6">
						<br>
						<div class="titulo">
							<br>
							<u>Forma de entrega</u>
							<br><br>
							<ul>
							<li>Acuerdo con el vendedor	<br>
							<li>Entrega por correo<br>
							</ul>
						</div>
					</div>

					<div class="col-sm-2">
						<br>
					</div>					
				</div>
				
				
				
			';
			
			?>

						
				
			</form>
		</div>
	</div><center>
	<p>&copy; Sistemas Web <?php echo date("Y");?></p
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	
	
			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" style="text-align: center" id="exampleModalLabel"><b>Confirmación</b></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body" style="background-color: green; color: white; text-align: center" >
					Compra realizada
				  </div>
				  <?php
				  			
				  ?>
				  <div class="modal-footer">
				  
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				  </div>
				</div>
			  </div>
			</div>
						
</body>
</html>
<script>

function updateId(id)
{
	var xmlhttp = new XMLHttpRequest();
    /*xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            
			document.getElementById("mensaje").style.display = "";
			
			setTimeout(function(){
				document.getElementById("mensaje").style.display = 'none';	
			}, 2000)
        }
    };
	*/
	var result = xmlhttp.open("GET", "update.php?nik=" +id, true);
	console.log("result " + result);
	var sent = xmlhttp.send();
	console.log("sent " + sent);
	
}
</script>
