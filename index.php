<?php
    session_start();
    include_once("config.php");
?>
<html>
    <head>
        <title>Tipovačka ME 2021</title>
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="styles/styles.css" rel="stylesheet" type="text/css" />
        <link href="styles/table.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <!-- Sweet alerts -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <div id="wrapper">
            <?php
            include_once("navbar.php");
            
            if(!isset($_SESSION["user"]) && isset($_GET["link"]) == "password-reset.php") include_once($_GET["link"]);
            elseif(isset($_GET["link"])) include_once($_GET["link"]);
            elseif(!isset($_GET["link"]) && !isset($_SESSION["user"])) include_once("login.php");
            else {
                //Zjištění celkového počtu hráčů
                $sql = "SELECT COUNT(*) FROM users";
                $result = $conn->query($sql);
                $player_count = 0;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $player_count = $row["COUNT(*)"];
                    }
                }

                $sql = "SELECT * FROM matches WHERE locked LIKE 1";
                $result = $conn->query($sql);
                if($result->num_rows > 0) { ?>
                        <table>                
                        <thead>
                        <tr>
                            <th colspan='5'>Zápas</th>
                            <th colspan='<?php echo $player_count ?>'>Hráči</th>
                        </tr>
                        <tr>
                            <th>Čas do začátku zápasu</th>
                            <th>Začátek zápasu</th>
                            <th>Domácí</th>
                            <th>Skóre</th>
                            <th>Hosté</th>
                <?php
                    $sql2 = "SELECT username FROM users";
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $username = $row2["username"];
                            ?> <th><?php echo $username ?></th> <?php
                        }
                    }
                    ?>
                        </tr>
                        </thead>
                        <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        include_once("date-format.php");
                        $start = dateFormat($row["start"]);
                        $deltaTime = str_replace(" ", "T", inputDateFormat($start));
                        $match_id = $row["id"];
                        $home = $row["home"];
                        $home_score = $row["home_score"];
                        $away_score = $row["away_score"];
                        $away = $row["away"];
                        ?>
                            <tr class='match'>
                                <td class='<?php echo $deltaTime ?>'></td>
                                <td><?php echo $start ?></td>
                                <td><?php echo $home ?></td>
                                <td><?php echo $home_score ?>:<?php echo $away_score ?></td>
                                <td><?php echo $away ?></td>
                        <?php
                        $sql2 = "SELECT * 
                                FROM tips 
                                JOIN matches ON tips.match_id = matches.id 
                                JOIN users ON tips.id_user = users.id 
                                WHERE matches.id LIKE $match_id"; 
                        $result2 = $conn->query($sql2);
                        if ($result2->num_rows > 0) {
                            while ($row2 = $result2->fetch_assoc()) {
                                $home_score_tip = $row2["home_score_tip"];
                                $away_score_tip = $row2["away_score_tip"];
                                ?>
                                    <td><?php echo $home_score_tip ?>:<?php echo $away_score_tip ?></td>
                                <?php
                            }
                        }
                        ?> </tr> <?php
                    }
                    ?>
                        </tbody>
                        </table>
                    <?php
                } else {
                    ?><strong>V nabídce nejsou žádné zápasy</strong><?php
                }
            }
            ?>
        </div>
        <?php if(isset($_GET["link"]) && $_GET["link"] == "manage-matches.php") { ?> <script src="js/teams.js"></script> <?php } ?>
        <?php if(isset($_GET["link"]) && $_GET["link"] != "manage-matches.php") { ?> <script src="js/main.js"></script> <?php } ?>
        <script src="js/time.js"></script>
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/8ee42a1118.js" crossorigin="anonymous"></script>
        <script src="js/general.js"></script>
    </body>
    </html>