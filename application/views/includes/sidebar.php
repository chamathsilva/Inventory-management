<?php
/**
 * Created by PhpStorm.
 * User: Smalkakulage
 * Date: 11/2/15
 * Time: 12:16 AM
 */ ?>



<ul class="nav">
    <li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
</ul>

<ul class="nav hidden-xs" id="lg-menu">
    <li class="active"><a href="userhomeOld.php"><i class="glyphicon glyphicon-list-alt"></i> My Lessons</a></li>
    <li><a onclick="loadWatchLater()"><i class="glyphicon glyphicon-list"></i> Watch Later</a></li>
    <!--ajax walin load venna hadanna-->
    <li><a onclick="loadHistory()"><i class="glyphicon glyphicon-paperclip"></i> History</a></li>
</ul>


<ul class="list-unstyled hidden-xs" id="sidebar-footer">
    <li>
        <a href=""><h3>UCSC<br>VideoBay</h3></a>
    </li>
</ul>

<!--
<ul class="nav hidden-xs">
    <div class="row">
        <li style="margin-bottom: 15px; margin-top:10px; ">Watch later</li>
        <div id="watch_later"></div>

    </div>

</ul>
-->

<!-- tiny only nav-->
<ul class="nav visible-xs" id="xs-menu">
    <li><a href="#featured" class="text-center"><i class="glyphicon glyphicon-list-alt"></i></a></li>
    <li><a href="#stories" class="text-center"><i class="glyphicon glyphicon-list"></i></a></li>
    <li><a href="#" class="text-center"><i class="glyphicon glyphicon-paperclip"></i></a></li>
    <li><a href="#" class="text-center"><i class="glyphicon glyphicon-refresh"></i></a></li>
</ul>
