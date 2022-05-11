<?php
    $sql = "SELECT *
            FROM shooters
            WHERE 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo("
            <table>
                <thead>
                    <tr>
                        <th>Střelec</th>
                        <th>Góly</th>
                        <th colspan='2'>Akce</th>
                    </tr>
                </thead>
                <tbody>
        ");
        while ($row = $result->fetch_assoc()) {
            $shooter = $row["shooter"];
            $goals = $row["goals"];
            echo("
                <tr>
                    <td>$shooter</td>
                    <td>$goals</td>
                    <td>
            ");
            echo $goals > 0 ? ("<a href='?link=edit-goals.php&shooter=$shooter&method=decrease'><i class='fas fa-minus'></i></a>") : ("<div style='padding: 8px 7px; '></div>");
            echo("
                    </td>
                    <td><a href='?link=edit-goals.php&shooter=$shooter&method=increase'><i class='fas fa-plus'></i></a></td>
                </tr>"
            );
        }
        echo("
            </tbody>
            </table>
        ");
    }
?>