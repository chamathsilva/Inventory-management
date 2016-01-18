<?php

require("../../models/DB/Db.class.php");
$db = new Db();

//Sanitize input data using PHP filter_var().
$product_id      = filter_var($_POST["Pid"], FILTER_SANITIZE_STRING);
$amount    = filter_var($_POST["Amount"], FILTER_SANITIZE_STRING);


if (!is_numeric($amount ) ||  $amount < 0){
    $output = json_encode(array( //create JSON data
        'type'=>'error',
        'text' =>  '<div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong> Enter the valid number plece.
                        </div>'
    ));
    die($output);

}


$db->beginTransaction();
$result = $db->query("INSERT INTO Stock (InStock,product_id) VALUES (:InStock,:product_id)",array("InStock" => $amount, "product_id" =>$product_id));
if ($result == 1){
    $result = $db->query("UPDATE  Product SET currentStock = currentStock + :InStock WHERE Product_id = :product_id" ,array("InStock" => $amount, "product_id" =>$product_id));
}

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
                        <strong>Warning!</strong>
                        </div>'
    ));
}


die($output);
