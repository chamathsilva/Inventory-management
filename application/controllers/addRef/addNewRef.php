<?php
require("../../models/DB/Db.class.php");
$db = new Db();


echo "Add new ref completed";

$refname    = filter_var($_POST["refname"], FILTER_SANITIZE_STRING);
$basicsalary    = filter_var($_POST["basicsalary"], FILTER_SANITIZE_STRING);
$other    = filter_var($_POST["other"], FILTER_SANITIZE_STRING);

//echo $refname.$basicsalary.$other;


$result = $db->query("INSERT INTO Ref (Ref_Name,Basic_salary,Other) VALUES(:namee,:Bsalary,:other)",array("namee"=>$refname,"Bsalary"=>$basicsalary,"other"=>$other));


echo json_encode($result);