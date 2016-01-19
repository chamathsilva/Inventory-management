<?php

require_once("../../controllers/DBfunctions/DbFunctions.php");

$missinid      = filter_var($_POST["missinid"], FILTER_SANITIZE_STRING);
$productid      = filter_var($_POST["productid"], FILTER_SANITIZE_STRING);
$amount      = filter_var($_POST["amount"], FILTER_SANITIZE_STRING);


$db->beginTransaction();

//remove missing entry
$result = $db->query("DELETE FROM Missing WHERE Missing_id = :mid",array("mid"=>$missinid));

//remove effect from the stock
$result1 = $db->query("UPDATE  Product SET currentStock = currentStock + :OutStock WHERE Product_id = :product_id" ,array("OutStock" => $amount, "product_id" =>$productid));



$db->commit();


if ($result1 == 1){
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
