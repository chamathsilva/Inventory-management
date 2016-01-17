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
<div class="wrapper">
    <?php include '../includes/navbarreg.php' ?>

    <div class=" top-content">
        <div class="row">
            <div class="col-sm-3"></div>

            <div class="col-sm-6">
                <div class="form-top">
                    <div class="form-top-left">
                        <h3>Sign up now</h3>
                        <p>Fill in the form below to get instant access:</p>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-pencil"></i>
                    </div>
                </div>
                <div class="form-bottom">
                    <div  id ="feedback" class="feederror" style="align-content: center"></div>

                    <form id = "register_form" role="form" action="../../controllers/usermanagement/testregistration.php" method="POST" class="registration-form">

                        <div class="form-group">
                            <label class="sr-only" for="form-first-name">First name</label>
                            <input type="text" name="First_Name" id="First_Name" placeholder="First name..." class="form-first-name form-control" >
                        </div>

                        <div class="form-group">
                            <label class="sr-only" for="form-last-name">Last name</label>
                            <input type="text" name="Last_Name" id="Last_Name" placeholder="Last name..." class="form-last-name form-control" >
                        </div>

                        <div class="form-group">
                            <label class="sr-only" for="form-first-name">User name</label>
                            <input type="text" name="regUser_Name" id="regUser_Name" placeholder="User name..." class="form-first-name form-control" >
                        </div>

                        <div class="form-group">
                            <label class="sr-only" for="form-email">Email</label>
                            <input type="text" name="E_mail" id="E_mail" placeholder="Email..." class="form-email form-control" >
                        </div>

                        <div class="form-group">
                            <label class="sr-only" for="form-email">Password</label>
                            <input type="password" name="regPassword" id="regPassword" placeholder="password..." class="form-email form-control" ">
                        </div>

                        <div class="form-group">
                            <label class="sr-only" for="form-email">Password</label>
                            <input type="password" name="password_again" id="password_again" placeholder="password again..." class="form-email form-control" >
                        </div>

                        <div class="form-group">
                            <label>
                                <input id="terms" name="terms" type="checkbox">
                                I have read,constat and agree ....
                            </label>
                        </div>


                        <div class="form-group " >
                            <div class="g-recaptcha" data-sitekey="6LcvnRQTAAAAAHkGCwQ_9vNBTHYYepbV9HPcimuq"></div>
                        </div>

                        <button type="reset"  class="btn btn-success">Rest</button>
                        <button type="button" onclick="registration_form()" class="btn btn-success">Sign up!</button>

                    </form>
                </div>



            </div>
        </div>
    </div>
</div>


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




    $("#register_form").validate({
        rules:{
            E_mail:{
                required: true,
                email: true
            },
            regPassword: {
                required: true,
                strongPassword: true

            } ,
            password_again: {
                required: true,
                equalTo: "#regPassword"
            },
            First_Name:{
                required: true,
                nowhitespace: true,
                lettersonly: true
            },

            Last_Name:{
                required: true,
                nowhitespace: true,
                lettersonly: true
            },

            regUser_Name:{
                required: true,
                nowhitespace: true

            },
            terms:{
                required:true
            }

        },
        messages: {
            email: {
                required: 'Please enter an email address.',
                email:'Please enter a <em>valid</em> email address.'
            },
            password2: {
                equalTo: "Please enter the same password again."
            },
            terms:{
                required:"You must agree to the terms and conditions"
            }


        },
        errorClass: 'help-block',
        highlight: function(element){
            $(element)
                .closest('.form-group')
                .addClass('has-error');
        },

        unhighlight: function(element){
            $(element)
                .closest('.form-group')
                .removeClass('has-error');
        },
        errorPlacement: function(error,element){
            if (element.prop('type') === 'checkbox'){
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });


    function registration_form(){
        $('#register_form').ajaxSubmit({
            beforeSubmit:  beforeSubmit,
            success: function(data) {
                var obj = jQuery.parseJSON( data);

                //alert("Thank you for your comment!" + data);

                //json eke enne typee kiyana ekekn error ekak da nadda kiyana eka

                if (obj.typee == 1){
                    $("#feedback").hide().html(obj.resultt).slideDown("slow");

                }else{
                    $("#register_form").slideUp();
                    document.getElementById("register_form").reset();
                    $("#feedback").hide().html("Your account is created,you can log now").slideDown("slow");
                    //window.location.replace(obj.resultt);
                }


                //window.location.replace(data[2]);

                //alert("Thank you for your comment!" + data);
                //$('#feedback').html(data);


                //;

            }

        });
        return false;

        function beforeSubmit(){
            if (!$('#register_form').valid()) {
                //alert("form is invalid");
                return false;
            }
            //alert("form is valid");
        }

    }

</script>


</body>

</html>