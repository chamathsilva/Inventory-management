<?php
/**
 * Created by PhpStorm.
 * User: Smalkakulage
 * Date: 1/6/16
 * Time: 6:00 PM
 */
?>
<html>
<head>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!--Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../assets/CSS/custom/indexstyle.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>


<div id = "search"></div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!--jquery form -->
<script src="http://malsup.github.com/jquery.form.js"></script>
<!--jquery validation -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!--UCSC Vidobay-->
<script src="../../../assets/JS/validation.js"></script>

<script>

    //$('#results').load("application/controllers/fetchLessons/fetchLessonsForIndex.php", {'page':track_click}, function() {track_click++;});
    $('#search').load("../../controllers/lessonmanagement/searchLessons.php",{'key':"algo"});
</script>
</body>
</html>