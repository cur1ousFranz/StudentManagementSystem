<?php
session_start();
include('../../database-connection/pdo.php');
include('../../navbar-homepage.php');
include('../../include-link.html');
include('student-functions.php');
include('../subject/subject-functions.php');

    if (isset($_SESSION['ID'])) {
    } else {
        header('Location: login.php');
    }

    $teacherid = $_SESSION['ID'];
    $pgnObj = new Pagination($teacherid);
    insertStudent();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <div class="col-3 border w-25 h-100 sticky-top border-bottom-0 border-top-0 mt-5">
                <nav>
                    <div class="position-sticky">
                        <div class="list-group list-group-flush mt-4">
                            <a href="../../homepage.php" class="list-group-item" style="font-size: 20px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                </svg>&nbsp;Dashboard
                            </a>
                            <a href="../../teacher/subject/subject.php?page=1" class="list-group-item" style="font-size: 20px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                </svg>&nbsp;Subject
                            </a>
                            <a class="list-group-item active" style="font-size: 20px;" data-bs-toggle="tab">
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

            <!-- TABLE VIEW -->
            <div class="col-9 border w-80 border-0">
                <div class="container bg- mt-5"> <!-- TABLE CONTAINER -->
                    <div class="container mt-5 pb-2 d-flex justify-content-between">
                        <h3>Students</h3>
                        <button class="btn btn-sm btn-primary shadow" data-bs-toggle="modal" data-bs-target="#myModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
                            </svg>&nbsp;Student
                        </button>
                        <!--  MODAL -->
                        <div class="modal fade border-bottom-danger" id="myModal">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content ">

                                    <!-- MODAL HEADER -->
                                    <div class="modal-header text-center ">
                                        <h2 class="modal-title m-auto">REGISTER STUDENT</h2>
                                    </div>

                                    <!-- MODAL FORM -->
                                    <div class="modal-body">
                                        <!-- CREATING FORM INSIDE THE MODAL -->
                                        <form action="" method="post" id="myForm">
                                            <div class="row">
                                                <div class="form-floating col-6">
                                                    <input id="studentno" type="text" class=" form-control mt-2" placeholder="Student No." name="studentno" autocomplete="off" maxlength="20" required>
                                                    <label for="studentno">&nbsp;&nbsp;Student ID No.</label>
                                                </div>
                                                <div class="form-floating col-6">
                                                    <input id="firstname" type="text" class=" form-control mt-2" placeholder="First name" name="firstname" autocomplete="off" maxlength="20" required>
                                                    <label for="firstname">&nbsp;&nbsp;First Name</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-floating col-6">
                                                    <input id="middlename" type="text" class=" form-control mt-2" placeholder="Middle Name" name="middlename" autocomplete="off" maxlength="20" required>
                                                    <label for="middlename">&nbsp;&nbsp;Middle Name</label>
                                                </div>
                                                <div class="form-floating col-6">
                                                    <input id="lastname" type="text" class=" form-control mt-2" placeholder="Last name" name="lastname" autocomplete="off" maxlength="20" required>
                                                    <label for="lastname">&nbsp;&nbsp;Last Name</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-floating col-6">
                                                    <input id="age" type="number" class=" form-control mt-2" placeholder="Age" name="age" autocomplete="off" min="15" maxlength="2" required>
                                                    <label for="age">&nbsp;&nbsp;Age</label>
                                                </div>
                                                <div class="form-floating col-6 mt-2">
                                                    <select class="form-select" id="gender" name="gender" required>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                    <label for="gender">&nbsp;&nbsp;Gender</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 mt-2" >
                                                    <select class="form-select text" id="course" name="course" size="3" required style="font-size: 14px">
                                                        <?php selectCourses(); ?>
                                                    </select>
                                                </div>

                                                <div class="form-floating col-6 mt-2">
                                                    <select class="form-select" id="nationality" name="nationality"
                                                    required>
                                                        <option value="Filipino">Filipino</option>
                                                    </select>
                                                    <label for="filipino">&nbsp;&nbsp;Nationality</label>
                                                </div>
                                            </div>

                                            <!-- MODAL BUTTONS -->
                                            <div class="modal-footer mt-4 justify-content-center">
                                                <button type="submit" class="btn btn-outline-primary w-25" name="submit">Register</button>
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
                    <!-- DISPLAYING DATA IN TABLE -->
                        <table class="table table-striped table-hover shadow table-bordered text-center">
                            <thead class="bg-secondary text-white text-center">
                                <tr>
                                    <th>Student ID</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Subjects</th>
                                    <th>Course</th>
                                    <th>Nationality</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <?php displayStudents()?>
                        </table>
                </div>
                <!-- PAGINATION -->
                <div class="container-fluid d-flex justify-content-end">
                    <nav aria-label="...">
                        <ul class="pagination shadow">
                            <li class="page-item <?php if($pgnObj->page() == 1){ echo 'disabled';} else {echo '';}?>">
                                <a href="?page=<?php echo $pgnObj->page()  - 1;?>" class="page-link">Previous</a>
                            </li>
                            <?php for($i = 1; $i <= $pgnObj->pages(); $i++):?>
                            <li class="page-item <?php if($pgnObj->page() == $i) { echo 'active'; } ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i?></a>
                            </li>
                            <?php  endfor;?>
                            <li class="page-item <?php if($pgnObj->page() == $pgnObj->pages()){ echo 'disabled';} else {echo '';} if( $pgnObj->pages() == 0){ echo 'disabled';}?>">
                                <a href="?page=<?php echo $pgnObj->page()  + 1;?>" class="page-link" class="page-link">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
        <!-- FOOTER SECTION -->
        <div class="container-fluid mt-5">
        <?php include('../../footer.php');?>
    </div>

    
</body>

</html>