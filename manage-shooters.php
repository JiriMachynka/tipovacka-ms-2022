<?php
    $sql = "SELECT *
            FROM shooters
            WHERE 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Střelec</th>
                        <th>Góly</th>
                        <th colspan='2'>Akce</th>
                    </tr>
                </thead>
                <tbody>
<?php
        while ($row = $result->fetch_assoc()) {
            $shooter = $row["shooter"];
            $goals = $row["goals"];
            ?>
                <tr>
                    <td><?php echo $shooter ?></td>
                    <td><?php echo $goals ?></td>
                    <td>
<?php
                if ($goals > 0) { ?>
                    <a href='?link=edit-goals.php&shooter=<?php echo $shooter ?>&method=decrease'><i class='fas fa-minus'></i></a>
<?php } else { ?>
                    <div style='padding: 8px 7px; '></div>
<?php } ?>
                    </td>
                    <td><a href='?link=edit-goals.php&shooter=<?php echo $shooter ?>&method=increase'><i class='fas fa-plus'></i></a></td>
                </tr>
<?php } ?>
            </tbody>
            </table>
<?php } ?>