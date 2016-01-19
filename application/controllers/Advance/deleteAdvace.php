<?php

require_once("../../controllers/DBfunctions/DbFunctions.php");

$aid      = filter_var($_POST["advanceid"], FILTER_SANITIZE_STRING);




$db->beginTransaction();

$result = $db->query("DELETE FROM Advances WHERE Advance_id = :aid",array("aid"=>$aid));


$db->commit();


if ($result == 1){
    $output = json_encode(array( //create JSON data
        'type'=>'text',
        'text' => '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong>
                        </div>'
    ));

}else{
    $output = json_encode(array( //create JSON data
        'type'=>'error',
        'text' =>  '<div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong> Something wrong.
                        </div>'
    ));
}


die($output);
