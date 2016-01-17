<?php
//function to get,read and insert subjects to data base table
function subjectRows($lessonID,$row){

    require_once("../../models/DB/Db.class.php");
    $db = new Db();
//if the field is not empty read it
    if(trim($row) != ''){
        $line = explode(',', $row);
        //insert all subjects separated with comma into the subject table with correcponding lesson id
        foreach($line as $line){
            $subr = $db->query("INSERT INTO subjects(lesson_id, subject) VALUES (:ld,:su)",array("ld"=>$lessonID,"su"=>$line));

            if(!($subr)){
                die("Subjects Not Added Successfully");
            }

        }
    }
}

?>