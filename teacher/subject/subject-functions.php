<?php
    /**************** INSERT SUBJECT CREATED  ******************************** */

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

     /******************************* CLASS OF PAGINATION  *************************************** */

    class Pagination { 

        private $teacherid;

        function __construct($teacherid) {
            $this->teacherid = $teacherid;
          }
        
        public function page(){
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            return $page;
        }

        function perPage(){
            $perPage = isset($_GET['per-page']) && $_GET['per-page'] == 5 ? (int) $_GET['per-page'] : 6;
            return $perPage;
        }

        function start(){
            $start = ($this->page() > 1) ? ($this->page() * $this->perPage()) - $this->perPage() : 0;
            return $start;
        }

        function total(){
            $total = $GLOBALS['pdo']->query("SELECT * FROM subject WHERE teacher_id='$this->teacherid'");
            return $total;
        }

        function pages(){
            $pages = ceil($this->total()->rowCount() / $this->perPage());
            return $pages;
        }

    }

     /******************************* CLASS OF DISPLAYING SUBJECTS *************************************** */

    class Subject extends Pagination {

        private $teacherid;

        function __construct($teacherid) {
            $this->teacherid = $teacherid;
          }

        function displaySubjects(){

            $querySubjects = "SELECT * FROM subject WHERE teacher_id='$this->teacherid' LIMIT {$this->start()}, {$this->perPage()}";
            $querySubjectsResult = $GLOBALS['pdo']->query($querySubjects);

            if ($querySubjectsResult->rowCount() > 0) {

                foreach ($querySubjectsResult as $data): 
            ?>
                <tr class="text-center">
                    <td><?php echo $data['subject_name']; ?></td>
                    <td><?php echo $data['subject_code']; ?></td>
                    <td><?php echo $data['start_time']; ?></td>
                    <td><?php echo $data['end_time']; ?></td>
                    <td><?php echo $data['sync_date']; ?></td>
                    <td><a href="subject-student.php?subject_id=<?= $data['subject_id'] ?>&page=<?= $_GET['page']?>" class="text-primary">View</a></td>
                    <td>
                        <div class="d-flex justify-content-center">    
                            <form method="get">
                                <a href="?edit=<?= $data['subject_id'] ?>&page=<?= $_GET['page']?>" class='btn btn-outline-success' title='Edit Subject'>
                                     <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z' />
                                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z' />
                                    </svg>
                                </a>

                                <a href="?delete=<?= $data['subject_id']?>&page=<?=$_GET['page']?>" class='btn btn-outline-danger' title='Delete Subject'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
                                        <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z' />
                                    </svg>
                                </a>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach;
                
            } else {

                ?>
                    <tr class="text-center">
                        <td colspan="7">
                            No data to show
                        </td>
                    </tr>
                <?php
                
            }

        }

    }

     /******************************* FUNCTION OF EDIT SUBJECT BUTTON *************************************** */

    function editSubject(){
        
        if (isset($_GET['edit'])) {
            $subjectid = $_GET['edit'];
        
            $stmt2 = "SELECT * FROM subject WHERE subject_id='$subjectid'";
        
            if ($result = $GLOBALS['pdo']->query($stmt2)) {
        
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
                                <input type="text" class="form-control-lg form-control mt-2" name="subjectnameEdit" placeholder="Subject Name" value="<?php echo $data['subject_name']; ?>" autocomplete="off">
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
                    $stmt4 = $GLOBALS['pdo']->prepare($sql);
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
        
        } 
    }    

    /******************************* FUNCTION OF DELETE SUBJECT BUTTON *************************************** */

    function deleteSubject(){

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
                        $GLOBALS['pdo']->exec($stmt5);
                        ?>
                            <script> window.location.href = "subject.php?page=<?= $_GET['page'] ?>";</script>
                        <?php
                    }
                                                                    
                ?>
            <?php
        
        } //END OF DELETE FUNCTION
    }

    /******************************* CREATING SELECT QUERY OF SUBJECT TABLE  *************************************** */

    function subjectQuery(){

        $arr = array();
        if(isset($_GET['subject_id'])){

            $subjectid = $_GET['subject_id'];
            $stmt = "SELECT * FROM subject WHERE subject_id='$subjectid'";
            $result = $GLOBALS['pdo']->query($stmt);

            foreach($result as $data){
                $arr['subject_name'] = $data['subject_name'];
                $arr['start_time'] = $data['start_time'];
                $arr['end_time'] = $data['end_time'];
                $arr['sync_date'] = $data['sync_date'];
            }
        }
        return $arr;
    }

    /********** FUNCTION THAT DISPLAYS ALL THE MATERIAL OF PARTICULAR SUBEJECT  ************* */

    function teacherMaterial(){

        $teacherid = $_SESSION['ID'];
        $subjectid = $_GET['subject_id'];

        $queryTeacherMaterial = "SELECT * FROM teacher_materials 
        WHERE teacher_id='$teacherid' AND subject_id='$subjectid'";

        $queryTeacherMaterialResult = $GLOBALS['pdo']->query($queryTeacherMaterial);
            
        if($queryTeacherMaterialResult->rowCount() > 0){
    
            foreach($queryTeacherMaterialResult as $temp){
        
                $iconID = $temp['material_icons_id'];
                $queryMaterialIcons = "SELECT * FROM material_icons WHERE material_icons_id='$iconID'";
                $queryMaterialIconsResult = $GLOBALS['pdo']->query($queryMaterialIcons);

                foreach($queryMaterialIconsResult as $temp2){
                    ?>
                        <div class="container mt-3">
                            <img class="" src="data:image/jpng;charset=utf8;base64,<?php echo base64_encode($temp2['image']); ?>" style="width: 30px;"/>
                            &nbsp;&nbsp;<a href="subject-materials.php?subject_id=<?= $_GET['subject_id'] ?>&material_id=<?= $temp['material_id']?>" class="link-secondary text-decoration-underline"><?php echo strtoupper($temp['material_name']) ?></a>
                        </div>
                    <?php
                }
            }

         } else {
             ?>
                 <div class="container text-secondary">
                    <h6>No files to show</h6>
                </div>
            <?php
        }

    }

    /********** FUNCTION FOR DISPLAYING MATERIAL ICONS IN MODAL ************* */

    function materialIconInModal(){

        $imgQuery = "SELECT * FROM material_icons";
        $imgQueryResult = $GLOBALS['pdo']->query($imgQuery);
        foreach($imgQueryResult as $iconData){

        ?>
        <div class="form-check">
            <input type="radio" class="form-check-input" id="radio1" name="iconradio" value="<?php echo $iconData['material_icons_id']?>" checked>
            <label class="form-check-label" for="radio1">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($iconData['image']); ?>" style="width: 30px;"/>
            </label>
        </div>
            
        <?php
        }
    }

    /********************* FUNCTION OF FETCHING COURSES ************************ */

    function courseName($courseid){

        $getCourseName = array();
        $courseNameQuery = "SELECT course_acronym FROM courses WHERE course_id='$courseid'";
        $courseNameQueryResult = $GLOBALS['pdo']->query($courseNameQuery);

        foreach($courseNameQueryResult as $data){
            $getCourseName = $data['course_acronym'];
        }

        return $getCourseName;
    }

    /************* FUNCTION TO SELECT ALL THE LIST OF STUDENTS ***************** */

    function listOfStudents(){

        $stmt1 = "SELECT * FROM student";
        $result1 = $GLOBALS['pdo']->query($stmt1);

        foreach($result1 as $data){
        ?>
            <tr>
                <td><input type="checkbox" name="studs[]" value="<?php echo $data['stud_id']?>"></td>
                <td><?php echo $data['student_no']?></td>
                <td><?php echo $data['first_name']?></td>
                <td><?php echo $data['middle_name']?></td>
                <td><?php echo $data['last_name']?></td>
                <td><?php echo $data['age']?></td>
                <td><?php echo $data['gender']?></td>
                <!-- FETCHING COURSE FROM COURSE TABLE BASED ON COURSE_ID -->
                <td><?php echo courseName($data['course_id']); ?></td>
            </tr>
        <?php
   
        }
    }

    /**************** SUBJECT STUDENT FUNCTION OF CHECKBOXES MODAL ***************** */

    function addMembers(){

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
    }

    /*********** CREATE FUNCTION THAT FETCH ALL MEMBERS IN PARTICULAR SUBJECTL ************** */

    function subjectMembers($subjectID){
        
        $innerQuery = "SELECT student.first_name, student.last_name 
        FROM student 
        INNER JOIN subject_members
        ON student.stud_id  = subject_members.stud_id
        WHERE subject_members.subject_id = '$subjectID'";

        $innerQueryResult = $GLOBALS['pdo']->query($innerQuery);
        
        foreach($innerQueryResult as $data){
            echo "<li class='list-group mt-2'>".$data['last_name'] . ", " . $data['first_name'].'</li>';
        }
    }

    /*********** FUNTION THAT COUNTS THE MEMBERS IN PARTICULAR SUBJECT ************** */

    function countMembers($subjectID){
        
        $countMembers = "SELECT * FROM subject_members WHERE subject_id='$subjectID'";
        $countMembersResult = $GLOBALS['pdo']->query($countMembers);

        return $countMembersResult->rowCount();
    }

    /*********** INSERT CREATED MATERIAL OF PARTICULAR SUBJECT ******************** */

    function insertMaterial(){

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
    }

?>



