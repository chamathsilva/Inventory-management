<?php
    require("../../models/DB/Db.class.php");
    $db = new Db();
    $dbh = $db->getPurePodo();
    include("../../models/PHPAuth/Config.php");
    include("../../models/PHPAuth/Auth.php");

    $config = new PHPAuth\Config($dbh);
    $auth   = new PHPAuth\Auth($dbh, $config);


    $email = "mbckchamathsilva@gmail.com";
    $password = "ucsc@123!@#AB";
    $repeatpassword = "ucsc@123!@#A";


    echo '<pre>';

    $result = $auth->logout($auth->getSessionHash());
    var_dump($result);

    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

    header('location: ../../../index.php');

    echo '<br>';



