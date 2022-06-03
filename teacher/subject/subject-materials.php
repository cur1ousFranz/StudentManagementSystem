<?php
session_start();
include('../../database-connection/pdo.php');
include('../../navbar-homepage.php');
include('../../include-link.html');
include('subject-material-functions.php');


if (isset($_SESSION['ID'])) {
} else {
    header('Location: login.php');
}

    insertFile();

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
                    
                        $teacherMaterialArray = teacherMaterial();
                        $materialIconsArray = materialIcon();
                        $subjectFuncArray = subjectFunc();
                    ?>
                    <h6><?php echo $subjectFuncArray['subject_name'];?></h6>
                    <img class="" src="data:image/jpng;charset=utf8;base64,<?php echo base64_encode($materialIconsArray['image']); ?>" style="width: 30px;"/>
                    &nbsp;<a><strong><?php echo strtoupper($teacherMaterialArray['material_name'])?></strong></a>
                </div>
                <hr>
                <div class="row">
                    <div class="col-10">
                        <ul class="list-group list-group-flush">
                            <?php displayPdfFile();?>
                        </ul>
                    </div>
                    <div class="col-2">
                        <div class="container">
                            <button class="btn float-end" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                    <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707V11.5z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                </svg>
                            </button>

                            <button class="btn float-end" data-bs-toggle="modal" data-bs-target="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
                                    <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                                    <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </button>

                            <!--  MODAL -->
                            <div class="modal fade" id="uploadModal">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content ">

                                        <!-- MODAL HEADER -->
                                        <div class="modal-header text-center ">
                                            <h4 class="modal-title">Upload File</h4>
                                        </div>

                                        <!-- MODAL FORM -->
                                        <div class="modal-body">
                                            <!-- CREATING FORM INSIDE THE MODAL -->
                                            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                                                <div class="form-floating">
                                                    <input id="filename" type="text" class="form-control-lg form-control mt-2" placeholder="File name" name="filename" autocomplete="off" maxlength="50" required>
                                                    <label for="filename">File name</label>
                                                </div>
                                                <input type="file" name="file" class="form-control mt-3" >
                                                <div class="modal-footer mt-4 justify-content-center">
                                                    <button type="submit" class="btn btn-outline-primary w-25" name="fileSubmit">Confirm</button>
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
                    </div>
                </div>

                
        </div>
    </div>



</body>
</html>