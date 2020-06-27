
<?php

session_start();
if($_SESSION['rol'] != 1)
{
  header("location: ../");
}

	
	include "../conexion.php";
	if(!empty($_POST))
	{
		if($_POST['idusuario'] == 1){
			header("location: lista_usuarios.php");
			mysqli_close($conection);
			exit;
		}
		$idusuario = $_POST['idusuario'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE usuario SET estatus = 0 WHERE idusuario = $idusuario ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_usuarios.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		header("location: lista_usuarios.php");
		mysqli_close($conection);
	}else{

		$idusuario = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT u.nombre,u.usuario,r.rol
												FROM usuario u
												INNER JOIN
												rol r
												ON u.rol = r.idrol
												WHERE u.idusuario = $idusuario ");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$nombre = $data['nombre'];
				$usuario = $data['usuario'];
				$rol     = $data['rol'];
			}
		}else{
			header("location: lista_usuarios.php");
		}


	}




?>


<!doctype html>
<html lang="en">
<link rel="stylesheet" href="css/style1.css">
  <head>
    <?php include "includes/scripts.php" ?>
    <title>Eliminar usuario</title>
  </head>
  <body>

  <?php include "includes/header.php" ?>
<div class="container">
<h1>Eliminar usuario</h1>
<div class="data_delete">
    <h2>¿Esta seguro que desea eliminar el registro?</h2>
    <p>Nombre: <span><?php echo $nombre; ?></span> </p>
    <p>Usuario: <span><?php echo $usuario; ?></span> </p>
    <p>Tipo Usuario: <span><?php echo $rol; ?></span> </p>

    <form method="post" action="">
        <div class="row">
            <div class="col">
            
           <!--<input type="submit" href="lista_usuarios.php" class="form-control btn_cancel" placeholder="First name" value="Cancelar">
            <a href="lista_usuarios.php" class="btn_cancel form-control">Cancelar</a>
            </div>
            <div class="col">
            <input type="submit" class="form-control btn_ok" placeholder="Last name" value="Aceptar" >-->
            <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
				<a href="lista_usuarios.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
            
            </div>
        </div> 
   </form>
</div>
</div>

 
  <?php include "includes/footer.php" ?>
   </body>
</html>