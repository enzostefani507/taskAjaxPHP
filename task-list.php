<?php
    require ('./db.php');
    $query = "SELECT * FROM tareas";
    $result = mysqli_query($connection, $query);
    if (!$result){
        die("consulta fallida");
    }
    $json = array();
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'nombre'=>$row['nombre'],
            'descripcion'=>$row['descripcion'],
            'id'=>$row['id']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>