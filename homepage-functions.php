<?php 

    /*********** COUNT THE TOTAL SUBJECT THAT A TEACHER HANDLED ******************** */
    function countSubjects(){

        $teacherid = $_SESSION['ID'];
        $querySubject = "SELECT * FROM subject WHERE teacher_id='$teacherid'";
        $querySubjectResult = $GLOBALS['pdo']->query($querySubject);

        return $querySubjectResult;
    }

    /*********** COUNT THE TOTAL STUDENTS THAT A TEACHER HANDLED ******************** */

    function countStudents(){

        $arrCount = array();
        $teacherid = $_SESSION['ID'];
        $queryTeacherMaterial = "SELECT subject_id FROM subject WHERE teacher_id='$teacherid'";
        $queryTeacherMaterialResult = $GLOBALS['pdo']->query($queryTeacherMaterial);

        foreach($queryTeacherMaterialResult as $temp){
            
            $subID = $temp['subject_id'];

            $querySubjectMember = "SELECT stud_id FROM subject_members WHERE subject_id='$subID'";
            $querySubjectMemberResult = $GLOBALS['pdo']->query($querySubjectMember);

            foreach($querySubjectMemberResult as $temp2){
                if(!in_array($temp2['stud_id'], $arrCount)){
                    array_push($arrCount, $temp2['stud_id']);

                }
            }
        }

        return $arrCount;

    }

?>