<?php
require_once("../../controllers/DBfunctions/DbFunctions.php");
$dbh = $db->getPurePodo();

$temp  = "hello";

//Die("Hello chamath");

foreach ($_GET as $key => $value){
   //echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";

}

$Ref_id      = filter_var($_GET["refname"], FILTER_SANITIZE_STRING);
$date    = filter_var($_GET["CurrentDate"], FILTER_SANITIZE_STRING);

$productIdlist = getProductId();

$result = 0;


$db->beginTransaction();
$total_salary = 0;
foreach ($productIdlist as $productid){



    $productInfo  = getProductInfo();

    $saleskey = 'sales'.$productid;
    $returnkey = 'return'.$productid;
    //echo $saleskey.$returnkey;

    $sales = filter_var($_GET["$saleskey"], FILTER_SANITIZE_STRING);
    $return = filter_var($_GET["$returnkey"], FILTER_SANITIZE_STRING);
    //echo $sales.$return;

    if ($sales != 0 || $return != 0){
        //save traction
        $result = $db->query("INSERT INTO Transaction (Time_Stamp,ref_id,product_id,selles,returns) VALUES(:Time_Stamp,:ref_id,:pro_id,:selles,:returns)",array("Time_Stamp"=> $date,"ref_id"=> $Ref_id,"pro_id"=> $productid,"selles"=> $sales,"returns"=> $return));

        if($sales != 0 ){
            //add entry for stock table
           // $result = $db->query("INSERT INTO Stock (SalesOut,product_id) VALUES (:OutStock,:product_id)",array("OutStock" => $sales, "product_id" =>$productid));
            // Reduce current stock count
            $result = $db->query("UPDATE  Product SET currentStock = currentStock - :OutStock WHERE Product_id = :product_id" ,array("OutStock" => $sales, "product_id" =>$productid));
            //Make commision increment for ref
            $total_salary = $total_salary + (floatval($sales) * floatval($productInfo[$productid]['Commision']));

        }
        if($return != 0){
            //add entry for stock table
            //$result = $db->query("INSERT INTO Stock (Return_in,product_id) VALUES (:InStock,:product_id)",array("InStock" => $return, "product_id" =>$productid));
            // Increase current stock count
            $result = $db->query("UPDATE  Product SET currentStock = currentStock + :InStock WHERE Product_id = :product_id" ,array("InStock" => $return, "product_id" =>$productid));
            //make commision decrement for ref
            $total_salary = $total_salary - (floatval($return) * floatval($productInfo[$productid]['Commision']));

        }

    }

}



//insert Day commision to ref salary table
$result = $db->query("INSERT INTO refSalary (ref_id,salary) VALUES (:ref_id,:salary)",array("ref_id" => $Ref_id, "salary" =>$total_salary));

$db->commit();





if ($result == 1){
    $output = json_encode(array( //create JSON data
        'type'=>'text',
        'text' => '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Today Salary '.$total_salary.'.
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
