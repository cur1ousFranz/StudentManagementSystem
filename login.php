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
            <p>Want to create account as a teacher? <u class="text-primary">Contact us</u></p>
        </div>
    </div>

    <?php

        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $pass = $_POST['pass'];

            $queryLogin = "SELECT * FROM log_in WHERE username='$username' AND pass='$pass'";
            $queryLoginResult = $GLOBALS['pdo']->query($queryLogin);

            

            if($queryLoginResult->rowCount() == 1){
                echo $queryLoginResult->rowCount();
                
                foreach($queryLoginResult as $data){

                    if($data['role'] == "teacher"){
                        $loginID = $data['log_in_id'];

                        $queryTeacher = "SELECT teacher_id FROM teacher WHERE log_in_id='$loginID'";
                        $queryTeacherResult = $GLOBALS['pdo']->query($queryTeacher);

                        foreach($queryTeacherResult as $data2){
                            $_SESSION['ID'] = $data2['teacher_id'];
                            header('Location: homepage.php');
                        }
                        
                    }

                    if($data['role'] == "student"){
                        $loginID = $data['log_in_id'];
                        $queryStudent = "SELECT student_no FROM student WHERE log_in_id='$loginID'";
                        $queryStudentResult = $GLOBALS['pdo']->query($queryStudent);

                        foreach($queryStudentResult as $data2){
                            $_SESSION['ID'] = $data2['stud_id'];
                            header('Location: student/student-hmpg.php');
                        }
                    }
                }
                
            }else{
                echo "No such account";
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