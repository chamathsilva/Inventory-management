<?php


require("../../models/DB/Db.class.php");
$db = new Db();

if($_POST)

{
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    }


    //Sanitize input data using PHP filter_var().
    $topic      = filter_var($_POST["topic"], FILTER_SANITIZE_STRING);
    $comment    = filter_var($_POST["comment"], FILTER_SANITIZE_STRING);
    $user_id    = filter_var($_POST["uid"], FILTER_SANITIZE_STRING);

    //$result=  $db->query("UPDATE lesson SET name = :namee,lecture = :lec,category = :cat,type = :typ WHERE lesson_id = :lid",array("namee"=>$Name,"lec"=>$Lecture,"cat"=>$Category,"typ"=>$Type,"lid"=> $id));

    $result = $db->query("INSERT INTO feedback (topic,comment,user_id,time_stamp) VALUES(:topic,:comment,:uid,CURRENT_TIMESTAMP)",array("topic"=>$topic,"comment"=>$comment,"uid"=>$user_id));


    if ($result == 1){
        $output = json_encode(array( //create JSON data
            'type'=>'text',
            'text' => '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Indicates a successful or positive action.
                        </div>'
        ));
    }else{
        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' =>  '<div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong> This alert box could indicate a warning that might need attention.
                        </div>'
        ));
    }


    die($output);


}
?>