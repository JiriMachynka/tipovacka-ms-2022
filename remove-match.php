<?php
    $match_id = $_GET["match_id"];

    // Smazání záznamů z tabulky "tips"
    $sql = "DELETE FROM tips WHERE match_id LIKE $match_id";
    $conn->query($sql);

    // Smazání záznamů z tabulky "matches"
    $sql = "DELETE FROM matches WHERE id LIKE $match_id";
    $conn->query($sql);
    
    echo "<script>window.location.href = '?link=manage-matches.php'</script>";
?>