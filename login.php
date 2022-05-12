<div class="row">
    <div class="col-4">
    </div>
    <div class="col-3">
    <h1>Přihlášení</h1><hr>
    <form method="POST"> 
        <h5 for="floatingInput">Email:</h5>
        <input type="email" class="form-control" placeholder="test@test.cz" name="email" />
        <h5 for="floatingPassword">Heslo:</h5>
        <input type="password" class="form-control" placeholder="Heslo" name="password" />
        <input class="form-control btn btn-primary mt-1" type="submit" value="Odeslat"/>
    </form>
    <p>Ještě nemáš účet? <a href="?link=registrace.php">Registruj se zde</a></p>
    </div>
</div>
<?php 
    if($_POST) {
        $email = $_POST["email"];
        $password = $_POST["password"];
    
        if(!empty($email) && !empty($password)) {
            $sql = 'SELECT * FROM users';
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if($email == $row["email"] && password_verify($password, $row["password"])) {
                        $_SESSION["user"] = array(
                            "id" => $row["id"],
                            "username" => $row["username"],
                            "email" => $row["email"],
                            "password" => $row["password"],
                            "admin" => $row["admin"]
                        );
                        echo "<script>window.location.href= 'index.php';</script>";
                    } else { ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Nastala chyba',
                                text: 'Špatné heslo'
                            });
                        </script>
                    <?php
                    }
                }
        } else { ?>
                <script>    
                    Swal.fire({
                        icon: 'error',
                        title: 'Nastala chyba',
                        text: 'V databázi se nenachází žádný účet'
                    });
                </script>    
            <?php
        }
    } else { ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Nastala chyba',
                    text: 'Vyplňte všechna pole'
                });
            </script>
        <?php
    }
}
?>