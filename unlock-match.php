<?php 
    $id = $_GET["id"];
    $sql = "UPDATE matches 
            SET locked = 0, 
                played = 0
            WHERE id LIKE '$id'";
    $conn->query($sql);
    //Nasměrování na vynulování bodů pro daný zápas
    exit(header("Location: ?link=null-points.php&match_id=$id"));
?>