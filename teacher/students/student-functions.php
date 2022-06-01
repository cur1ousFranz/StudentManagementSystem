<?php

    /******************* INSERTING STUDENT INTO DATABASE ************************ */
    function insertStudent(){

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
        
            $stmt = $GLOBALS['pdo']->prepare("INSERT INTO student (student_no, first_name, middle_name, 
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
            $result = $GLOBALS['pdo']->query($stmt1);
        
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

    }


/***************** DISPLAYING STUDENT TO STUDENT TABLE *********************************** */

    function displayStudents(){
        
        $teacherid = $_SESSION['ID'];
        $pgnObj  = new Pagination($teacherid);
        $queryStudents = "SELECT * FROM student LIMIT {$pgnObj->start()}, {$pgnObj->perPage()}";
        $queryStudentsResult = $GLOBALS['pdo']->query($queryStudents);

        if($queryStudentsResult->rowCount() > 0 ){
            foreach($queryStudentsResult as $data){
            
            ?> 
                <tr>
                    <td><?php echo $data['student_no']?></td>
                    <td><?php echo $data['first_name']?></td>
                    <td><?php echo $data['middle_name']?></td>
                    <td><?php echo $data['last_name']?></td>
                    <td><?php echo $data['age']?></td>
                    <td><?php echo $data['gender']?></td>
                    <td><?php echo $data['subjects']?></td>
                    <!-- FETCHING COURSE FROM SUBJECT TABLE BASED ON COURSE_ID -->
                    <td><?php echo courseName($data['course_id']); ?></td>
                    <td><?php echo $data['nationality']?></td>
                    <td>
                        <div class="d-flex justify-content-center">    
                            <form method="get">
                                <a href="" class='btn btn-outline-success' title='Edit'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z' />
                                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z' />
                                    </svg>
                                </a>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php

            }
        } else {
            ?> 
            <tr>
                <td colspan="10">
                    No data to show
                </td>
            </tr>
            <?php
        }

    }

/**************** FUNCTION THAT SELECTS ALL THE COURSES ********************************   */

    function selectCourses(){
        
        $courseQuery = "SELECT * FROM courses";
        $courseQueryResult = $GLOBALS['pdo']->query($courseQuery); 
        foreach($courseQueryResult as $data){
            
            ?> 
             <option value="<?php echo $data['course_id'] ?>"> <?php echo $data['course_name'] ?> </option>
            <?php
        }
    }




?>

