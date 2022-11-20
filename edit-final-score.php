<?php
    $id = $_GET["match_id"];
    $sql = "SELECT * FROM matches WHERE id LIKE $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION["final_match_score"] = array(
                "id" =>         $row["id"],
                "start" =>      $row["start"],
                "home" =>       $row["home"],
                "home_score" => $row["home_score"],
                "away_score" => $row["away_score"],
                "away" =>       $row["away"],
            );
        }
    }
    echo '<script>window.location.href = "?link=manage-matches.php"</script>';
?>