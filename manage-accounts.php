<?php
    $sql = "SELECT id, username, email
            FROM users
            WHERE 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { ?>
            <table>
            <tbody>
                <tr>
                    <th>Uživatelské jméno</th>
                    <th>Email</th>
                    <th>Obsah zprávy</th>
                </tr>
            </tbody>
<?php
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $username = $row["username"];
            $email = $row["email"];
            ?>
                <tr>
                    <td><?php echo $username?></td>
                    <td><?php echo $email?><a onclick='copy(\"<?php echo $email ?>\")' style='cursor: hand; '><i class='fas fa-clone'></i></a></td>
                    <td><a onclick='copyEmailBody(<?php echo $id ?>)' style='cursor: hand; '><i class='fas fa-clone'></i></a></td>
                </tr>
            <?
        }
    }
?>
</table>