<html lang="en">
  <head>
    <title>Actualizar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
<?php
$id=$_GET['id'];
include("datos_conexion.php");
$db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
$db_conexion ->real_query("SELECT e.id_empleado as id, e.codigo,e.nombres,e.apellidos,e.direccion,e.telefono,
p.puesto,e.fecha_nacimiento , e.id_puesto FROM empleados as e inner join puestos as p on e.id_puesto=p.id_puesto where e.id_empleado=".$id."");
$resultado = $db_conexion->use_result();
while($fila = $resultado->fetch_assoc()){
?>
 <div class="container">
        <form class="d-flex" action="" method="post">
            <div class="col">
            <div class="mb-3">
                    <label for="lbl_id" class="form-label"><b>ID</b></label>
                    <input name="txt_id" id="txt_id" class="form-control" value="<?php echo $fila['id']?>" readonly>                 
                </div>
                <div class="mb-3">
                    <label for="lbl_codigo" class="form-label"><b>Código</b></label>
                    <input type="text" name="txt_codigo" id="txt_codigo" class="form-control" value="<?php echo $fila['codigo']?>" required>                 
                </div>
                <div class="mb-3">
                    <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
                    <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" value="<?php echo $fila['nombres']?>" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
                    <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" value="<?php echo $fila['apellidos']?>" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_direccion" class="form-label"><b>Dirección</b></label>
                    <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" value="<?php echo $fila['direccion']?>" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_telefono" class="form-label"><b>Teléfono</b></label>
                    <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" value="<?php echo $fila['telefono']?>" required>
                </div>
                <div class="mb-3">
                  <label for="lbl_puesto" class="form-label"><b>Puesto</b></label>
                  <select class="form-select" name="drop_puesto" id="puesto" value="<?php echo $fila['id_puesto']?>">
                    <option value=0>---- Puesto ----</option>
                    <?php
                    include("datos_conexion.php");
                    $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                    $db_conexion ->real_query("select id_puesto as id, puesto from puestos;");
                    $resultado = $db_conexion->use_result();
                    while($filad = $resultado->fetch_assoc()){
                        if($filad['id']==$fila['id_puesto']){
                         echo"<option selected='selected' value=".$filad['id'].">". $filad['puesto'] ."</option>";
                        }else{
                        echo"<option value=".$filad['id'].">". $filad['puesto'] ."</option>";
                        }
                    }
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                    <label for="lbl_fn" class="form-label"><b>Fecha Nacimiento</b></label>
                    <input type="date" name="txt_fn" id="txt_fn" class="form-control" value="<?php echo $fila['fecha_nacimiento']?>" required>
                </div>
                <div class="mb-3">
                <a href="modal.php"><input type="button" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Regresar"></a>
                <input type="submit" name="btn_actualizar" id="btn_actualizar" class="btn btn-warning" value="Actualizar">
                </div>                
            </div>
        </form>
        <?php 
    if(isset($_POST["btn_actualizar"])){
        include("datos_conexion.php");
        $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
        $txt_codigo =utf8_decode( $_POST["txt_codigo"]);
        $txt_nombres =utf8_decode( $_POST["txt_nombres"]);
        $txt_apellidos =utf8_decode( $_POST["txt_apellidos"]);
        $txt_direccion =utf8_decode( $_POST["txt_direccion"]);
        $txt_telefono =utf8_decode( $_POST["txt_telefono"]);
        $drop_puesto =utf8_decode( $_POST["drop_puesto"]);
        $txt_fn =utf8_decode( $_POST["txt_fn"]);
        $sql="Update empleados set codigo='".$txt_codigo."',nombres='".$txt_nombres."',apellidos='".$txt_apellidos."',direccion='".$txt_direccion."',telefono='".$txt_telefono."',fecha_nacimiento='".$txt_fn."',id_puesto=".$drop_puesto." 
        where id_empleado = ".$fila['id'].";";
        if($db_conexion->query($sql)===true){
            print "<script>window.setTimeout(function() { window.location = '/crud_php/index.php' }, 1);</script>";
        }else{
            echo"Error" . $sql . "<br>";

        }
    }
?>
        <?php 
        }
        $db_conexion ->close();
        ?>
        </div>