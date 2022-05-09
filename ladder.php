<table id="ladder">
    <thead>
        <tr>
            <th>Hráč</th>
            <th>Body</th>
            </tr>
            </thead>
            <tbody>
                
<?php 

    //Funkčnost bodování
    $sql = "SELECT id_user, SUM(points)
            FROM tips
            GROUP BY id_user
            ORDER BY points DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo("<tr>");
            $username = "";
            $id_user = $row["id_user"];
            $points = $row["SUM(points)"];
            $sql2 = "SELECT username
                    FROM users
                    WHERE id LIKE $id_user";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $username = $row2["username"];
                }
            }
            $styling = "";
            if ($_SESSION["user"]["username"] == $username) {
                $styling = "background-color: yellow; ";
            }
            echo("<td style='$styling'>$username</td><td style='$styling'>$points</td>");
            echo("</tr>");
        }
    }

?>

</tbody>
</table>