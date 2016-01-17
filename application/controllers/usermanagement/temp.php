<?php
/**
 * Created by IntelliJ IDEA.
 * User: chamathsilva
 * Date: 1/6/16
 * Time: 3:45 PM
 */
$output = json_encode(array("type" => 1, "url" => 'xx'));

echo $output;


?>


<html>
<head>
    <title>reCAPTCHA demo: Simple page</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

<form action="?" method="POST">
    <label>Hello tetst</label>
    <div class="g-recaptcha" data-sitekey="6LcvnRQTAAAAAHkGCwQ_9vNBTHYYepbV9HPcimuq"></div>
    <br/>


    <input type="submit" value="Submit">
</form>


</body>
</html>
