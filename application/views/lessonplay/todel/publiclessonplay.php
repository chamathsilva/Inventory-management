
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UCSC VideoBay</title>


    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <link rel="stylesheet" href="../../../../assets/CSS/custom/publicnav.css">
    <link rel="stylesheet" href="../../../../assets/CSS/colorbox.css">

    <!--slider-->






</head>

<body>

<div class="wrapper">
    <?php
    include '../includes/navbarreg.php'
    ?>
</div>

<!--

<div class="wrapper">


    <div class="box">
        <div class="row row-offcanvas row-offcanvas-left">

            <div class="column col-sm-2 col-xs-2 sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
                </ul>

                <ul class="nav hidden-xs" id="lg-menu">
                    <li class="sidemenu">Main Topics</li>
                </ul>

                <ul class="nav hidden-xs">
                    <div class="row">
                        <li style="margin-bottom: 15px; margin-top:10px; ">Watch Next</li>
                        <div id="watch_next"></div>

                        <li style="margin-bottom: 15px; margin-top:10px; ">Watch later</li>
                        <div id="watch_later"></div>

                    </div>

                </ul>

            </div>
            <!-- main right col -->
<!--
            <div class="column col-sm-10 col-xs-10" id="main">

                <div class="full ">
                    <div class="col-sm-12 text">
                        <div id="results"></div>
                    </div>


                    <!--hide karala tibba eka ain kara -->
<!--
                    <div id = "lessonplay" class = "hideee" class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <video id="myVideo" class="embed-responsive-item"  width = "300px" height ="400px" autoplay controls>
                                        <source src="">
                                        <!--<source src="../../../data/uploaded_lessons/44/videos/1.mp4">-->

<!--
                                    </video>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <img id="xx" class="img-responsive" src="" alt="Wrong link" min-width="100%" height="auto" >
                            </div>

                            <h1>id</h1>


                            <div class=" col-sm-12">

                                <div class = "slidNavigator" style="margin-left: -10px;">
                                    <div class="col-sm-10">
                                        <div class="detail-panal" style="width: 122%;height: 53px;margin-bottom: 5px;">
                                            <div class="col-sm-4">
                                                <div class="lesson-topic">
                                                    topic
                                                </div>
                                            </div>


                                            <div class="col-sm-2 text-right">
                                                <button  onclick="addWatchlater();" class="btn">Watch later</button>'

                                            </div>


                                            <div class="col-sm-6">
                                                <div class="lesson-topic">
                                                    <i class="fa fa-graduation-cap"></i>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                <div class="col-sm-12">
                                    <!--div class="detail-panal" style="border:0px solid black;width:122%;height:300px;overflow-y:hidden;overflow-x:scroll;"-->
<!--
                                    <div class="wrap">

                                        <div class="frame" id="centered">
                                            <ul class="slidee">
                                                <li>
                                                    <article data-start="" data-end="">
                                                        <a hreff=""><img src=" " height="140"  onclick="setCurTime()"></a>
                                                    </article>
                                                </li>

                                            </ul>
                                        </div>


                                        <!-- Controls & Scroll Bar-->
<!--
                                        <div class="controls center">
                                            <button class="btn prevPage"> <-- page</button>
                                            <button class="btn prev"><i class="icon-chevron-left"></i> prev</button>
                                            <button class="btn next">next <i class="icon-chevron-right"></i></button>
                                            <button class="btn nextPage">page -> </button>
                                        </div>

                                        <div class="scrollbar">
                                            <div class="handle">

                                            </div>
                                        </div>


                                    </div>




                                    <div class="info text-center ">
                                        <!--disply current slid num -->
<!--
                                        <div id = current >  </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div> <!--Full end -->

<!--
                </div>  <!--container end-->
<!--

            </div>
        </div>
    </div>
</div>

<!--
<h2 id ="2" > Tessssss</h2>
<div id = "testtt">Thth</div>  -->






<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!--jquery validation -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>





<?php include '../../controllers/synchronize.php';?>
<!--Slider -->

<script src="../../../../assets/CSS/slider/plugin.js"></script>
<script src="../../../../assets/CSS/slider/sly.js"></script>
<!--
<script src="slider/slider.js"></script>
-->


<script type="text/javascript">
    var $wrap  = $('.wrap');
    var sly = new Sly( '#centered', {
        horizontal: 1,
        itemNav: 'centered',
        smart: 1,
        activateOn: 'click',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        startAt: 0,
        scrollBar: $wrap.find('.scrollbar'),
        scrollBy: 1,
        speed: 300,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        dragHandle: 1,
        dynamicHandle: 1,
        clickBar: 1,


        // Buttons
        prev: $wrap.find('.prev'),
        next: $wrap.find('.next'),
        prevPage: $wrap.find('.prevPage'),
        nextPage: $wrap.find('.nextPage')
    });

    sly.init();

    function activeslid(id) {
        sly.activate(id);

    }




</script>




<script type="text/javascript">
    $(document).ready(function() {



        var panal = $("#lessonplay");


        $("#results").prepend('<div class="loading-indication"><img src="../ajax-loader.gif" /> Loading...</div>');


        panal.slideDown(function(){panal.removeClass("hide");});
        //jump to the video to specifc time.used for watch later function.
        $("#results").hide();

        //load  lessons to the watch next.
        $("#watch_next").prepend('<div class="loading-indication"><img src="../ajax-loader.gif" /> Loading...</div>');
        $("#watch_next").load("../../models/fetch_lessons_withlimit.php",{"});

        //load  watch later to the watch_later.
            $("#watch_later").prepend('<div class="loading-indication"><img src="../ajax-loader.gif" /> Loading...</div>');
        $("#watch_later").load("../../models/fetch_watch_later.php");



        // this is for enter press , this call on click event
        $('#search-form').submit(function(e) {
            var $this = $(this);
            e.preventDefault(); // Prevents the form from submitting regularly
            $("#serchbut").click();

        });
        // this is for mouse click event
        $("#serchbut").click(function(){
            $( "#lessonplay" ).empty();
            $("#results").prepend('<div class="loading-indication"><img src="../ajax-loader.gif" /> Loading...</div>');
            var search_keyword = document.getElementById("srch-term").value;
            $("#results").load("../Search/searchResults.php",{'srch-term':search_keyword});

        });



    });
</script>

<script>
    function myFunction() {
        setCurTime(60);
        alert("Hello! I am an alert box!!".concat(getCurTime()));
    }
    function addWatchlater() {
        window.location.href = "../../models/addwatchLater.php?id=".concat(,"&time=",getCurTime());
    }



</script>



</body>
</html>

