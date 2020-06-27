

<?php 
session_start();

if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2 )
{
  header("location: ../");
}

include "../conexion.php";
if(!empty($_POST)){
    $alert='';
    if (empty ($_POST['proveedor']) || empty ($_POST['contacto']) || empty ($_POST['direccion']) ||  empty ($_POST['telefono']))  {

        $alert='<p class="msg_error"> Todos los campos son obligatorios.</p>';
        # code...
    }else {
        
        $proveedor          =$_POST['proveedor'];
        $contacto      =$_POST['contacto'];
        $telefono     =$_POST['telefono'];
        $direccion    =$_POST['direccion'];
        //$clave      =  md5($_POST['clave']);
        $usuario_id  =$_SESSION['iduser'];

        
            $query_insert = mysqli_query($conection, "INSERT INTO proveedor(proveedor, contacto, telefono, direccion, usuario_id)

            VALUES('$proveedor','$contacto', '$telefono', '$direccion', '$usuario_id')");

            if ($query_insert ) {
                $alert='<p class="msg_save">Proveedor guardado Correctamente.</p>';
                   # code...
               }else{
                $alert='<p class="msg_error">Error al guardar proveedor.</p>';
               }
        
    }mysqli_close($conection);

}
?>
<!doctype html>
<html lang="en">
    <link rel="stylesheet" href="css/style1.css">
  <head>
    <?php include "includes/scripts.php" ?>
    <title>Registro Proveedor</title>
  </head>
  <body>

  <?php include "includes/header.php" ?>

<section id="container">

<div class="container">
<div class="form_refister">
     
    <h1>Registro Proveedor</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
    <form action="" method="post">
  
    <div class="form-group row">
    <label for="proveedor" class="col-sm-2 col-form-label">Proveedor </label>
    <div class="col-sm-10">
      <input type="text" name="proveedor" class="form-control" id="proveedor" placeholder="Nombre del Proveedor ">
    </div>
  </div>
  <div class="form-group row">
    <label for="contacto" class="col-sm-2 col-form-label">Contacto </label>
    <div class="col-sm-10">
      <input type="text" name="contacto" class="form-control" id="contacto" placeholder="Nombre completo del contacto ">
    </div>
  </div>
  <div class="form-group row">
    <label for="telefono" class="col-sm-2 col-form-label">Telefono </label>
    <div class="col-sm-10">
      <input type="number" name="telefono" class="form-control" id="telefono" placeholder="Telefono ">
    </div>
  </div>
  <div class="form-group row">
    <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
    <div class="col-sm-10">
      <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Direccion ">
    </div>
  </div>

  <div>
    <div class="form-group row">
      <input type="submit" value="Guardar Proveedor" name="clave" class="form-control  bg-primary text-white" id="guardar" placeholder=" ">
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