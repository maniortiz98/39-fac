

<?php 
session_start();

include "../conexion.php";
if(!empty($_POST)){
    $alert='';
    if (empty ($_POST['nombre']) || empty ($_POST['telefono']) || empty ($_POST['direccion']))  {

        $alert='<p class="msg_error"> Todos los campos son obligatorios.</p>';
        # code...
    }else {
        
        $nit          =$_POST['nit'];
        $nombre       =$_POST['nombre'];
        $telefono     =$_POST['telefono'];
        $direccion    =$_POST['direccion'];
        //$clave      =  md5($_POST['clave']);
        $usuario_id  =$_SESSION['iduser'];

        $result = 0;
        if(is_numeric($nit) and $nit != 0){
            
            $query = mysqli_query($conection, "SELECT * FROM cliente WHERE nit = '$nit'");
            $result= mysqli_fetch_array($query);
        }
        if($result > 0 ){
            $alert='<p class="msg_error">El Nit ya existe.</p>';
        }else{
            $query_insert = mysqli_query($conection, "INSERT INTO cliente(nit, nombre, telefono, direccion, usuario_id)

            VALUES('$nit','$nombre', '$telefono', '$direccion', '$usuario_id')");

            if ($query_insert ) {
                $alert='<p class="msg_save">Cliente guardado Correctamente.</p>';
                   # code...
               }else{
                $alert='<p class="msg_error">Error al guardar cliente.</p>';
               }
        } 
    }mysqli_close($conection);
}
?>
<!doctype html>
<html lang="en">
    <link rel="stylesheet" href="css/style1.css">
  <head>
    <?php include "includes/scripts.php" ?>
    <title>Registro Cliente</title>
  </head>
  <body>

  <?php include "includes/header.php" ?>

<section id="container">

<div class="container">
<div class="form_refister">
     
    <h1>Registro Cliente</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
    <form action="" method="post">
  
    <div class="form-group row">
    <label for="nit" class="col-sm-2 col-form-label">Nit  </label>
    <div class="col-sm-10">
      <input type="number" name="nit" class="form-control" id="nit" placeholder="Numero de Nit ">
    </div>
  </div>
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre  </label>
    <div class="col-sm-10">
      <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre ">
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
      <input type="submit" value="Guardar Cliente" name="clave" class="form-control  bg-primary text-white" id="guardar" placeholder=" ">
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