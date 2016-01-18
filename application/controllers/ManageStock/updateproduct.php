<?php

require_once("../../controllers/DBfunctions/DbFunctions.php");

//Sanitize input data using PHP filter_var().
$product_id      = filter_var($_POST["Pid"], FILTER_SANITIZE_STRING);
$ProductName    = filter_var($_POST["ProductName"]);
$Cost    = filter_var($_POST["Cost"], FILTER_SANITIZE_STRING);
$SellingPrice    = filter_var($_POST["SellingPrice"], FILTER_SANITIZE_STRING);
$Commision    = filter_var($_POST["Commision"], FILTER_SANITIZE_STRING);




if ((!is_numeric($Cost) || floatval($Cost) <= 0) || (!is_numeric($SellingPrice) || floatval($SellingPrice) <= 0 )||( !is_numeric($Commision) || floatval($Commision) <= 0 ) ){
    $output = json_encode(array( //create JSON data
        'type'=>'error',
        'text' =>  '<div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong> Enter the  valid values pleace.
                        </div>'
    ));
    die($output);

}



$db->beginTransaction();

$result = $db->query("UPDATE Product SET Product_Name = :pname, Cost = :cost , Selling_price = :price , Commision = :commision WHERE Product_id = :pid" ,array("pname" => $ProductName, "cost" =>$Cost, "price" =>$SellingPrice, "commision" =>$Commision, "pid" =>$product_id));



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
                        <strong>Warning!</strong> no change happend
                        </div>'
    ));
}


die($output);
