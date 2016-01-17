
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
    $id	= filter_var($_POST["id"], FILTER_SANITIZE_STRING);


    $result=  $db->query("DELETE FROM feedback WHERE id = :mid ",array("mid"=>$id));



    if ($result == 1){
        $output = json_encode(array( //create JSON data
            'type'=>'text',
            'text' => '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Deleted Succesfully
                        </div>'
        ));
    }else{
        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' =>  '<div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong> Not Any Change Happened
                        </div>'
        ));
    }


    die($output);


}
?>
