<?php
    $conn = new mysqli("localhost", "root", "", "tipovacka-ms-2022") or die("Connect failed: %s\n". $conn -> error);
    return $conn;
    $conn->close();
?>
