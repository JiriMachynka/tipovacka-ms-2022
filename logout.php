<?php

    unset($_SESSION["user"]);
    header("Location: ?link=login.php");

?>