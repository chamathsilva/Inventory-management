
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UCSC VideoBay</title>


    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="../../../library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../library/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../public/css/form-elements.css">
    <link rel="stylesheet" href="../../../public/css/ucscvideobay.css">
    <link rel="stylesheet" href="../../../public/css/navbaruser.css">
    <!--<link rel="stylesheet" type="text/css" href="../../../public/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="../../../public/slick/slick-theme.css"/>

    <!-- Color Box -->
    <link rel="stylesheet" href="../../../public/css/colorbox.css" />





</head>

<body>
<div class="wrapper">
    <div class="box">
        <div class="row row-offcanvas row-offcanvas-left">
            <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
                <!-- side bar -->
                <?php

                include '../../views/includes/sidebar.php';
                ?>
            </div>
            <!-- main right col -->
            <div class="column col-sm-10 col-xs-11" id="main">
                <?php
                include '../includes/userhomenavbar.php';
                ?>


                <div class="full ">
                    <div id="feedback"> </div>

                    <div class="col-sm-12 text">
                        <h3 id="topic">Watch history</h3>
                    </div>


                    <div class="col-sm-12 text">
                        <div id="results"></div>
                    </div>

                    <div class="col-sm-12 text " id="loadmore" style="margin-bottom: 20px;">
                        comment: methanat scroll venna hadanna sunimal
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>





<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="../../../public/js/ucscvideobay.js"></script>
<script src="../../../public/js/userhome.js"></script>
<!--<script type="text/javascript" src="../../../public/slick/slick.min.js"></script>





<!--<script src="../../../../../UCSCpresent/new/js/scripts.js"></script>-->


<?php $total_pages = 1;?>

<script type="text/javascript">
    function load_history() {

        $("#loadmore").html('<div align="center"><button class="load_more" id="load_more_button">load More</button> <div class="animation_image" style="display:none;"><img src="ajax-loader.gif"> Loading...</div> </div>');


        var track_click = 0; //track user click on "load more" button, righ now it is 0 click

        var total_pages = <?php echo $total_pages; ?>;
        $('#results').load("../../models/fetch_history.php", {'page':track_click}, function() {track_click++;}); //initial data to load

        $(".load_more").click(function (e) { //user clicks on button

            $(this).hide(); //hide load more button on click
            $('.animation_image').show(); //show loading image

            if(track_click <= total_pages) //make sure user clicks are still less than total pages
            {
                //post page number and load returned data into result element
                $.post('../../models/fetch_history.php',{'page': track_click}, function(data) {

                    $(".load_more").show(); //bring back load more button

                    $("#results").append(data); //append data received from server

                    //scroll page to button element
                    $("html, body").animate({scrollTop: $("#load_more_button").offset().top},500);

                    //hide loading image
                    $('.animation_image').hide(); //hide loading image once data is received

                    track_click++; //user click increment on load button

                }).fail(function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError); //alert any HTTP error
                    $(".load_more").show(); //bring back load more button
                    $('.animation_image').hide(); //hide loading image once data is received
                });


                if(track_click >= total_pages-1)
                {
                    //reached end of the page yet? disable load button
                    $(".load_more").attr("disabled", "disabled");
                    $(".load_more").html("<div class='all_loaded'>No More Content to Load</div>");

                }

            }

        });
    }
</script>

<script>

    load_history();
    function deletehistory(id){
        var r = confirm("Are you sure !" + id);
        if (r == true) {
            var m_data = new FormData();
            m_data.append('id', id);

            $("#results").html("chamath");
            //Ajax post data to server
            $.ajax({
                url: '../../models/delete_history.php',
                data: m_data,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    //load json data from server and output message
                    if (response.type == "text") {
                        $("#feedback").html(response.text);
                    } else {
                        $("#feedback").html(response.text);

                    }
                    load_history();


                }
            });
        }

    }
</script>


</body>
</html>

