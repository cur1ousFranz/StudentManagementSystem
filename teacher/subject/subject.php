<?php
    session_start();
    include('../../database-connection/pdo.php');
    include('../../navbar-homepage.php');
    include('../../include-link.html');
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
    <title>Subjects</title>
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

            <!-- TABLE VIEW -->
            <div class="col-9">
                <div class="container">
                    <div class="container mt-5 pb-2 d-flex justify-content-between">
                        <h3>Subjects</h3>
                        <button class="btn btn-sm btn-primary shadow" data-bs-toggle="modal" data-bs-target="#myModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
                            </svg>&nbsp;Subject
                        </button>
                        <!--  MODAL -->
                        <div class="modal fade border-bottom-danger" id="myModal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content ">

                                    <!-- MODAL HEADER -->
                                    <div class="modal-header text-center ">
                                        <h2 class="modal-title m-auto">ADD SUBJECT</h2>
                                    </div>

                                    <!-- MODAL FORM -->
                                    <div class="modal-body">
                                        <!-- CREATING FORM INSIDE THE MODAL -->
                                        <form action="" method="post" id="myForm" >
                                            <div class="form-floating">
                                                <input id="subjectname" type="text" class="form-control-lg form-control mt-2" placeholder="Subject name" name="subjectname" autocomplete="off" maxlength="50" required>
                                                <label for="subjectname">Subject Name</label>
                                            </div>
                                            <div class="form-floating">
                                                <input id="subjectcode" type="text" class="form-control-lg form-control mt-3" placeholder="Subject code" name="subjectcode" autocomplete="off" required>
                                                <label for="subjectcode">Subject Code</label>
                                            </div>
                                            <div class="form-floating">
                                                <input id="starttime" type="time" class="form-control-lg form-control mt-3" placeholder="Start time" name="starttime" autocomplete="off" required>
                                                <label for="starttime">Start Time</label>
                                            </div>
                                            <div class="form-floating">
                                                <input id="endtime" type="time" class="form-control-lg form-control mt-3" placeholder="End time" name="endtime" autocomplete="off" required>
                                                <label for="endtime">End Time</label>
                                            </div>
                                            <div>
                                                <select class="form-select form-control-lg mt-3" id="sync" name="sync" required>
                                                    <option value="MTWTHF">Mon-Tue-Wed-Thur-Fri</option>
                                                    <option value="MTW">Mon-Tue-Wed</option>
                                                </select>
                                            </div>
                                            <!-- MODAL BUTTONS -->
                                            <div class="modal-footer mt-4 justify-content-center">
                                                <button type="submit" class="btn btn-outline-primary w-25" name="submit">Create</button>
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
                    <table class="table table-striped table-hover shadow table-bordered">
                        <thead class="bg-secondary text-white text-center">
                            <tr>
                                <th>Subject Name</th>
                                <th>Subject Code</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Synchronus</th>
                                <th>Students</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <!-- DISPLAY DATA IN TABLE -->
                        <?php
                            $stmt2 = "SELECT * FROM subject WHERE teacher_id='$teacherid' LIMIT {$start}, {$perPage}";
                            $result2 = $pdo->query($stmt2);

                            if ($result2->rowCount() > 0) {

                                foreach ($result2 as $data): 
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
                        ?>

                    </table>

                    <!-- PAGINATION -->
                    <div class="container-fluid d-flex justify-content-end">
                        <nav aria-label="...">
                            <ul class="pagination shadow">
                                <li class="page-item <?php if($page == 1){ echo 'disabled';} else {echo '';}?>">
                                    <a href="?page=<?php echo $page  - 1;?>" class="page-link">Previous</a>
                                </li>
                                <?php for($i = 1; $i <= $pages; $i++):?>
                                <li class="page-item <?php if($page == $i) { echo 'active'; } ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i?></a>
                                </li>
                                <?php  endfor;?>
                                <li class="page-item <?php if($page == $pages){ echo 'disabled';} else {echo '';} if($pages == 0){ echo 'disabled';}?>">
                                    <a href="?page=<?php echo $page  + 1;?>" class="page-link" class="page-link">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

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