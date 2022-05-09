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
    $sql = "SELECT * FROM tips";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
        }
    }

?>

</tbody>
</table>