<?php 
    if(isset($_SESSION["tip"])) { 
        echo("
            <div class='row'>
                <div class='col-md-4'>
                </div>
                <div class='col-md-4'>
                    <form method='POST' id='edit-tip'>
                        <label for='home'>".$_SESSION['tip']['home']."</label>
                        <input class='form-control' type='number' name='home_score_tip' size='6' min='0' value='".$_SESSION['tip']['home_score_tip']."' />:
                        <input class='form-control' type='number' name='away_score_tip' size='6' min='0' value='".$_SESSION['tip']['away_score_tip']."' />
                        <label for='away'>".$_SESSION['tip']['away']."</label>
                        <input class='form-control btn btn-primary' type='submit' value='Odeslat tip' />
                    </form>
                </div>
            </div>
        ");
    }

    if($_POST) {
        $home_score_tip = $_POST["home_score_tip"];
        $away_score_tip = $_POST["away_score_tip"];
        $match_id = $_SESSION["tip"]["match_id"];
        header("Location: ?link=update-my-tip.php&match_id=$match_id&home_score_tip=$home_score_tip&away_score_tip=$away_score_tip");
    }

    //Zjištění id všech zápasů, jenž nejsou uzamčené
    $sql = "SELECT id FROM matches WHERE locked LIKE 0";
    $result = $conn->query($sql);
    $id_user = $_SESSION["user"]["id"];
    if($result->num_rows > 0) {
        echo("
            <h3 class='text-center fw-bold'>Přehled zápasů</h3>
            <table id='my-tips'>
                <thead>
                    <tr>
                        <th>Čas do začátku zápasu</th>
                        <th>Začátek zápasu</th>
                        <th>Domácí</th>
                        <th>Skóre</th>
                        <th>Hosté</th>
                        <th>Akce</th>
                    </tr>
                </thead>
        ");
        while($row = $result->fetch_assoc()) {
            //Deklarace $match_id jako id zápasu pro pozdější použití u dotazu $sql2
            $match_id = $row["id"];
            //Vyhledávám data k přesnému záznamu => match_id a id_user se musí shodovat
            $sql2 = "SELECT * 
                    FROM tips 
                    JOIN matches ON tips.match_id = matches.id
                    WHERE match_id LIKE $match_id AND id_user LIKE $id_user";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    //Dodatečné formátování datumu
                    include_once("date-format.php");
                    $start = dateFormat($row2["start"]);
                    $match_id = $row2["match_id"]; 
                    $deltaTime = str_replace(" ", "T", inputDateFormat($start));
                    echo("
                        <tr class='match'>
                            <td class='$deltaTime'></td>
                            <td>".$start."</td>
                            <td>".$row2["home"]."</td>
                            <td>".$row2["home_score_tip"].":".$row2["away_score_tip"]."</td>
                            <td>".$row2["away"]."</td>
                            <td><a href='?link=edit-my-tip.php&match_id=$match_id'>Upravit tip</a></td>
                        </tr>
                    ");
                }
            }
        }
    } else {
        echo("<strong>V nabídce nejsou žádné zápasy</strong>");
    }

?>