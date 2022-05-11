<table id="ladder">
    <thead>
        <tr>
            <th>Hráč</th>
            <th>Body</th>
        </tr>
    </thead>
    <tbody>
<?php 

    // Point system
    $sql = "SELECT id_user, SUM(points)
            FROM tips
            GROUP BY id_user
            ORDER BY points DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $totalPoints = 0;
            echo("<tr>");
            $username = "";
            $id_user = $row["id_user"];
            $points = $row["SUM(points)"];
            $sql2 = "SELECT username, shooter1, shooter2
                    FROM users
                    WHERE id LIKE $id_user";
            $result2 = $conn->query($sql2);
            $shooterPoints = 0;
            $shooters = array();
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $username = $row2["username"];
                    if (!empty($row2["shooter1"]) && !empty($row2["shooter2"])) {
                        array_push($shooters, $row2["shooter1"], $row2["shooter2"]);
                        foreach ($shooters as $shooter) {
                            $sql3 = "SELECT goals
                                    FROM shooters
                                    WHERE shooter LIKE '$shooter'";
                            $currentShooterPoints = 0;
                            $result3 = $conn->query($sql3);
                            if ($result3->num_rows > 0) {
                                while ($row3 = $result3->fetch_assoc()) {
                                    $currentShooterPoints = intval($row3["goals"]);
                                }
                            }
                            $shooterPoints = $shooterPoints + $currentShooterPoints;
                        }
                    }
                }
            }
            $totalPoints = $points + $shooterPoints;
            // Current user is highlighted with yellow background in the table
            $styling = "";
            if ($_SESSION["user"]["username"] == $username) {
                $styling = "background-color: yellow; ";
            }
            echo("
                <td style='$styling'>$username</td>
                <td style='$styling'>$totalPoints <abbre class='info' title='Body za střelce'>($shooterPoints)</abbre></td>
            ");
            echo("</tr>");
        }
    }

?>

</tbody>
</table>