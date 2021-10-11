<?php 
    require ('./db.php');
    if (isset($_POST)){
        $id = $_POST["id"];
        $query = "DELETE FROM tareas WHERE id = $id";
        $result = mysqli_query($connection, $query);
        if (!result){
            die ("No se borro");
        }
    }
?>