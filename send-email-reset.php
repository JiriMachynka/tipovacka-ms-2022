<?php

    $email = $_GET["email"];
    mail(
        $email, 
        "Obnovení hesla",
        "Odkaz pro vytvoření nového hesla"
    );
    // header("Location: ?link=manage-accounts.php");

?>