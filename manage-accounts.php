<?php

    $sql = "SELECT id, username, email
            FROM users
            WHERE 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo("
            <table>
            <tbody>
                <tr>
                    <th>Uživatelské jméno</th>
                    <th>Email</th>
                    <th>Obsah zprávy</th>
                </tr>
            </tbody>
        ");
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $username = $row["username"];
            $email = $row["email"];
            echo("
                <tr>
                    <td>$username</td>
                    <td>$email <a onclick='copy(\"$email\")' style='cursor: hand; '><i class='fas fa-clone'></i></a></td>
                    <td><a onclick='copyEmailBody($id)' style='cursor: hand; '><i class='fas fa-clone'></i></a></td>
                </tr>
            ");
        }
    }
    echo("</table>");

?>