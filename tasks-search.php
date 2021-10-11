<?php 
    require ('./db.php');
    $search = $_POST['search'];
    if (!empty($search)) {
        $query = "SELECT * FROM `tareas` WHERE nombre like '%$search%' or descripcion like '%$search%'";
        $result = mysqli_query($connection,$query);
        if (!$result){
            die('Query Error'.mysqli_error($connection)."\n");
        }
        $json = array();
        while ($row = mysqli_fetch_array($result)){
            $json[] = array(
                'nombre' => $row['nombre'],
                'descripcion' => $row['descripcion'],
                'id' => $row['id']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    
?>