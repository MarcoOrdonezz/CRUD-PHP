<!doctype html>
<html lang="en">
  <head>
    <title>Empleados</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </head>
  <body>
      <h1>Formulario Empleados</h1>
<div class="container">
    
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" id="btn" name="btn" data-bs-toggle="modal" data-bs-target="#modelId">
      Nuevo
    </button>
    
    <!-- Modal -->
    <div class="modal" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registro Empleados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="d-flex" action="crud_empleado.php" method="post" id="form_empleados">
            <div class="col">
                <div class="mb-3">
                <input type="text"  class="form-control" id="txt_id" name="txt_id" placeholder="0" readonly>
                </div>
                <div class="mb-3">
                    <label for="lbl_codigo" class="form-label"><b>Código</b></label>
                    <input type="text" name="txt_codigo" id="txt_codigo" class="form-control" placeholder="Código: E001" required>                 
                </div>
                <div class="mb-3">
                    <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
                    <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombres: Nombre1 Nombre2" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
                    <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Apellidos: Apellido1 Apellido2" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_direccion" class="form-label"><b>Dirección</b></label>
                    <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Dirección: #casa calle avenida lugar" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_telefono" class="form-label"><b>Teléfono</b></label>
                    <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="Teléfono: 12345678" required>
                </div>
                <div class="mb-3">
                  <label for="lbl_puesto" class="form-label"><b>Puesto</b></label>
                  <select class="form-select" name="drop_puesto" id="drop_puesto">
                    <option value=0>---- Puesto ----</option>
                    <?php
                    include("datos_conexion.php");
                    $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                    $db_conexion ->real_query("select id_puesto as id, puesto from puestos;");
                    $resultado = $db_conexion->use_result();
                    while($fila =  $resultado->fetch_assoc()){
                        echo"<option value=".$fila['id'].">".$fila['puesto']."</option>";
                    }
                    $db_conexion ->close();
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                    <label for="lbl_fn" class="form-label"><b>Fecha Nacimiento</b></label>
                    <input type="date" name="txt_fn" id="txt_fn" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Agregar">
                    <input type="submit" name="btn_actualizar" id="btn_actualizar" class="btn btn-warning" value="Actualizar">
                    <input type="submit" name="btn_eliminar" id="btn_eliminar" class="btn btn-danger" value="Eliminar" onclick="javascript:if(!confirm('¿Desea Eliminar?'))return false">
                </div>             
            </div>
        </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover table-bordered table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Código</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Puesto</th>
                    <th>Nacimiento</th>
                </tr>
                </thead>
                <tbody id="tbl_empleado">
                <?php
                    include("datos_conexion.php");
                    $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                    $db_conexion ->real_query("SELECT e.id_empleado as id, e.codigo,e.nombres,e.apellidos,e.direccion,e.telefono,
                    p.puesto,e.fecha_nacimiento,p.id_puesto FROM empleados as e inner join puestos as p on e.id_puesto=p.id_puesto");
                    $resultado = $db_conexion->use_result();
                    while($fila = $resultado->fetch_assoc()){
                        echo"<tr data-id=".$fila['id']." data-idp=".$fila['id_puesto'].">";
                        echo"<td>".$fila['codigo']."</td>";
                        echo"<td>".$fila['nombres']."</td>";
                        echo"<td>".$fila['apellidos']."</td>";
                        echo"<td>".$fila['direccion']."</td>";
                        echo"<td>".$fila['telefono']."</td>";
                        echo"<td>".$fila['puesto']."</td>";
                        echo"<td>".$fila['fecha_nacimiento']."</td>";
                        echo"</tr>";
                    }
                    $db_conexion ->close();
                    ?>
                </tbody>
        </table>    
</div>
<script type="text/javascript">
        $(document).ready(function() {
            $('#btn').click(function() {
	    document.getElementById("btn_agregar").disabled = false;
            document.getElementById("form_empleados").reset();            
            });
        });
    $('#tbl_empleado').on('click','tr td', function(evt){
	document.getElementById("btn_agregar").disabled = true;	
    $('#modelId').modal("show");
    var target,ide,idp,codigo,nombres,apellidos,direccion,telefono,fn;  
    target = $(event.target);
    ide=target.parents().data('id');
    idp=target.parents().data('idp');
    codigo= target.parents("tr").find("td").eq(0).html();
    nombres= target.parents("tr").find("td").eq(1).html();
    apellidos= target.parents("tr").find("td").eq(2).html();
    direccion= target.parents("tr").find("td").eq(3).html();
    telefono= target.parents("tr").find("td").eq(4).html();
    fn= target.parents("tr").find("td").eq(6).html();

    $("#txt_id").val(ide);
    $("#txt_codigo").val(codigo);
    $("#txt_nombres").val(nombres);
    $("#txt_apellidos").val(apellidos);
    $("#txt_direccion").val(direccion);
    $("#txt_telefono").val(telefono);
    $("#drop_puesto").val(idp);
    $("#txt_fn").val(fn);
    });
</script>
  </body>
</html>