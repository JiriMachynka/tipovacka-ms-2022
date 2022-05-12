<?php
    $id_user = $_GET["id"];

    $sql = "SELECT * FROM matches";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $match_id = $row["id"];

            $sql = "INSERT INTO tips (match_id, id_user, home_score_tip, away_score_tip)
                    VALUES ('$match_id', '$id_user', 0, 0)";
            $conn->query($sql);
        }
    }
    $sql = "SELECT * 
            FROM users
            WHERE id like $id_user";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["id"] == $id_user) {
                $_SESSION["user"] = array(
                    "id" => $row["id"],
                    "username" => $row["username"],
                    "email" => $row["email"],
                    "password" => $row["password"],
                    "admin" => $row["admin"]
                );
                exit(header("Location: index.php"));
            }
        }
    }
?>