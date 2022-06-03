<?php
session_start();
include('database-connection/pdo.php');
include('navbar-homepage.php');
include('include-link.html');
include('homepage-functions.php');

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
            <div class="col-3 border w-25 sticky-top border-bottom-0 border-top-0 mt-5">
                <nav>
                    <div class="position-sticky">
                        <div class="list-group list-group-flush mt-4">
                            <a class="list-group-item active" style="font-size: 20px;" data-bs-toggle="tab">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                </svg>&nbsp;Dashboard
                            </a>
                            <a href="teacher/subject/subject.php?page=1" class="list-group-item" style="font-size: 20px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                </svg>&nbsp;Subject
                            </a>
                            <a href="teacher/students/student.php" class="list-group-item" style="font-size: 20px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>&nbsp;Student
                            </a>
                            <a href="#" class="list-group-item" style="font-size: 20px;" data-bs-toggle="tab">About</a>
                            <a href="logout.php" class="list-group-item mt-4 text-danger" style="font-size: 20px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
                                    <path d="M7.5 1v7h1V1h-1z" />
                                    <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
                                </svg>&nbsp;Log out
                            </a>
                        </div>

                    </div>
                </nav>
            </div>

            <!-- DASHBBOARD -->
            <div class="col-9 border w-80 border-0">
                <div class="container-gluid mt-4">
                    <div class="alert alert-success" role="alert">
                        Welcome to dashboard!
                    </div>
                </div>

                <!-- CARDS -->

                <div class="container border border-1 d-flex">
                    <!-- CARD 1 -->
                    <div class="card mt-4 mb-4 shadow rounded-3" style="width: 18rem;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <svg class="ms-4 mt-4" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                    </svg>
                                    <div class="ms-1" style="font-size: 25px">
                                       <b>Subjects</b>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <p class=" ms-4" style="font-size: 70px"><?php echo countSubjects()->rowCount();?></p>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer bg-warning"></div>
                    </div>

                    <!-- CARD 2 -->

                    <div class="card mt-4 mb-4 shadow rounded-3 ms-5" style="width: 18rem;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <svg class="ms-4 mt-4" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg>
                                    <div class="ms-1" style="font-size: 25px">
                                        <b>Students</b>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <p class=" ms-4" style="font-size: 70px"><?php echo count(countStudents()) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-success"></div>
                    </div>

                    <!-- CARD 3 -->

                    <div class="card mt-4 mb-4 shadow rounded-3 ms-5" style="width: 18rem;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <svg class="ms-4 mt-4" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                                        <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                        <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                                    </svg>
                                    <div class="ms-1" style="font-size: 25px">
                                        <b>Groups</b>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <p class=" ms-4" style="font-size: 70px">0</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-danger"></div>
                    </div>

                </div>

            </div>
        </div>

    </div>



</body>

</html>