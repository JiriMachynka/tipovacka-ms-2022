<?php 
    $id = $_GET["id"];
    $sql = "UPDATE matches SET locked = 1 WHERE id LIKE '$id'";
    $conn->query($sql);
    echo "<script>window.location.href = '?link=edit-match.php&id=$id'</script>";
?>