<?php
    require("../../models/DB/Db.class.php");
    $db = new Db();
    $dbh = $db->getPurePodo();
    include("../../models/PHPAuth/Config.php");
    include("../../models/PHPAuth/Auth.php");

    $config = new PHPAuth\Config($dbh);
    $auth   = new PHPAuth\Auth($dbh, $config);

    //$uid = $auth->getSessionUID($auth->getSessionHash());

    $uid = 18;
    $result = $auth->getUser($uid);


    echo '<pre>';

    var_dump($result);

    echo '<br>';


