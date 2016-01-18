<?php
/**
 * Created by IntelliJ IDEA.
 * User: chamathsilva
 * Date: 1/16/16
 * Time: 7:36 PM
 */

require("../../models/DB/Db.class.php");
$db = new Db();


//Sanitize input data using PHP filter_var().
$Ref_id      = filter_var($_POST["refname"], FILTER_SANITIZE_STRING);
$date    = filter_var($_POST["CurrentDate"], FILTER_SANITIZE_STRING);
$amount   = abs(filter_var($_POST["Amount"], FILTER_SANITIZE_STRING));

$db->beginTransaction();
$result = $db->query("INSERT INTO Advances (ref_id,Amount,Time_stamp) VALUES(:ref_id,:Amount,:Timestampd)",array("ref_id"=>$Ref_id,"Amount"=>$amount,"Timestampd"=>$date));
$db->commit();


if ($result == 1){
    echo "Done!...";

}else{
    echo "Some thing wrong";
}
