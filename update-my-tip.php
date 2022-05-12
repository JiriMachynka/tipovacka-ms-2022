<?php
    $match_id = $_GET["match_id"];
    $id_user = $_SESSION["user"]["id"];
    $home_score_tip = $_GET["home_score_tip"];
    $away_score_tip = $_GET["away_score_tip"];

    $sql = "UPDATE tips 
            SET home_score_tip = $home_score_tip, 
                away_score_tip = $away_score_tip 
            WHERE match_id = $match_id AND id_user = $id_user";
    $conn->query($sql);
    unset($_SESSION["tip"]);
    exit(header("Location: ?link=my-tips.php"));
?>