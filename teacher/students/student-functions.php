<!-- INSERTING DATA TO DATABASE -->
<?php

if (!empty($_POST['studentno']) && !empty($_POST['firstname']) && !empty($_POST['middlename'])
&& !empty($_POST['lastname']) && !empty($_POST['age']) && !empty($_POST['gender'])
&& !empty($_POST['course']) && !empty($_POST['nationality'])) {
    

    $studentno = $_POST['studentno'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $courseid = $_POST['course'];
    $nationality = $_POST['nationality'];
    $subjects = 0;
    $teacherid = $_SESSION['ID'];

    $stmt = $pdo->prepare("INSERT INTO student (student_no, first_name, middle_name, 
    last_name, age, gender, nationality, subjects, course_id)
    VALUES (:studentno, :firstname, :middlename, :lastname, :age, :gender, 
    :nationality, :subjects, :courseid)");

    $stmt->bindParam(':studentno', $studentno);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':middlename', $middlename);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':courseid', $courseid);
    $stmt->bindParam(':nationality', $nationality);
    $stmt->bindParam(':subjects', $subjects);

    $stmt1 = "SELECT student_no FROM student";
    $result = $pdo->query($stmt1);

    if ($result->rowCount() > 0) {

        $isExist = false;

        foreach ($result as $data) {
            if ($data['student_no'] == $_POST['studentno']) {
                $isExist = true;
                break;
            }
        }

        if ($isExist == false) {
            if ($stmt->execute()) {
            ?>
                <script>
                    window.location.href = "student.php";
                </script>
            <?php
            }
        }
    } else {
        if ($stmt->execute()) {
        ?>
            <script>
                window.location.href = "student.php";
            </script>
        <?php
        }
    }
}


?>

<!-- FOR PAGINATION************************************************************************** -->

<?php 

    // FOR PAGINATION
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $perPage = isset($_GET['per-page']) && $_GET['per-page'] == 5 ? (int) $_GET['per-page'] : 6;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
    $total = $pdo->query("SELECT * FROM student");
    $pages = ceil($total->rowCount() / $perPage);

?>

<!--  -->
