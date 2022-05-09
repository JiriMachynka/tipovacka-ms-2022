<?php
    include_once("config.php");
    $sql = "SELECT * FROM users WHERE id LIKE " . $_SESSION["user"]["id"];
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION["long-shot"] = array(
                'winner' => $row["winner"],
                'finalist' => $row["finalist"],
                'semifinalist1' => $row["semifinalist1"],
                'semifinalist2' => $row["semifinalist2"],
                'shooter1' => $row["shooter1"],
                'shooter2' => $row["shooter2"],
            );
        }
    }

?>

<div class='row'>
<div class='col-4'>
</div>
<div class='col-3'>
    <form method='POST' id='long-shots'> 
        <h6 for='floatingInput'>Vítěz:</h6>
        <select class='form-control' name='winner' id='winner' >
        </select>
        <h6 for='floatingInput'>Finalista:</h6>
        <select class='form-control' name='finalist' id='finalist'>
        </select>
        <h6 for='floatingInput'>Semifinalista 1:</h6>
        <select class='form-control' name='semifinalist1' id='semifinalist1'>
        </select>
        <h6 for='floatingInput'>Semifinalista 2:</h6>
        <select class='form-control' name='semifinalist2' id='semifinalist2'>
        </select>
        <h6 class='info' for='floatingInput'><abbre title='Zadejte příjmení střelce, &#013;je-li nutno tak i křestní jméno ve formátu: &#013;Jméno Příjmení'>Střelec 1:</abbre></h6>
        <input type="text" class='form-control' name='shooter1' id='shooter1' 
        <?php if(isset($_SESSION["long-shot"]["shooter1"])): echo("value=\"".$_SESSION["long-shot"]["shooter1"]."\""); endif; ?>        
        />
        <h6 class='info' for='floatingInput'><abbre title='Zadejte příjmení střelce, &#013;je-li nutno tak i křestní jméno ve formátu: &#013;Jméno Příjmení'>Střelec 2:</abbre></h6>
        <input type="text" class='form-control' name='shooter2' id='shooter2'
        <?php if(isset($_SESSION["long-shot"]["shooter2"])): echo("value=\"".$_SESSION["long-shot"]["shooter2"]."\""); endif; ?>
        />
        <input class='form-control btn btn-primary mt-1' type='submit' name='submit' value='Upravit moje tipy'/>
    </form>
</div>
</div>

<?php

    if($_POST) {
        $winner = $_POST["winner"];
        $finalist = $_POST["finalist"];
        $semifinalist1 = $_POST["semifinalist1"];
        $semifinalist2 = $_POST["semifinalist2"];
        $shooter1 = $_POST["shooter1"];
        $shooter2 = $_POST["shooter2"];

        $id = $_SESSION["user"]["id"];
        $sql = "UPDATE users
                SET winner = '$winner',
                    finalist = '$finalist',
                    semifinalist1 = '$semifinalist1',
                    semifinalist2 = '$semifinalist2',
                    shooter1 = '$shooter1',
                    shooter2 = '$shooter2'
                WHERE id LIKE $id";
        $conn->query($sql);
        header("Location: ?link=my-profile.php&saved=1");
        
    }

    if(isset($_GET["saved"]) && $_GET["saved"] == 1) {
        echo("
            <script>
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Tipy byly uloženy',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        ");
    }

?>

<script>
    window.onload = () => {
        <?php if(isset($_SESSION["long-shot"]["winner"])): echo("chooseTeam(\"winner\",\"".$_SESSION["long-shot"]["winner"]."\");\n"); endif; ?>
        <?php if(isset($_SESSION["long-shot"]["finalist"])): echo("chooseTeam(\"finalist\",\"".$_SESSION["long-shot"]["finalist"]."\");\n"); endif; ?>
        <?php if(isset($_SESSION["long-shot"]["semifinalist1"])): echo("chooseTeam(\"semifinalist1\",\"".$_SESSION["long-shot"]["semifinalist1"]."\");\n"); endif; ?>
        <?php if(isset($_SESSION["long-shot"]["semifinalist2"])): echo("chooseTeam(\"semifinalist2\",\"".$_SESSION["long-shot"]["semifinalist2"]."\");\n"); endif; ?>
    }
</script>