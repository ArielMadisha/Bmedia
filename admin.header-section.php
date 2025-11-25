<!-- header-starts -->
<div class="header-section">
  <!--toggle button start-->
  <a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
  <!--toggle button end-->
  <!--notification menu start -->
  <div class="menu-right">
    <div class="profile_details">
      <div class="col-md-4 serch-part">
        <div id="sb-search" class="sb-search">
          <form action="search" method="post">

            <input class="sb-search-input" placeholder="Search" type="search" name="search" id="search">
            <input class="sb-search-submit" type="submit" value="">
            <span class="sb-icon-search"> </span>
          </form>
        </div>
      </div>
      <!-- search-scripts -->

      <script src="<?php echo $root;?>/js/classie.js"></script>
      <script src="<?php echo $root;?>/js/uisearch.js"></script>
      <script>
        new UISearch(document.getElementById('sb-search'));
      </script>
      <!-- //search-scripts -->
      <!---->
      <div class="col-md-3 player">
        <div class="audio-player">
          <audio id="audio-player" controls="controls">
            <source src="<?php echo $root;?>/media/MOEMEDI KE SETHUBA-MAJWE.mp3" type="audio/mpeg">
          </audio>
        </div>
        <!---->
        <script type="text/javascript">
          $(function() {
            $('#audio-player').mediaelementplayer({
              alwaysShowControls: true,
              features: ['playpause', 'progress', 'volume'],
              audioVolume: 'horizontal',
              hideVolumeOnTouchDevices: true,
              iPadUseNativeControls: false,
              iPhoneUseNativeControls: false,
              AndroidUseNativeControls: false
            });
          });
        </script>
        <!--audio-->
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo $root;?>/css/audio.css">
        <script type="text/javascript" src="<?php echo $root;?>/js/mediaelement-and-player.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $root;?>/css/player.css">
        <!---->

        <!--//-->
        <ul class="next-top">
          <li>
            <a class="repeat" id="repeat" onclick="loop()" href="#"> <span id="r_btn" class="glyphicon glyphicon-repeat pointer"></span></a>
          </li>
          
          <li>
            <a class="ar" id="ar" onclick="nextSong(-1)" href="#"> <img src="<?php echo $root;?>/images/arrow.png" alt="" /></a>
          </li>

          <li>
            <a class="ar2" id="ar2" onclick="nextSong(1)" href="#"><img src="<?php echo $root;?>/images/arrow2.png" alt="" /></a>
          </li>

          <li>
            <a class="shuffle" id="shuffle" onclick="shuffle()" href="#"><span id="s_btn" class="glyphicon glyphicon-random pointer"></span></a>
          </li>

        </ul>
      </div>

      <div class="col-md-9 login-pop">
        <div id="loginpop">
<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <span><i class="glyphicon glyphicon-th"></i>
    </button>
    <ul class="dropdown-menu">
    <?php if (!isset($_SESSION['logged_in'])) { ?>
      <li><a href="#" id="loginButton"><i class="glyphicon glyphicon-log-in"></i> Log in</a></li>
    

      <li><a href="#" data-toggle="modal" data-target="#myModal5"><i class="glyphicon glyphicon-user"></i> Register</a></li>
      <?php } ?>
      <?php if (isset($_SESSION['isAdmin'])) { ?>
      <li><a href="<?php echo $root;?>/admin"><i class="glyphicon glyphicon-tasks"></i> Dashboard</a></li>
      <?php } ?>
      <?php if (isset($_SESSION['logged_in'])) { ?>
      <li class="divider"></li>
      <li><a href="#" onclick="logout()"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
      <?php } ?>
    </ul>
    </ul>
  </div>
  <?php if (!isset($_SESSION['logged_in'])) { ?>
           <!--  <a class="top-sign" href="#" data-toggle="modal" data-target="#myModal5">
              <i class="fa fa-sign-in"></i>
            </a> -->

            <div id="loginBox">
              <div id="loginForm">
              <div class="radio">
  <label><input type="radio" name="admin" id="admin" value="1">Admin</label>
</div>  
<div class="radio">
  <label><input type="radio" name="admin" value="2" id="admin" checked>User / Publisher</label>
</div>

                <fieldset id="body">
                
                  <fieldset>
                    <!-- <label for="email">Email Address / Mobile No</label>
                    <input type="text" name="email" id="email"> -->
                    <div class="input-group margin-bottom-sm">
  <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
  <input class="form-control" type="text" placeholder="Email / Mobile" name="email" id="email">
</div>
                  </fieldset>
                  <fieldset>
                    <!-- <label for="password">Password</label>
                    <input type="password" name="password" id="password"> -->
                    <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                <input class="form-control" type="password" placeholder="Password" name="password" id="password">
              </div>
                  </fieldset>
                  <div id="msg" style="padding-bottom:15px; color: red;"></div>
                  <button type="submit" onclick="login()" id="login">Sign in</button>
                  <label for="checkbox">
                    <input type="checkbox" id="checkbox"> <i>Remember me</i></label>
                </fieldset>
                <span style="margin-bottom:10px"><a href="#" id="forgotPass"  data-toggle="modal" data-target="#forgotPassModal">Forgot your password?</a></span>
              </div>
            </div>

            <?php } else { ?>
            <!-- <a href="<?php echo $root;?>/admin"><span>Dashboard</span></a>
              <a href="#" onclick="logout()"><span>Logout</span></a> -->
              <?php } ?>

        </div>
      </div>

      <div class="clearfix"> </div>
    </div>
    <!---->
  </div>
  <div class="clearfix"></div>
  <div id="nowplaying" style="text-align: center; display: none; font-size: 85%; width: 80%"></div>
</div>

<!--notification menu end -->
<!-- //header-ends -->