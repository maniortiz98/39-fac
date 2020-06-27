

<?php 
session_start();
if($_SESSION['rol'] != 1)
{
  header("location: ../");
}
include "../conexion.php";
if(!empty($_POST)){
    $alert='';
    if (empty ($_POST['nombre']) || empty ($_POST['correo']) || empty ($_POST['usuario']) || empty ($_POST['clave'])  || empty ($_POST['rol'])) {

        $alert='<p class="msg_error"> Todos los campos son obligatorios.</p>';
        # code...
    }else {
        

        $nombre = $_POST['nombre'];
        $email =  $_POST['correo'];
        $user =   $_POST['usuario'];
        $clave =  md5($_POST['clave']);
        $rol =    $_POST['rol'];
    
       
        $query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email'");
        
        $result = mysqli_fetch_array($query);

        if ($result > 0){
            $alert='<p class="msg_error">El correo o usuario ya existe.</p>';
        }else{
            $query_insert = mysqli_query($conection, "INSERT INTO usuario(nombre, correo, usuario, clave, rol)

                                                               VALUES('$nombre', '$email', '$user', '$clave', '$rol')");

                                                               if ($query_insert ) {
                                                                $alert='<p class="msg_save">Usuario creado Correctamente.</p>';
                                                                   # code...
                                                               }else{
                                                                $alert='<p class="msg_error">Error al crear el usuario.</p>';
                                                               }
        }
    }
}




?>





<!doctype html>
<html lang="en">
    <link rel="stylesheet" href="css/style1.css">
  <head>
    <?php include "includes/scripts.php" ?>
    <title>Registro Usuario</title>
  </head>
  <body>

  <?php include "includes/header.php" ?>

<section id="container">

<div class="container">
<div class="form_refister">
     
    <h1>Registro Usuario</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
    <form action="" method="post">
  
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre  </label>
    <div class="col-sm-10">
      <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre ">
    </div>
  </div>
  <div class="form-group row">
    <label for="correo" class="col-sm-2 col-form-label">Correo Electrónico  </label>
    <div class="col-sm-10">
      <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo Electrónico ">
    </div>
  </div>
  <div class="form-group row">
    <label for="usuario" class="col-sm-2 col-form-label">Usuario </label>
    <div class="col-sm-10">
      <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario ">
    </div>
  </div>
  <div class="form-group row">
    <label for="clave" class="col-sm-2 col-form-label">Contraseña</label>
    <div class="col-sm-10">
      <input type="password" name="clave" class="form-control" id="Clave" placeholder="Contraseña ">
    </div>
  </div>


  <?php 
                                                                                        $query_rol = mysqli_query($conection, "SELECT * FROM rol");
                                                                                        mysqli_close($conection);
                                                                                        $result_rol = mysqli_num_rows($query_rol);
                                                                                        ?>


  <div class="form-group ">

                                                                                        
    <label for="rol" class="col-sm-2 col-form-label">Tipo de Usuario</label>
                                                                                        
    <select class="col-sm-2 col-form-label" name="rol" id="rol">
                                                                                        <?php 
                                                                                        
                                                                                        if ($result_rol > 0){
                                                                                            while($rol = mysqli_fetch_array($query_rol)){
                                                                                                ?>
                                                                                                <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?></option>
                                                                                                
                                                                                                <?php 
                                                                                        }
                                                                                    }
                                                                                        ?>
        <hr>
       
    </select>
    <br><br>
    
  </div>
  <div>
    <div class="form-group row">
      <input type="submit" value="Crear usuario" name="clave" class="form-control  bg-primary text-white" id="Clave" placeholder="Contraseña ">
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