<?php
/**
 * Created by IntelliJ IDEA.
 * User: chamathsilva
 * Date: 1/16/16
 * Time: 7:36 PM
 */

require_once("../../controllers/DBfunctions/DbFunctions.php");

$productInfo  = getProductInfo();

//Sanitize input data using PHP filter_var().
$Ref_id      = filter_var($_POST["refname"], FILTER_SANITIZE_STRING);
$product_id  = filter_var($_POST["productname"], FILTER_SANITIZE_STRING);
$date        = filter_var($_POST["CurrentDate"], FILTER_SANITIZE_STRING);
$amount      = abs(filter_var($_POST["Amount"], FILTER_SANITIZE_STRING));

$totalMisingzcost = $amount * floatval($productInfo[$product_id]['Cost']);

$db->beginTransaction();

$result = $db->query("INSERT INTO Missing (Ref_id,Product_id,Time_Stamp,totalMissingcost) VALUES(:Ref_id,:Product_id,:Time_Stamp,:totalMissingcost)",array("Ref_id"=>$Ref_id,"Product_id"=>$product_id,"Time_Stamp"=>$date,"totalMissingcost"=>$totalMisingzcost));
$result = $db->query("UPDATE  Product SET currentStock = currentStock - :OutStock WHERE Product_id = :product_id" ,array("OutStock" => $amount, "product_id" =>$product_id));


$db->commit();

if ($result == 1){
    $output = "Completed";
}else{
    $output = "Some thing wrong";

}


die($output);