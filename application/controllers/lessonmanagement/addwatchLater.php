<?php

require("../../models/DB/Db.class.php");
session_start(); ///////////

if (isset($_GET['id'])){



    $db = new Db();
    $time =  $_GET['time'];
    $lessonid = $_GET['id'];
    $user_id = filter_var($_GET["uid"],FILTER_SANITIZE_STRING);


    //echo $time;
    //echo '<br>';
    //echo $lessonid;
    //echo '<br>';
    //echo $user_id;

    $name = $db->query("SELECT name FROM lesson WHERE lesson_id = :lid ",array("lid"=>$lessonid));
    $name =  $name[0]["name"];

    //$db->query("INSERT INTO watchlater(user_id,lesson_id,timestamp,lessonname) VALUES(:uid,:lid,:timess,:namee)",array("uid"=>$user_id,"lid"=>$lessonid,"timess"=>$time,"namee"=>$name));

    $db->query("INSERT INTO watchlater (user_id,lesson_id,timestamp,lessonname) VALUES(:uid,:lid,:timess,:namee) ON DUPLICATE KEY UPDATE timestamp = $time",array("uid"=>$user_id,"lid"=>$lessonid,"timess"=>$time,"namee"=>$name));

    header('location: ../../views/user/userhomeOld.php');

}
?>
