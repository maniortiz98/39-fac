


<?php 

session_start();
if($_SESSION['rol'] != 1)
{
  header("location: ../");
}
include "../conexion.php";
if(!empty($_POST)){
    $alert='';
    if (empty ($_POST['proveedor']) || empty ($_POST['contacto']) || empty ($_POST['telefono']) || empty ($_POST['direccion']) ) {

        $alert='<p class="msg_error"> Todos los campos son obligatorios.</p>';
        # code...
    }else {
        
        $idproveedor  = $_POST['id'];
        $proveedor        = $_POST['proveedor'];
        $contacto     = $_POST['contacto'];
        $telefono   = $_POST['telefono'];
        $direccion  = $_POST['direccion'];
        

            $sql_update = mysqli_query($conection,"UPDATE proveedor
															SET proveedor = '$proveedor', contacto='$contacto',telefono='$telefono',direccion='$direccion'
															WHERE codproveedor= $idproveedor ");

          
                                                               if ( $sql_update ) {
                                                                $alert='<p class="msg_save">Cliente actualizado correctamente.</p>';
                                                                   # code...
                                                               }else{
                                                                $alert='<p class="msg_error">Error al actualizar el cliente.</p>';
                    
                                                            } 
                                                        }
                                                                                                          
        
    }


//mostrar datos 
if(empty ($_REQUEST['id'])){
    header('Location:  lista_proveedor.php');
    mysqli_close($conection);
}
$idproveedor = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT * FROM proveedor WHERE codproveedor= $idproveedor and estatus = 1");
mysqli_close($conection);

$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
    header('Location: lista_proveedor.php');
}else{
    while($data  = mysqli_fetch_array($sql)){
        $idproveedor  = $data['codproveedor'];
        $proveedor = $data['proveedor'];
        $contacto  = $data['contacto'];
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
    <title>Actualizar proveedor</title>
  </head>
  <body>

  <?php include "includes/header.php" ?>

<section id="container">

<div class="container">
<div class="form_refister">
     
    <h1>Actualizar proveedor</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
    <form action="" method="post">
  <input type="hidden" name="id" id="" value="<?php echo $idproveedor ; ?>">
    <div class="form-group row">
    <label for="proveedor" class="col-sm-2 col-form-label">Proveedor </label>
    <div class="col-sm-10">
      <input type="text" name="proveedor" class="form-control" id="proveedor" placeholder="Nombre del Proveedor " value="<?php echo $proveedor ; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="contacto" class="col-sm-2 col-form-label">Contacto </label>
    <div class="col-sm-10">
      <input type="text" name="contacto" class="form-control" id="contacto" placeholder="Nombre completo del contacto " value="<?php echo $contacto ; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="telefono" class="col-sm-2 col-form-label">Telefono </label>
    <div class="col-sm-10">
      <input type="number" name="telefono" class="form-control" id="telefono" placeholder="Telefono " value="<?php echo $telefono ; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
    <div class="col-sm-10">
      <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Direccion " value="<?php echo $direccion ; ?>">
    </div>
  </div>

  <div>
    <div class="form-group row">
      <input type="submit" value="Actualizar Proveedor" name="clave" class="form-control  bg-primary text-white" id="guardar" placeholder=" ">
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