<!-- INSERTING DATA TO DATABASE -->
<?php

if (!empty($_POST['coursename']) && !empty($_POST['coursecode']) && !empty($_POST['coursetime'])) {

    $coursename = $_POST['coursename'];
    $coursecode = $_POST['coursecode'];
    $coursetime = $_POST['coursetime'];
    $teacherid = $_SESSION['ID'];

    $stmt = $pdo->prepare("INSERT INTO course (course_name, course_code, course_time, teacher_id)
VALUES (:coursename, :coursecode, :coursetime, :teacherid)");

    $stmt->bindParam(':coursename', $coursename);
    $stmt->bindParam(':coursecode', $coursecode);
    $stmt->bindParam(':coursetime', $coursetime);
    $stmt->bindParam(':teacherid', $teacherid);

    $stmt1 = "SELECT course_code FROM course";
    $result = $pdo->query($stmt1);

    if ($result->rowCount() > 0) {

        $isExist = false;

        foreach ($result as $data) {
            if ($data['course_code'] == $_POST['coursecode']) {
                $isExist = true;
                break;
            }
        }

        if ($isExist == false) {
            if ($stmt->execute()) {
            ?>
                <script>
                    window.location.href = "courses.php?page=<?= $_GET['page'] ?>";
                </script>
            <?php
            }
        }
    } else {
        if ($stmt->execute()) {
        ?>
            <script>
                window.location.href = "courses.php?page=<?= $_GET['page'] ?>";
            </script>
        <?php
        }
    }
}
?>

<!-- ************************************************************************************************************** -->


<!-- PAGINATION FUNCTION -->
<?php 
   $teacherid = $_SESSION['ID'];

    // FOR PAGINATION
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $perPage = isset($_GET['per-page']) && $_GET['per-page'] == 5 ? (int) $_GET['per-page'] : 6;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
    $total = $pdo->query("SELECT * FROM course WHERE teacher_id='$teacherid'");
    $pages = ceil($total->rowCount() / $perPage);

?>

<!-- ************************************************************************************************************** -->


<!-- EDIT AND DELETE FUNCTION -->
<?php
    if (isset($_GET['edit'])) {
    $courseid = $_GET['edit'];

    $stmt = "SELECT * FROM course WHERE course_id='$courseid'";

    if ($result = $pdo->query($stmt)) {

    foreach ($result as $data) {

    ?>
    <!-- THIS WILL CALL THE MODAL OF EDIT BUTTON -->
    <script type="text/javascript">
        window.onload = function() {
        OpenBootstrapPopup();
        };

        function OpenBootstrapPopup() {
        $("#edit").modal('show');
        }
    </script>

    <!-- EDIT BUTTON MODAL -->
    <div class="modal fade border-bottom-danger" id="edit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">

                <!-- MODAL HEADER -->
                <div class="modal-header text-center ">
                <h2 class="modal-title m-auto">EDIT COURSE</h2>
                </div>

                <!-- MODAL FORM -->
                <div class="modal-body">
                    <!-- CREATING FORM INSIDE THE MODAL -->
                    <form action="" method="post" id="myForm">
                        <input type="text" class="form-control-lg form-control mt-2" name="coursenameEdit" placeholder="Course Name" value="<?php echo $data['course_name']; ?>" autocomplete="off">
                        <input type="text" class="form-control-lg form-control mt-3" name="coursecodeEdit" placeholder="Course Code" value="<?php echo $data['course_code']; ?>" autocomplete="off">
                        <input type="time" class="form-control-lg form-control mt-3" name="coursetimeEdit" placeholder="Time" value="<?php echo $data['course_time']; ?>" autocomplete="off">
                        <!-- MODAL BUTTONS -->
                        <div class="modal-footer mt-4">
                            <button type="submit" class="btn btn-outline-primary" name="submit">Save</button>
                            <button type="button" class="btn btn-outline-danger" onclick="myFunction()" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                    <!-- JAVASCRIPT TO RESET ALL THE FIELDS IN MODAL -->
                    <script>
                        function myFunction() {
                            document.getElementById("myForm").reset();
                                window.location.href = "courses.php?page=<?= $_GET['page'] ?>";
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <!--END OF MODAL -->

    <!-- INSERT DATA THAT HAS BEEN EDITED FROM MODAL -->
    <?php   

        if(isset($_POST['submit'])){

            $coursenameEdit = $_POST['coursenameEdit'];
            $coursecodeEdit = $_POST['coursecodeEdit'];
            $coursetimeEdit = $_POST['coursetimeEdit'];
        
            $sql = "UPDATE course SET course_name='$coursenameEdit', course_code='$coursecodeEdit',
            course_time='$coursetimeEdit' WHERE course_id='$courseid'";
            $stmt4 = $pdo->prepare($sql);
            if($stmt4->execute()){

                ?>
                    <script> window.location.href = "courses.php?page=<?= $_GET['page'] ?>";</script>
                <?php
            }
        }

    ?>

    <?php

        }
    }

} //END OF EDIT FUNCTION

// DELETE FUNCTION
if(isset($_GET['delete'])){

    $courseid = $_GET['delete'];
    $stmt5 = "DELETE FROM course WHERE course_id=$courseid";

    ?>

        <!-- THIS WILL CALL THE MODAL OF EDIT BUTTON -->
        <script type="text/javascript">
            window.onload = function() {
                OpenBootstrapPopup();
            };

            function OpenBootstrapPopup() {
            $("#delete").modal('show');
            }
        </script>
            <!-- EDIT BUTTON MODAL -->
        <div class="modal fade border-bottom-danger" id="delete">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">

                    <!-- MODAL FORM -->
                    <div class="modal-body">
                        <!-- CREATING FORM INSIDE THE MODAL -->
                        <form action="" method="post">
                            <h4 class="text-center">Are you sure you want to delete this course?</h4>
                            <!-- MODAL BUTTONS -->
                            <div class="modal-footer mt-4 d-flex justify-content-center">
                                <button type="submit" class="btn btn-outline-primary" name="confirm">Confirm</button>
                                <button type="button" class="btn btn-outline-danger" onclick="myFunction()" data-bs-dismiss="modal">Cancel</button>
                            </div>
                         </form>
                        <!-- JAVASCRIPT TO RESET TO URL BACK TO COURSES PAGE -->
                        <script>
                            function myFunction() {
                                document.getElementById("myForm").reset();
                                 // window.location.href = "courses.php";
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
            <!--END OF MODAL -->

        <?php 
            if(isset($_POST['confirm'])){
                $pdo->exec($stmt5);

                ?>
                    <script> window.location.href = "courses.php?page=<?= $_GET['page'] ?>";</script>
                <?php
            }
                                                            
        ?>
    <?php

} //END OF DELETE FUNCTION
?>

<!-- ************************************************************************************************************** -->
