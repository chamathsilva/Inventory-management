<?php
require_once("../../controllers/DBfunctions/DbFunctions.php");

//Sanitize input data using PHP filter_var().
$Ref_id      = filter_var($_POST["refname"], FILTER_SANITIZE_STRING);
$datestart        = filter_var($_POST["CurrentDatestart"], FILTER_SANITIZE_STRING);
//$dateend        = filter_var($_POST["CurrentDateend"], FILTER_SANITIZE_STRING);
$Bonus      = abs(filter_var($_POST["Amount"], FILTER_SANITIZE_STRING));

//echo "hello how are you.$Ref_id.$datestart.$dateend.$Bonus";



//echo "Month Bonus is : Rs ".$Bonus;

//$totalSalary += $Bonus;

//echo "Current Month is : ".$datestart;


$productinfo = getProductInfo();

$db->beginTransaction();

$salary = $db->query("SELECT * FROM Transaction WHERE DATE_FORMAT(Time_Stamp,'%Y-%m') = :yermonth and ref_id = :ref_id",array("yermonth"=>$datestart,"ref_id"=>$Ref_id));

$missing = $db->query("SELECT * FROM Missing WHERE DATE_FORMAT(Time_Stamp,'%Y-%m') = :yermonth and ref_id = :ref_id",array("yermonth"=>$datestart,"ref_id"=>$Ref_id));

$advance = $db->query("SELECT * FROM Advances WHERE DATE_FORMAT(Time_stamp,'%Y-%m') = :yermonth and ref_id = :ref_id",array("yermonth"=>$datestart,"ref_id"=>$Ref_id));

$totalSalary = 0;
$totalCommision = 0;
$totalMissings = 0;
$totalAdvaces = 0;


//echo "Commision<br>";
foreach ($salary as $srow){

    //sales // retun ehema enna hadanna
    $totalCommision += $srow['commission'];
    $temp = date('Y-m-d',strtotime($srow['Time_Stamp']));
    $english_format_number = number_format($srow['commission'], 2, '.', '');
    $product = $productinfo[$srow['product_id']]['Product_Name'];
   // $padd = str_pad($english_format_number,20,' ',STR_PAD_LEFT);
    echo $temp."-->".$english_format_number."--->".$product."<br>";
    //var_dump($srow) ;
}

//echo "Missings<br>";
foreach ($missing as $mrow){
    $totalMissings += $mrow['totalMissingcost'];
     //$english_format_number = number_format($mrow['totalMissingcost'], 2, '.', ',');;
    //echo $mrow['Time_Stamp']."-->".$english_format_number."<br>";
    //var_dump($srow) ;
}

//echo "Advances<br>";
foreach ($advance as $arow){
    $totalAdvaces += $arow['Amount'];
    //$english_format_number = number_format($arow['Amount'], 2, '.', ',');
    //echo $arow['Time_stamp']."-->".$english_format_number."<br>";
    //var_dump($srow) ;
}

$totalAdditions = $totalCommision + $Bonus;
$totalDeductions = $totalMissings + $totalAdvaces;
$totalSalary = $totalAdditions - $totalDeductions;

echo "<br>Total salary : $totalSalary.Total deductions : .$totalDeductions.Total additions : .$totalAdditions";




$db->commit();

//header("location:../../views/admin/test.php");








