	<?php
	if ($_SESSION["user"] == null) {
		header("Location: login.php");
	}
	
	?>
	
	<div class="container">
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav ">
					<li class=""><a href="index.php">Lista de productos</a></li>
					
            <?php
					if (strcmp($_SESSION["rol"] , 'A')===0 ){
						
				?>	
					<li><a href="add.php">Agregar producto</a></li>
					<?php
					}
					?>
                    <li ><a href="login.php">Salir</a></li>
				</ul>
			</div><!--/.nav-collapse -->
	</div>