<?php

    $match_id = $_GET["match_id"];
    $sql = "UPDATE tips 
            SET points = 0 
            WHERE match_id LIKE $match_id";
    $result = $conn->query($sql);   
    //Nasměrování zpět na Správu zápasů
    header("Location: ?link=manage-matches.php");

?>