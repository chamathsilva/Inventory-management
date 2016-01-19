<?php

require_once("../../controllers/DBfunctions/DbFunctions.php");

$trasactionid      = filter_var($_POST["trasactionid"], FILTER_SANITIZE_STRING);
$productid     = filter_var($_POST["productid"], FILTER_SANITIZE_STRING);
$sales      = filter_var($_POST["sales"], FILTER_SANITIZE_STRING);
$returns      = filter_var($_POST["returns"], FILTER_SANITIZE_STRING);

$db->beginTransaction();




//remove effect from the stock - Invers query of addDialySales
    if($sales != 0 ){
        $result = $db->query("UPDATE  Product SET currentStock = currentStock + :InStock WHERE Product_id = :product_id" ,array("InStock" => $sales, "product_id" =>$productid));
    }
    if($returns != 0){
        $result = $db->query("UPDATE  Product SET currentStock = currentStock - :OutStock WHERE Product_id = :product_id" ,array("OutStock" => $returns, "product_id" =>$productid));
    }

//remove missing entry
$result1 = $db->query("DELETE FROM Transaction WHERE Transaction_id = :tid",array("tid"=>$trasactionid));



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
