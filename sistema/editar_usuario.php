

<?php 

session_start();
if($_SESSION['rol'] != 1)
{
  header("location: ../");
}
include "../conexion.php";
if(!empty($_POST)){
    $alert='';
    if (empty ($_POST['nombre']) || empty ($_POST['correo']) || empty ($_POST['usuario'])  || empty ($_POST['rol'])) {

        $alert='<p class="msg_error"> Todos los campos son obligatorios.</p>';
        # code...
    }else {
        
        $idusuario = $_POST['id'];
        $nombre    =   $_POST['nombre'];
        $email     =  $_POST['correo'];
        $user =   $_POST['usuario'];
        $clave =  md5($_POST['clave']);
        $rol =    $_POST['rol'];
    
        
       
        $query = mysqli_query($conection, "SELECT * FROM usuario 
                                            WHERE (usuario = '$user' AND idusuario != $idusuario)
                                            OR (correo = '$email' AND idusuario != $idusuario) ");
        $result = mysqli_fetch_array($query);
        //$result = count($result);

        if ($result > 0){
            $alert='<p class="msg_error">El correo o usuario ya existe.</p>';
        }else{

          if(empty($_POST['clave'])){

            $sql_update = mysqli_query($conection,"UPDATE usuario
															SET nombre = '$nombre', correo='$email',usuario='$user',rol='$rol'
															WHERE idusuario= $idusuario ");

          }else{
            $sql_update = mysqli_query($conection,"UPDATE usuario
                                SET nombre = '$nombre', correo='$email',usuario='$user',clave='$clave', rol='$rol'
                                WHERE idusuario= $idusuario ");
  
          }


            

                                                               if ( $sql_update ) {
                                                                $alert='<p class="msg_save">Usuario actualizado correctamente.</p>';
                                                                   # code...
                                                               }else{
                                                                $alert='<p class="msg_error">Error al actualizar el usuario.</p>';
                                                               }
        }
    }
}

//mostrar datos 
if(empty ($_REQUEST['id'])){
    header('Location: lista_usuarios.php');
    mysqli_close($conection);
}
$iduser = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT u.idusuario, u.nombre,u.correo,u.usuario, (u.rol) as idrol, (r.rol) as rol
FROM usuario u
INNER JOIN rol r
on u.rol = r.idrol
WHERE idusuario= $iduser and estatus = 1");
mysqli_close($conection);

$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
    header('Location: lista_usuarios.php');
}else{
    $option = '';
    while($data  = mysqli_fetch_array($sql)){
        $iduser  = $data['idusuario'];
        $nombre  = $data['nombre'];
        $correo  = $data['correo'];
        $usuario = $data['usuario'];
        $idrol   = $data['idrol'];
        $rol     = $data['rol'];

        if($idrol == 1){
            $option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
        }elseif ( $idrol == 2 ){
            $option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
        }elseif( $idrol == 3){
            $option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
        }
    }
}


?>





<!doctype html>
<html lang="en">
    <link rel="stylesheet" href="css/style1.css">
  <head>
    <?php include "includes/scripts.php" ?>
    <title>Editar Usuario</title>
  </head>
  <body>

  <?php include "includes/header.php" ?>

<section id="container">

<div class="container">
<div class="form_refister">
     
    <h1>Actualizar Usuario</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
    <form action="" method="post">
  


    <div class="form-group row">
    
    <div class="col-sm-10">
      <input type="hidden" name="id" class="form-control"  placeholder="Nombre " value="<?php echo $iduser; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre  </label>
    <div class="col-sm-10">
      <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre " value="<?php echo $nombre; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="correo" class="col-sm-2 col-form-label">Correo Electrónico  </label>
    <div class="col-sm-10">
      <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo Electrónico " value="<?php echo $correo; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="usuario" class="col-sm-2 col-form-label">Usuario </label>
    <div class="col-sm-10">
      <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario " value="<?php echo $usuario; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="clave" class="col-sm-2 col-form-label">Contraseña</label>
    <div class="col-sm-10">
      <input type="password" name="clave" class="form-control" id="Clave" placeholder="Contraseña ">
    </div>
  </div>


  <?php 
                                                                                        include "../conexion.php";
                                                                                        $query_rol = mysqli_query($conection, "SELECT * FROM rol");
                                                                                        mysqli_close($conection);
                                                                                        $result_rol = mysqli_num_rows($query_rol);
                                                                                        ?>


  <div class="form-group ">

                                                                                        
    <label for="rol" class="col-sm-2 col-form-label">Tipo de Usuario</label>
                                                                                        
    <select class="col-sm-2 col-form-label notItemOne" name="rol" id="rol">
                                                                                        <?php 
                                                                                        echo $option;
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
      <input type="submit" value="Actualizar usuario" name="clave" class="form-control  bg-primary text-white" id="Clave" placeholder="Contraseña ">
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