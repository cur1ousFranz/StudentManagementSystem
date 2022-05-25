<!-- INSERTING DATA TO DATABASE -->
<?php

if (!empty($_POST['studentno']) && !empty($_POST['firstname']) && !empty($_POST['middlename'])
&& !empty($_POST['lastname']) && !empty($_POST['age']) && !empty($_POST['gender'])
&& !empty($_POST['civilstatus']) && !empty($_POST['nationality'])) {

    $studentno = $_POST['studentno'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $civilstatus = $_POST['civilstatus'];
    $nationality = $_POST['nationality'];
    $teacherid = $_SESSION['ID'];

    $stmt = $pdo->prepare("INSERT INTO student (student_no, first_name, middle_name, 
    last_name, age, gender, civil_status, nationality)
    VALUES (:studentno, :firstname, :middlename, :lastname, :age, :gender, 
    :civilstatus, :nationality)");

    $stmt->bindParam(':studentno', $studentno);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':middlename', $middlename);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':civilstatus', $civilstatus);
    $stmt->bindParam(':nationality', $nationality);

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