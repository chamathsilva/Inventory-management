<?php
/**
 * Created by PhpStorm.
 * User: Smalkakulage
 * Date: 1/9/16
 * Time: 4:13 AM
 */ ?>


<?php
/**
 * Created by PhpStorm.
 * User: Smalkakulage
 * Date: 11/2/15
 * Time: 12:04 AM
 */ ?>

<div class="navbar navbar-blue navbar-static-top">
    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand"> VideoBay </a>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="../../../index.php" >Home</a></li>
            <li><a href="../../../about.php" >About</a></li>
            <li><a href="../../../about.php">Help</a></li>
            <li class="dropdown" style="padding-right: 20px;">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign in</a>
                <div class="dropdown-menu " style="padding: 15px; padding-bottom:  0px;">
                    <div class="feederror">error password</div>
                    <form method="post" action="login" accept-charset="UTF-8">
                        <input style="margin-bottom: 15px;" type="text" placeholder="Username" id="username" name="username">
                        <input style="margin-bottom: 15px;" type="password" placeholder="password" id="password" name="password">
                        <input style="float: left; margin-right: 10px;" type="checkbox" name="remember-me" id="remember-me" value="1">
                        <label class="string optional" for="user_remember_me">Remember me</label>
                        <input class="btn btn btn-success" type="submit" id="sign-in" value="Sign In">
                    </form>

                </div>

            </li>

        </ul>
    </nav>
</div>
<!-- /top nav -->