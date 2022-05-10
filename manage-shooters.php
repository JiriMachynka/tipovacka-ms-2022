<?php
    $shooters = array();
    $sql = "SELECT shooter1, shooter2
            FROM users
            WHERE 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo($row["shooter1"]);
            echo($row["shooter2"]);
        }
    }
?>