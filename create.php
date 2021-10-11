<?php
    require ('./db.php');

    if (isset($_POST["nombre"])){
        $nombre = ($_POST["nombre"]);
        $descripcion = ($_POST["descripcion"]);
        $query = "INSERT INTO tareas(nombre,descripcion) VALUES ('$nombre','$descripcion')";
        $result = mysqli_query($connection,$query);
        if (!$result){
            die("Registro sin exito");
        }else{
            echo "Registro con exito";
        }
    }
?>