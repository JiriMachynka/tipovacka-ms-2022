<div class="row">
    <div class="col-4">
    </div>
    <div class="col-3">
    <h1>Registrace</h1><hr>
    <form method="POST"> 
        <h5 for="floatingInput">Uživatelské jméno:</h5>
        <input type="text" class="form-control" name="username" />
        <h5 for="floatingInput">Email:</h5>
        <input type="email" class="form-control" placeholder="test@test.cz" name="email" />
        <h5 for="floatingPassword">Heslo:</h5>
        <input type="password" class="form-control" placeholder="Heslo" name="password1" />
        <h5 for="floatingPassword">Heslo znova:</h5>
        <input type="password" class="form-control" placeholder="Heslo" name="password2" />
        <input class="form-control btn btn-primary mt-1" type="submit" value="Odeslat"/>
    </form>
    <p>Již máte účet? <a href="?link=login.php">Přihlaste se</a></p>
    </div>
    </div>  
</div>
<?php 
    if($_POST) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];

        if(!empty($username) && !empty($email) && !empty($password1) && !empty($password2)) {
            $password = "";
            if ($password1 != $password2) { ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Nastala chyba',
                            text: 'Hesla musí být stejná'
                        });
                    </script>
<?php } else {
                $password = password_hash($password1, PASSWORD_DEFAULT);
                
                $fine = TRUE;
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($email == $row["email"]) {
                            $fine = FALSE;
                            ?>
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Nastala chyba',
                                        text: 'Zvolte jiný email'
                                    });
                                </script>
<?php
                        } elseif ($username == $row["username"]) {
                            $fine = FALSE;
                            ?>
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Nastala chyba',
                                        text: 'Zvolte jiné uživatelské jméno'
                                    });
                                </script>
<?php
                        }
                    }
                } 
                if($fine) {
                    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
                    $conn->query($sql);

                    $sql = "SELECT id FROM users WHERE email LIKE '$email'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["id"];
                            echo "<script>window.location.href = '?link=copy-matches.php&id=$id'</script>";
                        }
                    }
                }
            }
            
        } else { ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Nastala chyba',
                        text: 'Vyplňte všechna pole'
                    });
                </script>
<?php } } ?>