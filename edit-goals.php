<?php

    $shooter = str_replace("%20", " ", $_GET["shooter"]);
    $method = $_GET["method"];
    $goals = 0;
    $sql = "SELECT goals 
            FROM shooters
            WHERE shooter LIKE '$shooter'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $goals = intval($row["goals"]);
        }
    }
    $goals = $method == "increase" ? $goals + 1 : $goals - 1;
    $sql = "UPDATE shooters
            SET goals = $goals
            WHERE shooter LIKE '$shooter'";
    $conn->query($sql);
    header("Location: ?link=manage-shooters.php");

?>