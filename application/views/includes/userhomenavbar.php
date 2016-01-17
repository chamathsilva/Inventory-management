<div class="navbar navbar-blue navbar-static-top">
    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="userhomeOld.php" class="navbar-brand logo">vb</a>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
        <form class="navbar-form navbar-left" id = "search-form">
            <div class="input-group input-group-sm" id = "search-form" >
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                <div class="input-group-btn">
                    <button id="serchbut" class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>
        <ul class="nav navbar-nav">
            <li>
                <a href="userhomeOld.php"><i class="glyphicon glyphicon-home"></i> Home</a>
            </li>
            <li>
                <a  data-toggle="modal" data-target="#myModalrequest"><i class="glyphicon glyphicon-plus"></i>requset</a>
            </li>


        </ul>

        <ul class="nav navbar-nav navbar-right" style="padding-right: 20px;">



            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
                <ul class="dropdown-menu">
                    <!--<li><a href="settings_new.php">Settings</a></li>-->
                    <li><a onclick="loadSettings()">Settings</a>
                    <li><a href="logout.php">Sign Out</a></li>

                </ul>
            </li>
        </ul>
    </nav>
</div>

<!-- /top nav -->
<!---------->

<!--Request  Modal -->
<div class="modal fade" id="myModalrequest" tabindex="-1" role="dialog" aria-labelledby="myModalrequest">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalrequest">Request form</h4>
            </div>
            <div class="modal-body">

                <form class=""  id="request_form" action = "" method = "POST" >

                    <div class = "form-group">
                        <label for="offername">Topic</label>
                        <input type = "text" id = "topic" name = "topic" class="form-control" placeholder="Topic" />
                    </div>

                    <div class = "form-group">
                        <label for="address">commnent</label>
                        <textarea type = "textarea" rows="5"   id = "comment" name = "comment" class="form-control"  placeholder = "comment"></textarea>
                    </div>

                    <button type="submit" id="send_request"  style="display:none;"></button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                <button type="submit"   onclick="send_request()" class="btn btn-primary" ">send</button>
            </div>
        </div>
    </div>
</div>
