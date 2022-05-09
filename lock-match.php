<?php 

    $id = $_GET["id"];
    $sql = "UPDATE matches SET locked = 1 WHERE id LIKE '$id'";
    $conn->query($sql);
    header("Location: ?link=edit-match.php&id=$id");

?>