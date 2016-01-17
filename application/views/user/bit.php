<?php
require("../../config/config.php");
require("../../models/DB/Db.class.php");

$db = new Db();
$dbh = $db->getPurePodo();
include("../../models/PHPAuth/Config.php");
include("../../models/PHPAuth/Auth.php");

$config = new PHPAuth\Config($dbh);
$auth   = new PHPAuth\Auth($dbh, $config);

if (!$auth->isLogged()) {
    header('HTTP/1.0 403 Forbidden');
    echo "Forbidden";

    exit();
}else{
    echo"ok";
}

// only work with vies/xx can't nested more than that

?>


<html>
<head></head>
<body>


<h1>BIT</h1>

<?php

$uid = $auth->getSessionUID($auth->getSessionHash());
$result = $auth->getUser($uid);


echo '<pre>';

var_dump($result);

echo '<br>';


?>



<a href="logout.php">Logo out</a>
</body>

</html>
