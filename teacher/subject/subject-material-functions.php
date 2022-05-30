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



?>