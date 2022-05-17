<div class="row">
    <div class="col-4">
    </div>
    <div class="col-3">
    <h1>Obnovení hesla</h1><hr>
    <form method="POST"> 
        <h5 for="floatingInput">Heslo:</h5>
        <input type="password" class="form-control" placeholder="Heslo" name="password" />
        <h5 for="floatingPassword">Heslo znova:</h5>
        <input type="password" class="form-control" placeholder="Heslo znova" name="password2" />
        <input class="form-control btn btn-primary mt-1" type="submit" value="Obnovit heslo"/>
    </form>
    </div>
</div>
<?php
    $id = $_GET["id"];
    if ($_POST) {
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        if ($password == $password2) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users
                    SET password = $password
                    WHERE id LIKE $id";
            $conn->query($sql);
            echo "<script>window.location.href = '?link=login.php'</script>";
        } else { ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Nastala chyba',
                    text: 'Hesla se neshodují'
                });
            </script>
<?php } } ?>