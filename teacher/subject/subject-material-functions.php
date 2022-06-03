<?php 

    function subjectFunc(){
        $arr = array();

        if(isset($_GET['subject_id'])){
            $subjectid = $_GET['subject_id'];
            $querySubject = "SELECT * FROM subject WHERE subject_id='$subjectid'";
            $querySubjectResult = $GLOBALS['pdo']->query($querySubject);

            foreach($querySubjectResult as $data){
                $arr['subject_name'] = $data['subject_name'];
            }
        }
        return $arr;
    }

    function teacherMaterial(){
        $arr = array();

        if(isset($_GET['material_id'])){

            $material_id = $_GET['material_id'];
    
            $queryTeacherMaterials = "SELECT * FROM teacher_materials WHERE material_id='$material_id'";
            $queryTeacherMaterialsResult = $GLOBALS['pdo']->query($queryTeacherMaterials);
            
            foreach($queryTeacherMaterialsResult as $data){
                $arr['material_name'] = $data['material_name'];
                $arr['material_icons_id'] = $data['material_icons_id'];
                $arr['description'] = $data['description'];
            }
        }
        return $arr;
    }

    function materialIcon(){
        
        $arr = teacherMaterial(); //REUSING FUNCTION
        $arr2 = array();
        $materialIconsID = $arr['material_icons_id'];
        $queryMaterialIcons = "SELECT * FROM  material_icons WHERE material_icons_id='$materialIconsID'";
        $queryMaterialIconsResult = $GLOBALS['pdo']->query($queryMaterialIcons);

        foreach($queryMaterialIconsResult as $data){
            $arr2['image'] = $data['image'];
        }

        return $arr2;
    }

    function insertFile(){

        if(isset($_POST['fileSubmit'])){
            $materialid = $_GET['material_id'];
            $filename = $_POST['filename'];
    
    
            $files = $_FILES['file']['name'];
            $files_size = $_FILES['file']['size'];
            $files_temp_loc = $_FILES['file']['tmp_name'];
           
    
            $fileExt = explode('.', $files);
            $fileActualExt = strtolower(end($fileExt));
    
            $allowed = array('pdf');
    
            $query = $GLOBALS['pdo']->prepare("INSERT INTO material_file (file_name, files, material_id) 
            VALUES (:filename, :files, :materialid)");
    
            if(in_array($fileActualExt, $allowed)){
                if($files_size < 50000000){
                    $fileNewName = uniqid("f=", true). "." .$fileActualExt;
                    $uploads_store = "../../uploads/".$fileNewName;
                    move_uploaded_file($files_temp_loc, $uploads_store);
    
                    $query->bindParam(':filename', $filename);
                    $query->bindParam(':files', $fileNewName);
                    $query->bindParam(':materialid', $materialid);
                    $query->execute();
                    ?>
                        <script>
                            window.location.href = "subject-materials.php?subject_id=<?= $_GET['subject_id'] ?>&material_id=<?= $_GET['material_id'] ?>";
                        </script>
                    <?php
                }else{
                    echo "Your file is too big";
                }
            }else {
                echo "You cannot upload this kind of file";
            }
    
        }
    }


    function displayPdfFile(){

        $materialid = $_GET['material_id'];   
        $querySelectFile = "SELECT * FROM material_file WHERE material_id='$materialid'";
        $querySelectFileResult = $GLOBALS['pdo']->query($querySelectFile);

        foreach($querySelectFileResult as $data){
           
            ?> 
                <li class="list-group-item mt-2 text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                    </svg>
                    <a class="text-dark" href="../../uploads/<?php echo $data['files']?>" target="_blank"><?php echo $data['file_name']?></a>
                </li>
            <?php
        }
    }

    

?>