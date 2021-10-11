<?php
    require ('./db.php');

    $nombre = ($_POST["nombre"]);
    $descripcion = ($_POST["descripcion"]);
    $id = ($_POST["id"]);
    
    $query = "UPDATE tareas SET nombre = '$nombre', descripcion = '$descripcion' WHERE id='$id';";
    $result = mysqli_query($connection,$query);
    if (!$result){
        die("Modificacion sin exito".mysqli_error($connection));
    }else{
        echo "Modificacion con exito";
    }
?>