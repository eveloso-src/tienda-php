<?php 

if(isset($_GET['nik']) && !empty($_GET['nik'])) // Pregunta si esta seteado la vareable nik (codigo de producto) es diferente de vacio 
{
    $id = $_GET['nik'];
    //include('conexion.php');
 
 	$producto = mysqli_query($con, "SELECT * FROM producto WHERE codigo='$id'");
	$row = mysqli_fetch_assoc($producto);
	
	$resto = $row ['stock'];

	
	if ($resto > 0) 
	{
		
		
		$update = "UPDATE producto SET stock = stock - 1 WHERE codigo = '".$id."'";
	}
	else
	{
		echo 'No quedan más en existencia';
	}

    if (mysqli_query($con, $update))
    {
        echo "Record updated successfully";
    } 
    else 
    {
        echo "Error updating record: " . mysqli_error($con);
    }
    //die;
}
?>