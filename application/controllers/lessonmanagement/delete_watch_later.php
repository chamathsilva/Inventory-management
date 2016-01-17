
<?php
require("../../models/DB/Db.class.php");
$db = new Db();
session_start();

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
    $id	= filter_var($_POST["id"], FILTER_SANITIZE_STRING);
    $user_id = filter_var($_POST["uid"],FILTER_SANITIZE_STRING);


    $result=  $db->query("DELETE FROM watchlater WHERE user_id = :uid and lesson_id = :lid ",array("uid"=>$user_id,"lid"=>$id));



    if ($result == 1){
        $output = json_encode(array( //create JSON data
            'type'=>'text',
            'text' => '<div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Indicates a successful or positive action.
                        </div>'
        ));
    }else{
        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' =>  '<div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong> This alert box could indicate a warning that might need attention.
                        </div>'
        ));
    }


    die($output);


}
?>
