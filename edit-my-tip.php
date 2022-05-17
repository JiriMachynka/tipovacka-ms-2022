<?php
    $match_id = $_GET["match_id"];
    $id_user = $_SESSION["user"]["id"];
    $sql =  "SELECT * 
            FROM tips 
            JOIN matches ON tips.match_id = matches.id
            WHERE match_id LIKE $match_id AND id_user LIKE $id_user";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION["tip"] = array(
                "match_id" => $row["match_id"],
                "home" => $row["home"],
                "home_score_tip" => $row["home_score_tip"],
                "away_score_tip" => $row["away_score_tip"],
                "away" => $row["away"]
            );
        }
    }
    echo '<script>window.location.href = "?link=my-tips.php"</script>';
?>