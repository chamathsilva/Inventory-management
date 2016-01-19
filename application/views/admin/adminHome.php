
<?php
/*
//require_once("../../models/DB/Db.class.php");
require_once("../../controllers/DBfunctions/DbFunctions.php");


$db = new Db();
//login testing
$dbh = $db->getPurePodo();
include("../../models/PHPAuth/Config.php");
include("../../models/PHPAuth/Auth.php");

$config = new PHPAuth\Config($dbh);
$auth   = new PHPAuth\Auth($dbh, $config);

if (!$auth->isLogged()) {
    header('HTTP/1.0 403 Forbidden');
    echo "Forbidden";
    exit();
}
$userhash = $auth->getSessionHash();
$uid= $auth->getSessionUID($userhash);
//Die($userhash."----".$uid);
*/

require_once("../../controllers/DBfunctions/DbFunctions.php");
?>


<html>
<head>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!--Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!--custom admin style -->
    <link rel="stylesheet" href="../../../assets/CSS/custom/adminstyle.css">

    <!--use for animate notification -->
    <link rel="stylesheet" href="../../../assets/CSS/animate.css">  <!-- meke wadak nathi ewa makala danna -->

    <!--data table CSS -->
    <link rel="stylesheet" href="../../../assets/dataTable/css/jquery.dataTables.css">

    <!--circle load -->

    <link rel="stylesheet" href="../../../assets/CSS/percircle.css">

    <!--date time -->
    <link rel="stylesheet" href="../../../assets/DateTime/css/bootstrap-datetimepicker.min.css">






</head>
<body id="adminbody">
<div id="adminwrapper">

    <?php include '../includes/admin_navbar.php' ?>

    <div id="adminpage-wrapper">
        <div id ="adminLoderdiv" class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="margin:50px 0px 20px">
                        Dashboard <small>Statistics Overview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                    </ol>

                    <ul>
                        <li><a href="logout.php">Log out</a></li>
                        <li><a href="update.php"> Update details</a></li>
                        <li><a href="changepassword.php">Change password</a></li>
                    </ul>



                    <!-- /custom text  -->

                    <!--
                    <h2>Dark theme</h2>
                    <div class="dark-area clearfix">
                        <div class="clearfix">
                            <div id="lightcircle" data-percent="77" class="dark big"></div>
                            <div id="dgreencircle" data-percent="50" class="dark blue"></div>
                            <div id="sacircle" data-percent="33" class="dark small pink"></div>
                        </div>
                    </div>

                    -->




                </div>
            </div>

        </div>
    </div>


</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<!-- circle load -->
<script type="text/javascript" src="../../../assets/JS/percircle.js"></script>



<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="../../../assets/JS/bootstrap-notify.min.js"></script>
<script src="../../../assets/dataTable/js/jquery.dataTables.js"></script>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
<script src="../../../assets/JS/jquery.form.min.js"></script>

<!--graph -->
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>


<!--Date time -->
<script src="../../../assets/DateTime/js/bootstrap-datetimepicker.min.js"></script>


<script src="../../../assets/JS/validation.js"></script>

<script>



    var adminLoaddiv = $("#adminLoderdiv");

    loadDashboard();

    function loadfeedback(){
        var feedback = $("#feedback_dropdown");
        feedback.empty();
        feedback.prepend('<li class="message-footer"><img style="margin-left:30px;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div></li>');
        feedback.load("../../controllers/massegesmanagement/fetch_feedback.php");
    }

    //Navigation bar click funtion load relevent page via ajax



    function loadRegisterUsers(){
        adminLoaddiv.empty();
        adminLoaddiv.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
        adminLoaddiv.load("addUsers.php");
    }

    function loadmanageLessons(){
        adminLoaddiv.empty();
        adminLoaddiv.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
        adminLoaddiv.load("manageLessons.php");
    }

    function loadmaddAdvance(){
        adminLoaddiv.empty();
        adminLoaddiv.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
        adminLoaddiv.load("addAdvance.php");
    }

    function loadDashboard(){
        adminLoaddiv.empty();
        adminLoaddiv.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
        adminLoaddiv.load("adminDashboard.php");
    }

    function loadmasseges(){
        adminLoaddiv.empty();
        adminLoaddiv.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
        adminLoaddiv.load("viewMasseges.php");
    }

    function loadaddproduct(){
        adminLoaddiv.empty();
        adminLoaddiv.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
        adminLoaddiv.load("addProduct.php");

    }

    function loadaddref(){
        adminLoaddiv.empty();
        adminLoaddiv.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
        adminLoaddiv.load("addNewRef.php");

    }

    function loadaddRemoveStock(){
        adminLoaddiv.empty();
        adminLoaddiv.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
        adminLoaddiv.load("addRemoveStock.php");

    }

    function loadmadddailysales(){
        adminLoaddiv.empty();
        adminLoaddiv.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
        adminLoaddiv.load("DailySalles.php");

    }


    function loadmaddmissing(){
        adminLoaddiv.empty();
        adminLoaddiv.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
        adminLoaddiv.load("Missing.php");

    }

    function loadgetSalary(){
        adminLoaddiv.empty();
        adminLoaddiv.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
        adminLoaddiv.load("getSalary.php");

    }

    function loadremovemissings(){
        adminLoaddiv.empty();
        adminLoaddiv.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
        adminLoaddiv.load("removemissongs.php");

    }

    function loadmanageref(){
        adminLoaddiv.empty();
        adminLoaddiv.prepend('<img style="margin-left:50%;" src="../../../assets/images/ajax-loader.gif" /> Loading...</div>');
        adminLoaddiv.load("manageref.php");

    }


</script>






</body>
</html>











