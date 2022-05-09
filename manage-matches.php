<?php 
    if (isset($_SESSION["edited_match"])) {
        echo("
            <div class='row'>
                <div class='col-4'>
                </div>
                <div class='col-3'>
                <h4>Upravit zápas</h4><hr>
                <form method='POST'> 
                    <h5 for='floatingInput'>Datum:</h5>
                    <input type='datetime-local' name='start' value='".str_replace(" ", "T", $_SESSION["edited_match"]["start"])."'/>
                    <h5 for='floatingInput'>Domácí:</h5>
                    <input type='text' class='form-control' id='home_edit' name='home' value='".$_SESSION["edited_match"]["home"]."' />
                    <h5 for='floatingInput'>Skóre domácí:</h5>
                    <input type='number' min='0' class='form-control' name='home_score' value='".$_SESSION["edited_match"]["home_score"]."' disabled />
                    <h5 for='floatingInput'>Skóre domácí:</h5>
                    <input type='number' min='0' class='form-control' name='away_score' value='".$_SESSION["edited_match"]["away_score"]."' disabled />
                    <h5 for='floatingInput'>Hosté:</h5>
                    <input type='text' class='form-control' id='away_edit' name='away' value='".$_SESSION["edited_match"]["away"]."' />
                    <input class='form-control btn btn-primary mt-1' type='submit' name='submit' value='Upravit zápas'/>
                </form>
                </div>
            </div>
        ");
    } 
    elseif (isset($_SESSION["final_match_score"])) {
        echo("
            <div class='row'>
                <div class='col-4'>
                </div>
                <div class='col-3'>
                <h4>Upravit zápas</h4><hr>
                <form method='POST'> 
                    <h5 for='floatingInput'>Datum:</h5>
                    <input type='datetime-local' name='start' value='".str_replace(" ", "T", $_SESSION["final_match_score"]["start"])."' />
                    <h5 for='floatingInput'>Domácí:</h5>
                    <input type='text' class='form-control' name='home_final' value='".$_SESSION["final_match_score"]["home"]."' disabled />
                    <h5 for='floatingInput'>Skóre domácí:</h5>
                    <input type='number' min='0' class='form-control' name='home_score' value='".$_SESSION["final_match_score"]["home_score"]."' />
                    <h5 for='floatingInput'>Skóre domácí:</h5>
                    <input type='number' min='0' class='form-control' name='away_score' value='".$_SESSION["final_match_score"]["away_score"]."' />
                    <h5 for='floatingInput'>Hosté:</h5>
                    <input type='text' class='form-control' name='away_final' value='".$_SESSION["final_match_score"]["away"]."' disabled />
                    <input class='form-control btn btn-primary mt-1' type='submit' name='submit' value='Konečný výsledek'/>
                </form>
                </div>
            </div>
        ");
    } else {
        echo("
            <div class='row'>
                <div class='col-4'>
                </div>
                <div class='col-3'>
                <h4>Přidat zápas</h4><hr>
                <form method='POST'> 
                    <h5 for='floatingInput'>Datum:</h5>
                    <input type='datetime-local' name='start' />
                    <h5 for='floatingInput'>Skupina:</h5>
                    <select class='form-control' name='group' id='group' onchange='selectedGroup()'>
                    </select>
                    <h5 for='floatingInput'>Domácí:</h5>
                    <select class='form-control' name='home' id='home' onchange='selectedHomeTeam()'>
                    </select>
                    <h5 for='floatingInput'>Hosté:</h5>
                    <select class='form-control' name='away' id='away'>
                    </select>
                    <input class='form-control btn btn-primary mt-1' type='submit' name='submit' value='Přidat zápas'/>
                </form>
                </div>
            </div>
        ");
    } ?>
<div class="row">
<?php

    $sql = "SELECT * FROM matches";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo("
        <h3 class='text-center fw-bold'>Přehled zápasů</h3>
        <table>
        <thead>
        <tr>
            <th>Začátek zápasu</th>
            <th>Domácí</th>
            <th>Skóre</th>
            <th>Hosté</th>
            <th colspan='3'>Akce</th>
            </tr>
            </thead>
        ");
        while ($row = $result->fetch_assoc()) { 
            $locked = $row["locked"];
            include_once("date-format.php");
            $start = dateFormat($row["start"]); ?>
            <tr>
                <td><?php echo($start); ?></td>
                <td><?php echo($row["home"]); ?></td>
                <td><?php echo($row["home_score"].":".$row["away_score"]); ?></td>
                <td><?php echo($row["away"]); ?></td>
                <td><a href='?link=remove-match.php&match_id=<?php echo($row["id"]); ?>'><i class="fas fa-trash"></i></a></td>
                <?php if ($locked == 0) { ?>
                    <td><a href='?link=edit-match.php&match_id=<?php echo($row["id"]); ?>'><i class="fas fa-edit"></i></a></td>
                    <?php if (!isset($_SESSION["edited_match"])) { ?>  
                    <td>
                        <a href='?link=lock-match.php&id=<?php echo($row["id"]); ?>'>
                        <i class='fas fa-lock-open'></i>
                        </a>
                    </td>
                    <?php } ?>
                    </tr>
            <?php } else { ?>
                    <td><a href='?link=edit-final-score.php&match_id=<?php echo($row["id"]); ?>'><i class='fas fa-flag-checkered'></i></a></td>
                    <td><a href='?link=unlock-match.php&id=<?php echo($row["id"]); ?>'><i class='fas fa-lock'></i></a></td>
                    </tr>
            <?php } }
        echo("</table>");
    } else {
        echo("<strong>V nabídce nejsou žádné zápasy</strong>");
    }

    if($_POST && $_POST["submit"] == 'Přidat zápas') {
        $start = $_POST["start"];
        $start = str_replace("T", " ", $start);
        $home = $_POST["home"];
        $away = $_POST["away"];
        if (!empty($home) && !empty($away)) {
            $currentId = 0;
            $sql = "SHOW TABLE STATUS WHERE name = 'matches'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $currentId = $row["Auto_increment"];
                }
            }

            $sql = "INSERT INTO matches (start, home, away, locked) 
                    VALUES ('$start', '$home', '$away', 0)";
            $conn->query($sql);

            $sql = "SELECT id FROM users";
            $result = $conn->query($sql);
            $users = array();
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($users, $row["id"]);
                }
            }
            foreach ($users as $id_user) {
                $sql = "INSERT INTO tips (match_id ,id_user, home_score_tip, away_score_tip) 
                        VALUES ('$currentId', '$id_user', 0, 0)";
                $conn->query($sql); 
            }

            header("Location: ?link=manage-matches.php");
        } else {
            echo("
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Nastala chyba',
                text: 'Vyplňte všechna pole'
            });
            </script>
            ");
        }
    } elseif ($_POST && $_POST["submit"] == 'Upravit zápas') {
        $home = $_POST["home"];
        $away = $_POST["away"];
        $match_id = $_SESSION["edited_match"]["id"];

        $sql = "UPDATE matches 
                SET home = '$home', 
                    away = '$away' 
                WHERE id LIKE $match_id";
        $conn->query($sql);
        unset($_SESSION["edited_match"]);
        header("Location: ?link=manage-matches.php");
    } elseif ($_POST && $_POST["submit"] == 'Konečný výsledek') {
        $_SESSION["final_match_score"]["home_score"] = $_POST["home_score"];
        $_SESSION["final_match_score"]["away_score"] = $_POST["away_score"];
        $match_id = $_SESSION["final_match_score"]["id"];

        $home_score = $_SESSION["final_match_score"]["home_score"];
        $away_score = $_SESSION["final_match_score"]["away_score"];

        $sql = "UPDATE matches 
                SET home_score = '$home_score', 
                    away_score = '$away_score',
                    played = 1
                WHERE id LIKE $match_id";
        $conn->query($sql);
        header("Location: ?link=count-points.php&match_id=$match_id");
    }

?>
</div>