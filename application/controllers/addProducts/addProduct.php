<?php
require("../../models/DB/Db.class.php");
$db = new Db();



echo "Add product completed";

$productname    = filter_var($_POST["productname"], FILTER_SANITIZE_STRING);
$productcost  = filter_var($_POST["productcost"], FILTER_SANITIZE_STRING);
$sellingprice    = filter_var($_POST["sellingprice"], FILTER_SANITIZE_STRING);
$commission    = filter_var($_POST["commission"], FILTER_SANITIZE_STRING);

$db->beginTransaction();

$result = $db->query("INSERT INTO Product (Product_Name,Cost,Selling_price,Commision) VALUES(:namee,:cost,:selling,:commision)",array("namee"=>$productname,"cost"=>$productcost,"selling"=>$sellingprice,"commision"=>$commission));
$db->commit();



//echo $productname.$productcost.$sellingprice.$commission;
echo json_encode($result);

