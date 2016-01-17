<?php


if($_POST){
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    }

    require("../../models/DB/Db.class.php");
    $db = new Db();

    $uid  = filter_var($_POST["uid"], FILTER_SANITIZE_STRING);
    $firstName   = filter_var($_POST["firstName"], FILTER_SANITIZE_STRING);
    $LastName   = filter_var($_POST["LastName"], FILTER_SANITIZE_STRING);


    $result = $db->query("UPDATE users SET firstName = :Fname, Lastname = :Lname WHERE id = :uid",array("Fname"=>$firstName,"Lname"=>$LastName,"uid"=>$uid));


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
                            <strong>Warning!</strong> No change
                            </div>'
        ));
    }


    die($output);

}


