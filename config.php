<?php
    // $conn = new mysqli("md333.wedos.net", "w299602_ms2022", "!Masinka2002", "d299602_ms2022") or die("Connect failed: %s\n". $conn -> error);
    $conn = new mysqli("localhost", "root", "", "katar-2022") or die("Connect failed: %s\n". $conn -> error);
    return $conn;
    $conn->close();
?>
