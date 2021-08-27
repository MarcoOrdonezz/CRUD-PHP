<?php   
$id=$_GET['id'];

    include("datos_conexion.php");
    $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
    $sql="delete from empleados where id_empleado=".$id;
    if($db_conexion->query($sql)===true){
        $db_conexion ->close();
         echo"Exito";
        header('location:index.php');
    }else{
         echo"Error" . $sql . "<br>".$db_conexion ->close();
    }

?>