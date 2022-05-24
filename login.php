<?php

include('navbar.php');
include('database-connection/pdo.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="container border border-dark mt-5" style="width: 500px;">
        <h1 class="text-center mt-3">LOGIN</h1>
        <div class="container mt-5">
            <form action="" method="post">
                <input type="text" class="form-control rounded-pill" placeholder="Enter username" name="username" required>
                <input type="password" class="form-control mt-3 rounded-pill" placeholder="Enter password" name="pass" required>
                <button class="btn btn-primary form-control mt-3 mb-4 rounded-pill" type="submit" name="submit">Submit</button>
            </form>
        </div>
        <div class="container text-center">
            <hr>
            <p><a href="register.php">Don't have an account?</a></p>
        </div>
    </div>

    <?php

    if (isset($_POST['submit'])) {

        $username = $_POST['username'];
        $pass = $_POST['pass'];

        $stmt = "SELECT * FROM log_in WHERE username='$username' AND pass='$pass'";
        $result = $pdo->query($stmt);

        if ($result->rowCount() == 1) {

            $stmt = "SELECT teacher_id FROM log_in WHERE username='$username' ";
            $result = $pdo->query($stmt);
            foreach ($result as $data) {
                $_SESSION['ID'] = $data['teacher_id'];
            }
            header('Location: homepage.php');
        } else {

    ?>
            <div class="alert alert-warning" role="alert">
                Incorrect Username or Password!
            </div>
    <?php

        }
    }

    ?>

    <!-- FOOTER -->

    <div class="container-fluid p-0" style="margin-top: 132px;">
        <?php

        include('footer.php');
        ?>
    </div>

</body>

</html>