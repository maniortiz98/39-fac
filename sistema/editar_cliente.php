

<?php 

session_start();
if($_SESSION['rol'] != 1)
{
  header("location: ../");
}
include "../conexion.php";
if(!empty($_POST)){
    $alert='';
    if (empty ($_POST['nombre']) || empty ($_POST['telefono']) || empty ($_POST['direccion'])) {

        $alert='<p class="msg_error"> Todos los campos son obligatorios.</p>';
        # code...
    }else {
        
        $idcliente  = $_POST['id'];
        $nit        = $_POST['nit'];
        $nombre     = $_POST['nombre'];
        $telefono   = $_POST['telefono'];
        $direccion  = $_POST['direccion'];
        
    $result = 0;
    if(is_numeric($nit) and $nit != 0){
        $query = mysqli_query($conection, "SELECT * FROM cliente 
                                                WHERE (nit = '$nit' AND idcliente != '$idcliente')");
        $result = mysqli_fetch_array($query);
        //$result = count($result);
    }

        if ($result > 0){
            $alert='<p class="msg_error">El Nit ya existe.</p>';
        }else{

            if($nit == '')
            {
                $nit = 0;
            }

            $sql_update = mysqli_query($conection,"UPDATE cliente
															SET nit = '$nit', nombre='$nombre',telefono='$telefono',direccion='$direccion'
															WHERE idcliente= $idcliente ");

          
                                                               if ( $sql_update ) {
                                                                $alert='<p class="msg_save">Cliente actualizado correctamente.</p>';
                                                                   # code...
                                                               }else{
                                                                $alert='<p class="msg_error">Error al actualizar el cliente.</p>';
                    
                                                            } 
                                                        }
                                                        }                                                  
        
    }


//mostrar datos 
if(empty ($_REQUEST['id'])){
    header('Location:  lista_clientes.php');
    mysqli_close($conection);
}
$idcliente = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT * FROM cliente WHERE idcliente= $idcliente");
mysqli_close($conection);

$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
    header('Location: lista_clientes.php');
}else{
    while($data  = mysqli_fetch_array($sql)){
        $idcliente  = $data['idcliente'];
        $nit = $data['nit'];
        $nombre  = $data['nombre'];
        $telefono = $data['telefono'];
        $direccion   = $data['direccion'];
    }
}


?>





<!doctype html>
<html lang="en">
    <link rel="stylesheet" href="css/style1.css">
  <head>
    <?php include "includes/scripts.php" ?>
    <title>Actualizar cliente</title>
  </head>
  <body>

  <?php include "includes/header.php" ?>

<section id="container">

<div class="container">
<div class="form_refister">
     
    <h1>Actualizar cliente</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
    <form action="" method="post">
    <input type="hidden" name="id" id="" value="<?php echo $idcliente; ?>">
    <div class="form-group row">
    
    <label for="nit" class="col-sm-2 col-form-label">Nit  </label>
    <div class="col-sm-10">
      <input type="number" name="nit" class="form-control" id="nit" placeholder="Numero de Nit " value="<?php echo $nit; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre  </label>
    <div class="col-sm-10">
      <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre " value="<?php echo $nombre; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="telefono" class="col-sm-2 col-form-label">Telefono </label>
    <div class="col-sm-10">
      <input type="number" name="telefono" class="form-control" id="telefono" placeholder="Telefono " value="<?php echo $telefono; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
    <div class="col-sm-10">
      <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Direccion " value="<?php echo $direccion; ?>">
    </div>
  </div>

  <div>
    <div class="form-group row">
      <input type="submit" value="Actualizar Cliente" name="clave" class="form-control  bg-primary text-white" id="guardar" placeholder=" ">
    </div>
    </div>
  </div>
</form>

</div>
</div>

</section>

 
  <?php include "includes/footer.php" ?>
   </body>
</html>