<?php
include('navbar.php');
include('database-connection/pdo.php');
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

    <div class="container w-50 border border-dark shadow mt-4 pe-4 ps-4">
        <form action="" method="post" autocomplete="off">
            <h1 class="text-center">Register</h1>
            <hr>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control mt-4" placeholder="First Name" name="firstname" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control mt-4" placeholder="Middle Name" name="middlename" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control mt-4" placeholder="Last Name" name="lastname" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control mt-4" placeholder="Username" name="username" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control mt-4" placeholder="Contact Number" name="contactnumber" maxlength="11" required>
                </div>
                <div class="col">
                    <input type="email" class="form-control mt-4" placeholder="Contact Email" name="contactemail" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="password" class="form-control mt-4" placeholder="Password" name="pass" required>
                </div>
                <div class="col">
                    <input type="password" class="form-control mt-4" placeholder="Confirm Password" name="confirmpass" required>
                </div>
            </div>
            <button class="btn btn-primary form-control mt-4 mb-3">Submit</button>
            <hr>
            <div class="container mb-3 text-center" style="margin-top: 23px;">
                <a href="login.php">Login instead?</a>
            </div>
        </form>

    </div>
    <!-- VALIDATE INPUT FROM REGISTER FORM AND INSERT TO DATABASE -->
    <?php

    $stmt1 = $pdo->prepare("INSERT INTO teacher (firstname, middlename, lastname)
       VALUES (:firstname, :middlename, :lastname)");

    $stmt2 = $pdo->prepare("INSERT INTO contact (teacher_id, contact_number, contact_email)
       VALUES (:teacherid, :contactnumber, :contactemail)");

    $stmt3 = $pdo->prepare("INSERT INTO log_in (teacher_id, username, pass)
       VALUES (:teacherid, :username, :pass)");

    $stmt1->bindParam(':firstname', $firstname);
    $stmt1->bindParam(':middlename', $middlename);
    $stmt1->bindParam(':lastname', $lastname);

    $stmt2->bindParam(':teacherid', $teacherid);
    $stmt2->bindParam(':contactnumber', $contactnumber);
    $stmt2->bindParam(':contactemail', $contactemail);

    $stmt3->bindParam(':teacherid', $teacherid);
    $stmt3->bindParam(':username', $username);
    $stmt3->bindParam(':pass', $pass);

    $query = "SELECT username FROM log_in";
    $d = $pdo->query($query);

    // VERIFY FOR EMPTY FIELD
    if (
        !empty($_POST['firstname']) && !empty($_POST['middlename']) && !empty($_POST['lastname'])
        && !empty($_POST['contactnumber']) && !empty($_POST['contactemail']) && !empty($_POST['username'])
        && !empty($_POST['pass'])
    ) {

        // VERIFY IF THE PASWORD MATCHED TO CONFIMATION PASSWORD
        if ($_POST['pass'] == $_POST['confirmpass']) {
            // MAKE CONDITION IF THERE ARE ROWS FETCHED
            if ($d->rowCount() > 0) {

                $isExist = false;

                // LOOPING FROM FETCHED USERNAMES IF EXIST
                foreach ($d as $data) {
                    if ($data['username'] == $_POST['username']) {
                        echo "Username already exist!";
                        $isExist = true;
                        break;
                    }
                }
                // EXECUTE THE INSERTION IF THE USERNAME IS VALID
                if ($isExist == false) {
                    // STATEMENT 1
                    $firstname = $_POST['firstname'];
                    $middlename = $_POST['middlename'];
                    $lastname = $_POST['lastname'];

                    // STATEMENT 2
                    $contactnumber = $_POST['contactnumber'];
                    $contactemail = $_POST['contactemail'];

                    // STATEMENT 3
                    $username = $_POST['username'];
                    $pass = $_POST['pass'];

                    if ($stmt1->execute()) {

                        $teacherid = $GLOBALS['pdo']->lastInsertId();
                        $stmt2->execute();
                        $stmt3->execute();
                    }
                }
                // EXECUTE THE INSERTION IF THERES NO USERNAME IN DATABASE
            } else {
                // STATEMENT 1
                $firstname = $_POST['firstname'];
                $middlename = $_POST['middlename'];
                $lastname = $_POST['lastname'];

                // STATEMENT 2
                $contactnumber = $_POST['contactnumber'];
                $contactemail = $_POST['contactemail'];

                // STATEMENT 3
                $username = $_POST['username'];
                $pass = $_POST['pass'];

                if ($stmt1->execute()) {

                    $teacherid = $pdo->lastInsertId();
                    $stmt2->execute();
                    $stmt3->execute();
                }
                echo "Registeration Successfully";
               
            }
        } else {
            echo "Password does not match!";
        }
    }

    ?>

    <!-- FOOTER -->
    <?php
    include('footer.php');
    ?>
              

               
</body>

</html>