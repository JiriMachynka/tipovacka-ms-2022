<?php
    $match_id = $_GET["match_id"];
    $home_score = $_SESSION["final_match_score"]["home_score"];
    $away_score = $_SESSION["final_match_score"]["away_score"];

    $sql = "SELECT * 
            FROM tips 
            WHERE match_id LIKE $match_id";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $home_score_tip = $row["home_score_tip"];
            $away_score_tip = $row["away_score_tip"];
            // print_r($_SESSION["final_match_score"]);

            $points = 0;
            // Výhra domácích
            if ($home_score > $away_score && $home_score_tip > $away_score_tip) {
                $points = ($home_score == $home_score_tip && $away_score == $away_score_tip) ? 3 : 1;
            // Výhra hosté
            } elseif ($home_score < $away_score && $home_score_tip < $away_score_tip) {
                $points = ($home_score == $home_score_tip && $away_score == $away_score_tip) ? 3 : 1;
            // Remíza
            } elseif ($home_score == $away_score && $home_score_tip == $away_score_tip) {
                $points = ($home_score == $home_score_tip) ? 3 : 1;
            }
            $id_user = $row["id_user"];
            $sql2 = "UPDATE tips 
                    SET points = $points 
                    WHERE match_id LIKE $match_id AND id_user LIKE $id_user";
            $conn->query($sql2);
        }
    }
    // print_r($_SESSION["final_match_score"]);
    unset($_SESSION["final_match_score"]);
    echo '<script>window.location.href = "?link=manage-matches.php"</script>';
?>