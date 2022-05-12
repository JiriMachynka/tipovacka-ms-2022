<?php
    unset($_SESSION["user"]);
    echo "<script>window.location.href= '?link=login.php';</script>";
?>