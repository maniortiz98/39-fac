

<?php 
session_start();

if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2 )
{
  header("location: ../");
}

include "../conexion.php";
if(!empty($_POST)){
  
    $alert='';
    if (empty ($_POST['proveedor']) || empty ($_POST['producto']) || empty ($_POST['precio']) || $_POST['precio'] <= 0 
    ||  empty ($_POST['cantidad']) || $_POST['cantidad'] <= 0  )  {

        $alert='<p class="msg_error"> Todos los campos son obligatorios.</p>';
        # code...
    }else {
        
        $proveedor          =$_POST['proveedor'];
        $producto      =$_POST['producto'];
        $precio     =$_POST['precio'];
        $cantidad    =$_POST['cantidad'];
        //$clave      =  md5($_POST['clave']);
        $usuario_id  =$_SESSION['iduser'];

        $foto = $_FILES['foto'];

        $nombre_foto = $foto['name'];
        $type = $foto['type'];
        $url_temp = $foto['tmp_name'];

        $imgproducto = 'img_producto.png';
        
        if($nombre_foto != ''){
          $destino = 'img/uploads/';
          $img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
          $imgproducto = $img_nombre.'.jpg';
          $src = $destino.$imgproducto;
         }



        
            $query_insert = mysqli_query($conection, "INSERT INTO producto(proveedor, descripcion, precio, existencia, usuario_id, foto)

            VALUES('$proveedor','$producto', '$precio', '$cantidad', '$usuario_id', '$imgproducto')");

            if ($query_insert ) {

              if($nombre_foto != ''){
                move_uploaded_file($url_temp, $src);
              }
                $alert='<p class="msg_save">Producto guardado Correctamente.</p>';
                   # code...
               }else{
                $alert='<p class="msg_error">Error al guardar producto.</p>';
               }
        
    }
}
?>
<!doctype html>
<html lang="en">
    <link rel="stylesheet" href="css/style1.css">
    
    
   
    
  <head>
    <?php include "includes/scripts.php" ?>
    
    <title>Registro Producto</title>
  </head>
  <body>

  <?php include "includes/header.php" ?>

<section id="container">

<div class="container">
<div class="form_refister">
     
    <h1>Registro Producto</h1>
    <hr>
    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
    <form action="" method="post" enctype="multipart/form-data">
  
    <div class="form-group row">
    <label for="proveedor" class="col-sm-2 col-form-label">Proveedor </label>

    <?php
    
    $query_proveedor = mysqli_query($conection, "SELECT codproveedor, proveedor FROM proveedor WHERE estatus = 1 ORDER BY proveedor ASC");
    
    $result_proveedor = mysqli_num_rows($query_proveedor);
    mysqli_close($conection);
    
    
    ?>
    <div class="col-sm-10">
        <select name="proveedor" id="proveedor" class="col-sm-2 col-form-label" >
        <?php
        
        if ($result_proveedor > 0){
          while($proveedor = mysqli_fetch_array($query_proveedor)){
            ?>
              <option value="<?php echo $proveedor['codproveedor'] ; ?>"><?php echo $proveedor['proveedor'] ; ?></option>
             <?php
          }
        }
        
        ?>
            
        </select>
      
    </div>
  </div>
  <div class="form-group row">
    <label for="cproducto" class="col-sm-2 col-form-label">Producto</label>
    <div class="col-sm-10">
      <input type="text" name="producto" class="form-control" id="producto" placeholder="Nombre del producto ">
    </div>
  </div>
  <div class="form-group row">
    <label for="precio" class="col-sm-2 col-form-label">Precio </label>
    <div class="col-sm-10">
      <input type="number" name="precio" class="form-control" id="precio" placeholder="Precio del puducto">
    </div>
  </div>
  <div class="form-group row">
    <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
    <div class="col-sm-10">
      <input type="number" name="cantidad" class="form-control" id="cantidad" placeholder="Cantidad del producto ">
    </div>
  </div>

  <div class="photo">
	<label for="foto">Foto</label>
        <div class="prevPhoto">
        <span class="delPhoto notBlock">X</span>
        <label for="foto"></label>
        </div>
        <div class="upimg">
        <input type="file" name="foto" id="foto">
        </div>
        <div id="form_alert"></div>
</div>
<br><br>

  <div>
    <div class="form-group row container ">
      <input type="submit" value="Guardar producto" name="clave" class="form-control  bg-primary text-white" id="guardar" placeholder=" ">
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