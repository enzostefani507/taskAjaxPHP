<?php 
    require ('./db.php');
    $id = $_POST["id"];
    $query = "SELECT * FROM tareas WHERE id = $id";
    $result = mysqli_query($connection, $query);
    if (!result){
        die ("No se encontro");
    }
    $json = array();
    while ($row = mysqli_fetch_assoc($result)){
        $json[] = array(
            'nombre' => $row['nombre'],
            'descripcion' => $row['descripcion'],
            'id' => $row['id'],
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>