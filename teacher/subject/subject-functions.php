<!-- INSERTING DATA TO DATABASE -->
<?php

    if (!empty($_POST['subjectname']) && !empty($_POST['subjectcode']) 
    && !empty($_POST['starttime']) && !empty($_POST['endtime']) && !empty($_POST['sync'])) {

    $subjectname = $_POST['subjectname'];
    $subjectcode = $_POST['subjectcode'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];
    $sync = $_POST['sync'];
    $teacherid = $_SESSION['ID'];

    $stmt = $pdo->prepare("INSERT INTO subject (subject_name, subject_code, start_time, end_time, sync_date, teacher_id)
    VALUES (:subjectname, :subjectcode, :starttime, :endtime, :sync, :teacherid)");

    $stmt->bindParam(':subjectname', $subjectname);
    $stmt->bindParam(':subjectcode', $subjectcode);
    $stmt->bindParam(':starttime', $starttime);
    $stmt->bindParam(':endtime', $endtime);
    $stmt->bindParam(':sync', $sync);
    $stmt->bindParam(':teacherid', $teacherid);

        if ($stmt->execute()) {
            ?>
                <script>
                    window.location.href = "subject.php?page=<?= $_GET['page'] ?>";
                </script>
            <?php
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
    $total = $pdo->query("SELECT * FROM subject WHERE teacher_id='$teacherid'");
    $pages = ceil($total->rowCount() / $perPage);

?>

<!-- ************************************************************************************************************** -->


<!-- EDIT AND DELETE FUNCTION OF SUBJECT-->
<?php
    if (isset($_GET['edit'])) {
    $subjectid = $_GET['edit'];

    $stmt = "SELECT * FROM subject WHERE subject_id='$subjectid'";

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
                <h2 class="modal-title m-auto">EDIT SUBJECT</h2>
                </div>

                <!-- MODAL FORM -->
                <div class="modal-body">
                    <!-- CREATING FORM INSIDE THE MODAL -->
                    <form action="" method="post" id="myForm">
                        <input type="text" class="form-control-lg form-control mt-2" name="subjectameEdit" placeholder="Subject Name" value="<?php echo $data['subject_name']; ?>" autocomplete="off">
                        <input type="text" class="form-control-lg form-control mt-3" name="subjectcodeEdit" placeholder="Subject Code" value="<?php echo $data['subject_code']; ?>" autocomplete="off">
                        <input type="time" class="form-control-lg form-control mt-3" name="starttimeEdit" placeholder="Start Time" value="<?php echo $data['start_time']; ?>" autocomplete="off">
                        <input type="time" class="form-control-lg form-control mt-3" name="endtimeEdit" placeholder="End Time" value="<?php echo $data['end_time']; ?>" autocomplete="off">
                        <div>
                            <select class="form-select form-control-lg mt-3" id="async" name="syncEdit" required>
                                <option value="MTWTHF">Mon-Tue-Wed-Thur-Fri</option>
                                <option value="MTW">Mon-Tue-Wed</option>
                            </select>
                        </div>
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
                                window.location.href = "subject.php?page=<?= $_GET['page'] ?>";
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

            $subjectnameEdit = $_POST['subjectnameEdit'];
            $subjectcodeEdit = $_POST['subjectcodeEdit'];
            $starttimeEdit = $_POST['starttimeEdit'];
            $endtimeEdit = $_POST['endtimeEdit'];
            $syncEdit = $_POST['syncEdit'];
        
            $sql = "UPDATE subject SET subject_name='$subjectnameEdit', subject_code='$subjectcodeEdit',
            start_time='$starttimeEdit', end_time='$endtimeEdit', sync_date='$syncEdit' WHERE subject_id='$subjectid'";
            $stmt4 = $pdo->prepare($sql);
            if($stmt4->execute()){

                ?>
                    <script> window.location.href = "subject.php?page=<?= $_GET['page'] ?>";</script>
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

    $subjectDeleteID = $_GET['delete'];
    $stmt5 = "DELETE FROM subject WHERE subject_id=$subjectDeleteID";

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
                            <h4 class="text-center">Are you sure you want to delete this subject?</h4>
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
                    <script> window.location.href = "subject.php?page=<?= $_GET['page'] ?>";</script>
                <?php
            }
                                                            
        ?>
    <?php

} //END OF DELETE FUNCTION
?>

<!-- ***** SUBJECT STUDENT FUNCTION OF CHECKBOXES MODAL**************************************************** -->

<?php 

    if(isset($_POST['submit'])){
        if(!empty($_POST['studs'])){
            $subjectID = $_GET['subject_id'];

            $checkQuery = "SELECT * FROM subject_members WHERE subject_id='$subjectID'";
            $checkQueryResult = $GLOBALS['pdo']->query($checkQuery);

            foreach($_POST['studs'] as $studID){
               
                $studQuery = $GLOBALS['pdo']->prepare("INSERT INTO subject_members(subject_id, stud_id)
                VALUES ($subjectID, $studID)"); 

                // THIS IS FOR COUNTING THE ENROLLED SUBJECTS OF STUDENT
                $countSubjectQuery = "SELECT *
                                    FROM subject_members
                                    WHERE stud_id='$studID'";
                $countSubjectQueryResult = $GLOBALS['pdo']->query($countSubjectQuery);
                $count = $countSubjectQueryResult->rowCount() + 1;
                
                // UPDATING THE SUBJECT COUNT THAT WILL REFLECT TO TABLE
                $updateCountSubject = "UPDATE student
                                    SET subjects='$count'
                                    WHERE stud_id='$studID'";
                $updateCountSubjectResult = $GLOBALS['pdo']->prepare($updateCountSubject);

                if($checkQueryResult->rowCount() > 0){
                    $isExist = false;
                    foreach($checkQueryResult as $temp) {

                        if($temp['stud_id'] == $studID){
                            $isExist = true;
                            break;
                        }
                    }

                    if($isExist == false ){
                        
                        if($studQuery->execute()){
                            $updateCountSubjectResult->execute();
                        }
                        
                    }

                }else{

                    if($studQuery->execute()){
                        $updateCountSubjectResult->execute();
                    }
                }
            }
        }
    }

?>

<!-- ******* CREATE FUNCTION THAT FETCH ALL MEMBERS IN PARTICULAR SUBJECT************************************************** -->

<?php 

    function subjectMembers($subjectID){
        
        $subjectMember = array();
        $innerQuery = "SELECT student.first_name, student.last_name 
        FROM student 
        INNER JOIN subject_members
        ON student.stud_id  = subject_members.stud_id
        WHERE subject_members.subject_id = '$subjectID'";

        $innerQueryResult = $GLOBALS['pdo']->query($innerQuery);
        
        foreach($innerQueryResult as $data){
            echo "<li class='list-group mt-2'>".$data['last_name'] . ", " . $data['first_name'].'</li>';
        }
        return $subjectMember;
    }
    
?>

<!-- FUNTION THAT COUNTS THE MEMBERS IN PARTICULAR SUBJECT -->

<?php 

    function countMembers($subjectID){
        
        $countMembers = "SELECT * FROM subject_members WHERE subject_id='$subjectID'";
        $countMembersResult = $GLOBALS['pdo']->query($countMembers);

        return $countMembersResult->rowCount();
    }

?>

<!-- INSERT CREATED MATERIAL TO DATABASE************************************************ -->

<?php 

    if(isset($_POST['imgSubmit'])){

        // FETCHING THE ID OF SELECTED ICON
        $materialIconsID = 0;
        if(isset( $_POST['iconradio'])){
            $materialIconsID = $_POST['iconradio'];
        }
    
        $materialName = $_POST['materialname'];
        $teacherid = $_SESSION['ID'];
        $subjectid = $_GET['subject_id'];

        $materialQuery = $GLOBALS['pdo']->prepare("INSERT INTO teacher_materials(material_name, teacher_id, subject_id, material_icons_id)
        VALUES (:materialname, :teacherid, :subjectid, :materialIconsID)");

        $materialQuery->bindParam(':materialname', $materialName);
        $materialQuery->bindParam(':teacherid', $teacherid);
        $materialQuery->bindParam(':subjectid', $subjectid);
        $materialQuery->bindParam(':materialIconsID', $materialIconsID);

        $checkIconQuery = "SELECT * FROM teacher_materials WHERE teacher_id='$teacherid' AND subject_id='$subjectid'";
        $checkIconQueryResult = $GLOBALS['pdo']->query($checkIconQuery);

        // CHECKING FOR DUPLICATION OF MATERIAL NAME
        if($checkIconQueryResult->rowCount() > 0){
            $isExist = false;
            foreach($checkIconQueryResult as $checkQuery){
            
                if($checkQuery['material_name'] == $materialName){
                    $isExist = true;
                    break;
                }
            }

            if($isExist == false){
                $materialQuery->execute();
            }
        }else{
            $materialQuery->execute();
        }
        
    }
    
?>


