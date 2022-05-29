<?php
session_start();
include('../../database-connection/pdo.php');
include('../../navbar-homepage.php');
include('../../include-link.html');
include('../students/student-functions.php');
include('subject-functions.php');


if (isset($_SESSION['ID'])) {
} else {
    header('Location: login.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap-framework/bootstrap.min.css">
    <title>Course Students</title>
    <style>
        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            color: inherit;
        }
        .wrapper {
            max-height: 250px;
            overflow-y: scroll;
        }
        .wrapper {
            overflow-y: scroll;
            height: 500px;
        }

    </style>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">

            <!-- NAVIGATION MENU -->
            <div class="col-3 border w-25 sticky-top border-bottom-0 border-top-0 mt-5">
                <nav >
                    <div class="position-sticky">
                        <div class="list-group list-group-flush mt-4">
                            <a href="../../homepage.php" class="list-group-item" style="font-size: 20px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                </svg>&nbsp;Dashboard
                            </a>
                            <a class="list-group-item active" style="font-size: 20px;"  data-bs-toggle="tab">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                </svg>&nbsp;Subject
                            </a>
                            <a href="../../teacher/students/student.php" class="list-group-item" style="font-size: 20px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>&nbsp;Student
                            </a>
                            <a href="#" class="list-group-item" style="font-size: 20px;" data-bs-toggle="tab">About</a>
                            <a href="../../logout.php" class="list-group-item mt-4 text-danger" style="font-size: 20px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
                                    <path d="M7.5 1v7h1V1h-1z" />
                                    <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
                                </svg>&nbsp;Log out
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            
            <div class="col-9">
                <div class="container mt-5">
                    <?php 
                        if(isset($_GET['subject_id'])){
                            $subjectid = $_GET['subject_id'];
                            $stmt = "SELECT * FROM subject WHERE subject_id='$subjectid'";
                            $result = $pdo->query($stmt);

                            foreach($result as $data):
                    ?>
                    <h3><?php echo $data['subject_name'];?></h3>
                    <h6>Subject time: <?php echo $data['start_time'] . " - " .  $data['end_time'] . " " . $data['sync_date'] ?> </h6>
                    <?php endforeach;}?>
                </div>
                <div class="container">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#studentsList" type="button" role="tab">Overview</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#grading" type="button" role="tab">Grading</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#attendance" type="button" role="tab">Attendance</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <!-- OVERVIEW TAB -->
                        <div class="tab-pane fade show mt-3 active" id="studentsList" role="tabpanel">

                            <div class="row">
                                <div class="col-9">
                                    <div class="row">

                                        <div class="col-10">

                                            <?php 
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
                                                                    &nbsp;&nbsp;<a href="" class="link-secondary text-decoration-underline"><?php echo strtoupper($temp['material_name']) ?></a>
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
                                            ?>

                                        </div>

                                        <div class="col-2">
                                            <div class="container">
                                                <button class="btn btn-outline-primary float-end" data-bs-toggle="modal" data-bs-target="#materialModal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
                                                        <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                                                        <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- MATERIALS MODAL WHEN FOLDER ICON BUTTON CLICK THIS MODAL WILL TRIGGER -->
                                        <!--  MODAL -->
                                        <div class="modal fade" id="materialModal">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content ">

                                                    <!-- MODAL HEADER -->
                                                    <div class="modal-header text-center ">
                                                        <h4 class="modal-title">Create Material</h4>
                                                    </div>

                                                    <!-- MODAL FORM -->
                                                    <div class="modal-body">
                                                        <!-- CREATING FORM INSIDE THE MODAL -->
                                                        <form action="" method="post" id="myForm">
                                                            <div class="form-floating">
                                                                <input id="materialname" type="text" class="form-control-lg form-control mt-2" placeholder="File name" name="materialname" autocomplete="off" maxlength="50" required>
                                                                <label for="materialname">Material Name</label>
                                                            </div>
                                                            <h6 class="mt-2 ms-2">Choose file icon</h6>
                                                            <div class="container">
                                                            <?php

                                                                $imgQuery = "SELECT * FROM material_icons";
                                                                $imgQueryResult = $pdo->query($imgQuery);
                                                                foreach($imgQueryResult as $iconData):

                                                            ?>
                                                            <!-- RADIO BUTTONS OF ICONS -->
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input" id="radio1" name="iconradio" value="<?php echo $iconData['material_icons_id']?>" checked>
                                                                    <label class="form-check-label" for="radio1">
                                                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($iconData['image']); ?>" style="width: 30px;"/>
                                                                    </label>
                                                                </div>
                                                            <?php endforeach;?>
                                                            </div>

                                                            <div class="modal-footer mt-4 justify-content-center">
                                                                <button type="submit" class="btn btn-outline-primary w-25" name="imgSubmit">Add</button>
                                                                <button type="button" class="btn btn-outline-danger w-25" onclick="myFunction()" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                            </ul>
                                                        </form>

                                                        <!-- JAVASCRIPT TO RESET ALL THE FIELDS IN MODAL -->
                                                        <script>
                                                            function myFunction() {
                                                                document.getElementById("myForm").reset();
                                                            }
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--END OF MODAL -->
                                    </div>
                                </div>

                                <!-- SECOND COLUMN -->
                                <div class="col-3 border border-top-0 border-end-0 border-bottom-0">
                                    <div class="container d-flex justify-content-between">
                                        <h5 class="text-center mt-2"><?php echo countMembers($_GET['subject_id'])?>&nbsp;Members</h5>
                                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <hr>
                                    <ul class="list-group list-group-flush">
                                        <!-- CALLING A FUNCTION TO GENERATE MEMBERS IN SUBJECT -->
                                        <?php 
                                            $memberFullName = subjectMembers($_GET['subject_id']);
                                        ?>
                                    </ul>
                                </div>
                            </div>

                        <!--  MODAL -->
                        <div class="modal fade border-bottom-danger" id="myModal">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content ">

                                    <!-- MODAL HEADER -->
                                    <div class="modal-header text-center ">
                                        <h2 class="modal-title m-auto">List of Registered Student</h2>
                                    </div>

                                    <!-- MODAL FORM -->
                                    <div class="modal-body">
                                        <!-- CREATING FORM INSIDE THE MODAL -->
                                        <form action="" method="post" id="myForm">
                                            <div class="wrapper">
                                                <table class="table table-hover table-striped table-bordered">
                                                    <tr>
                                                        <th>All<input type="checkbox" class="d-block justify-content-center" name="selectAll"></th>
                                                        <th>Student ID</th>
                                                        <th>First Name</th>
                                                        <th>Middle Name</th>
                                                        <th>Last Name</th>
                                                        <th>Age</th>
                                                        <th>Gender</th>
                                                        <th>Course</th>
                                                    </tr>
                                                    <!-- JAVASCRIPT FUNCTION THAT SELECTS ALL BOXES -->
                                                    <script>
                                                        $(function() {
                                                            jQuery("[name=selectAll]").click(function(source) { 
                                                                checkboxes = jQuery("[name='studs[]'");
                                                                for(var i in checkboxes){
                                                                    checkboxes[i].checked = source.target.checked;
                                                                }
                                                            });
                                                        })
                                                    </script>

                                                    <?php 
                                                        $stmt1 = "SELECT * FROM student";
                                                        $result1 = $pdo->query($stmt1);

                                                        foreach($result1 as $data):
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
                                                    <?php endforeach;?>
                                                </table>
                                            </div>
                                            <div class="modal-footer mt-4 justify-content-center">
                                                <button type="submit" class="btn btn-outline-primary w-25" name="submit">Add</button>
                                                <button type="button" class="btn btn-outline-danger w-25" onclick="myFunction()" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                            
                                        </form>

                                        <!-- JAVASCRIPT TO RESET ALL THE FIELDS IN MODAL -->
                                        <script>
                                            function myFunction() {
                                                document.getElementById("myForm").reset();
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END OF MODAL -->  

                        </div>








                        <div class="tab-pane fade" id="grading" role="tabpanel">...</div>
                        <div class="tab-pane fade" id="attendance" role="tabpanel">...</div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</body>
</html>