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

            $points = 0;
            //Výhra domácích
            if ($home_score > $away_score && $home_score_tip > $away_score_tip) {
                if ($home_score == $home_score_tip && $away_score == $away_score_tip) $points = 3;
                else $points = 1;
            //Výhra hosté
            } elseif ($home_score < $away_score && $home_score_tip < $away_score_tip) {
                if ($home_score == $home_score_tip && $away_score == $away_score_tip) $points = 3;
                else $points = 1;
            } elseif ($home_score == $away_score && $home_score_tip == $away_score_tip) {
                if ($home_score > $home_score_tip) $points = 3;
                else  $points = 1;
            }
            $id_user = $row["id_user"];
            $sql2 = "UPDATE tips 
                    SET points = $points 
                    WHERE match_id LIKE $match_id AND id_user LIKE $id_user";
            $conn->query($sql2);
        }
    }
    unset($_SESSION["final_match_score"]);
    header("Location: ?link=manage-matches.php");

?>