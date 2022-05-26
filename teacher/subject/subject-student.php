<?php
session_start();
include('../../database-connection/pdo.php');
include('../../navbar-homepage.php');
include('../../include-link.html');


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
    <script type="text/javascript" src="../../bootstrap-framework/bootstrap.min.js"></script>
    <title>Course Students</title>
    <style>
        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            color: inherit;
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
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#studentsList" type="button" role="tab">Students List</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#grading" type="button" role="tab">Grading</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#attendance" type="button" role="tab">Attendance</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <!-- STUDENT LIST TAB TABULAR -->
                        <div class="tab-pane fade show mt-3 active" id="studentsList" role="tabpanel">
                            <!-- DISPLAYING DATA IN TABLE -->
                            <table class="table table-striped table-hover shadow table-bordered text-center">
                                <thead class="bg-secondary text-white text-center">
                                    <tr>
                                        <th>Student ID</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Gender</th>
                                        <th>Course</th>
                                        <th>Actions</th>
                                        </tr>
                                </thead>
                                <!-- DISPLAY DATA IN TABLE -->
                            </table>

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