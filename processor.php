<?php
require 'top-section.php';
//print_r($_SESSION);
?>

<div class="player_new" style="display:none">
    <div class="audio-player">
		<h1 id="nowplaying">G7-1</h1>
		<img class="cover" style="" src="<?php echo $_SESSION['root'] ?>/content/song/imgs/48c084debcec7d5889a5c714490c8cb4e4354ab54df5abc05de8342f83689527ec95166.jpg" alt="">
		<audio id="audio-player" src="<?php echo $_SESSION['root'] ?>/media/G7-1.mp3" type="audio/mp3" controls="controls"
		ontimeupdate="updateTrackTime(this);"></audio>
	</div>
	<div id="currentTime">0:00</div>
    <div id="duration">0:00</div>
	
	<script>
		$(document).ready(function() {
			$('#audio-player').mediaelementplayer({
				alwaysShowControls: true,
				features: ['playpause','volume','progress'],
				audioVolume: 'horizontal',
				audioWidth: 400,
				audioHeight: 120,
				hideVolumeOnTouchDevices: false,
                iPadUseNativeControls: false,
                iPhoneUseNativeControls: false,
                AndroidUseNativeControls: false
			});
		});
		
		function updateTrackTime(track){
          var currTimeDiv = document.getElementById('currentTime');
          var durationDiv = document.getElementById('duration');
        
          var currTime = Math.floor(track.currentTime).toString(); 
          var duration = Math.floor(track.duration).toString();
        
          currTimeDiv.innerHTML = formatSecondsAsTime(currTime);
        
          if (isNaN(duration)){
            durationDiv.innerHTML = '00:00';
          } 
          else{
            durationDiv.innerHTML = formatSecondsAsTime(duration);
          }
        }
		
		function formatSecondsAsTime(secs, format) {
          var hr  = Math.floor(secs / 3600);
          var min = Math.floor((secs - (hr * 3600))/60);
          var sec = Math.floor(secs - (hr * 3600) -  (min * 60));
        
          if (min < 10){ 
            min = "0" + min; 
          }
          if (sec < 10){ 
            sec  = "0" + sec;
          }
        
           return min + ':' + sec;
        }
	</script>
          
        
        <script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/2.10.0/mediaelement-and-player.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $root;?>/css/player.css">
        <script async  src="<?php echo $root; ?>/js/multimedia.js"></script>
        
        
        <ul class="next-top">
          
          <li>
            <a class="ar" id="ar" onclick="nextSong(-1)" href="#"> <img src="<?php echo $root;?>/images/arrow.png" alt="" /></a>
          </li>

          <li>
            <a class="ar2" id="ar2" onclick="nextSong(1)" href="#"><img src="<?php echo $root;?>/images/arrow2.png" alt="" /></a>
          </li>
		  <li class="repete-ixons"><a class="repeat" id="repeat" onclick="loop()" href="javascript:"> <span id="r_btn" class="glyphicon glyphicon-repeat pointer"></span></a></li>
		  <li class="shuffle-icons"><a class="shuffle" id="shuffle" onclick="shuffle()" href="javascript:"><span id="s_btn" class="glyphicon glyphicon-random pointer"></span></a></li>

        </ul>
      </div>
<!-- <link rel="stylesheet" type="text/css" href="js/jssocials-1.4.0/jssocials.css" />
<link rel="stylesheet" type="text/css" href="js/jssocials-1.4.0/jssocials-theme-flat.css" /> -->

<?php
$downloadable = '';
$access_level = '';
$album_cover = '';
$artist_cover ='';
$artist_name;

if (array_key_exists('id', $_GET) && strlen($_GET['id']) == 15) {
    $url_release_id = $_GET['id'];
    $url_release_id = mysqli_real_escape_string($connection, $url_release_id);

    if (page_type() == 'Song') {
        if (loggedIn() && linked_item_exists($url_release_id, 'song')) {
            $query = "SELECT * ,DATE_FORMAT(release_date, '%d %M %Y') AS d FROM songs LEFT JOIN artists USING(artist_id) WHERE song_id = '$url_release_id'";
        } else {
            $query = "SELECT * ,DATE_FORMAT(release_date, '%d %M %Y') AS d FROM songs LEFT JOIN artists USING(artist_id) WHERE song_id = '$url_release_id' AND status = 'live'";
        }

        $results = mysqli_query($connection, $query) or die("error:83");

        if (mysqli_num_rows($results) > 0) {

            $row = mysqli_fetch_assoc($results);
            extract($row);
            $access_level = $content_access;
            $dlb = '';
            if ($downloadable == 'yes') {
                $dlb = ' [Free Download] ';
            }

            echo '<title>' . $artist_name . ' - ' . $song_name . $dlb . ' | bMedia</title>';
        } else {
            echo '<title>bMedia Entertainment</title>';
        }
    } else if (page_type() == 'Album') {
        if (loggedIn() && linked_item_exists($url_release_id, 'album')) {
            $query = "SELECT album_name, price, label, album_id, album_artist, artist_id, genre_id, album_cover_path, artist_name, content_access, DATE_FORMAT(release_date, '%d %M %Y') AS d FROM albums LEFT JOIN artists USING(artist_id) WHERE album_id = '$url_release_id'";
        } else {
            $query = "SELECT album_name, price, label, album_id, album_artist, artist_id, genre_id, album_cover_path, artist_name, content_access, DATE_FORMAT(release_date, '%d %M %Y') AS d FROM albums LEFT JOIN artists USING(artist_id) WHERE status = 'live' AND album_id = '$url_release_id'";
        }

        $results = mysqli_query($connection, $query) or die("Error 1021"/*.mysqli_error($connection)*/);

        if (mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                extract($row);

                $access_level = $content_access;
                $url_album_name = clean_name($album_name);
                $album_cover = 'content/album/' . $album_cover_path;

                $link = 'album/' . $album_id . '/' . $url_album_name . '/';
                echo '<title>' . $album_id . ' - ' . $album_name . ' | bMedia</title>';
            }
        } else {
            echo '<title>bMedia Entertainment</title>';
        }
    } else if (page_type() == 'Artist') {
        # code...
        // $query = "SELECT * ,DATE_FORMAT(release_date, '%d %M %Y') AS d FROM songs LEFT JOIN artists USING(artist_id) WHERE song_id = '$url_release_id' AND status = 'live'";
        $query = "SELECT * FROM artists WHERE artist_id = '$url_release_id'";
    $results = mysqli_query($connection, $query) or die("Error 1022" /*. mysqli_error($connection)*/);

        if (mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                extract($row);

                // $access_level = $content_access;
                $url_artist_name = clean_name($artist_name);
                $artist_cover = 'content/artist/artist_images/' . $artist_image_path;

                $link = 'artist/' . $artist_id . '/' . $url_artist_name . '/';
                echo '<title>' . $artist_id . ' - ' . $artist_name . ' | bMedia</title>';
            }
        } else {
            echo '<title>bMedia Entertainment</title>';
        }
    }
} else {
    //id/key does not exists
    echo '<title>bMedia Entertainment</title>';
}
$album_cover_new = $_SESSION['root'].'/'.$album_cover;
if (mysqli_num_rows($results) > 0) {
    $btn_number = 1;
    if (page_type() == 'Artist') {
        echo '<div class="col-sm-4 col-one" style="margin-top:5px;">';
        echo '<div class="thumbnail" style="padding-bottom:0px;">';
        require 'template/php/artist_info.php';

        echo '</div>';
        echo '</div>';
    } else    if (page_type() == 'Song') {
        // extract($row);
        require 'template/php/primary_artists.php';
        //         echo<<<MS
        //                 <script>
        //                 $('#nav_msg').text('$song_name by $artist_name $other_primary_artist');
        //                 </script>
        // MS;

        echo '<div class="col-sm-4 col-one" style="margin-top:5px;">';
        echo '<div class="thumbnail" style="padding-bottom:0px;">';
        require 'template/php/song_info_and_buttons.php';

        echo '</div>';
        echo '</div>';
    } elseif (page_type() == 'Album') {
        echo '<div class="col-sm-4 col-one" style="margin-top:5px;">';
        echo '<div class="thumbnail" style="padding-bottom:0px;">';
        require 'template/php/album_info_and_buttons.php';

        echo '</div>';
        echo '</div>';

        echo '<div class="col-sm-8" style="margin-top:5px;">';
        echo '<h3 style="background-color: gainsboro;padding-left: inherit;">Album Songs</h3>';


        $query = "SELECT song_name, file_path, item_id, duration, artist_name FROM songs LEFT JOIN artists USING(artist_id) WHERE album_id = '$url_release_id' ORDER BY song_added_on";

        $results = mysqli_query($connection, $query) or die("Error 1021");

        if (mysqli_num_rows($results) > 0) {
            echo <<<A
<div class="table-responsive">
<table class="table table-bordered">
            <thead>
            <tr>
            <th class="text-white">#</th>
            <th class="text-white">Song <span class="glyphicon glyphicon-play"></span></th>
            <th class="text-white">Artists</th>
            <th class="text-white">Duration</th>
            </tr>
            </thead>
            <tbody>
A;

            $i = 1;
            $songs = '';
            while ($row = mysqli_fetch_assoc($results)) {
                extract($row);
                $songs .= '"' . $i . '" : {"name" : "' . $song_name . '", "artist" : "' . $artist_name . '", "mp3" : "'.$_SESSION['root'] .'/content/song/' . $file_path . '" },';
                echo <<<A
                <tr>
                <td class="text-white">$i</td>
                <td><a onclick="play('$item_id', '$file_path', '$song_name', '$artist_name', 'album','$album_cover_new')" class="pointer">$song_name</a></td>
                <td class="text-white">$artist_name</td>
                <td class="text-white">$duration</td>
                </tr>
A;
                $i++;
            }
            $totalSongs = $i - 1;
            echo <<<PL
<script>

    songs = { $songs };
    
     play_type = 'album';
    totalSongs = $totalSongs;

</script>
PL;
        }

        echo <<<A
</tbody>
</table>
</div>
A;
    }

    $url_release_id;
    $page_url = '';
    $page_id = '';

    $url = $root . $_SERVER['REQUEST_URI'];

    //js-socials share
    // echo '<div id="share"></div>';

    //insert disqus comments
    show_disqus_comments($url, $page_id);

    // display some featured albums and some more stuff 

} else {
    error();
}
?>

<!--share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Share Link</h4>
            </div>
            <div class="modal-body grey" style="text-align: center;">
                <div id='link'> <?php echo $url ?> </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
require 'bottom-section.php';
?>

<!-- <script src="js/jssocials-1.4.0/jssocials.min.js"></script> -->
<script>
    //    $("#share").jsSocials({
    //     shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
    //});
    
    var root = '<?php echo $_SESSION['root'] ?>';

    function like_dislike(btn_name, song_id, action_) {
        
        $.post(root+'/template/php/like_dislike.php', {
                song_identity: song_id,
                action: action_,
                l_d: 'yes'
            }, function(data) {
                var res = btn_name.split("_");
                //alert('#btn_dislike_'+res[2]);
                if(action_ == 'like')
                {
                    $('#btn_like_1').attr('disabled', true);
                    $('#btn_dislike_2').attr('disabled', false);
                    $('#btn_like_'+res[2]).css('color', 'blue');
                    var lcount  = $('#like_no_'+res[2]).html();
                    $('#btn_dislike_2').css('color', '');
                    var lcount  = parseInt(lcount) +1;
                    
                    $.post(root+'/template/php/like_dislike_count.php', {
                            status: 'unlike',
                            song_identity: song_id,
                        }, function(data) {
                            $('#like_no_'+res[2]).html(lcount);
                            $('#dislike_no_2').html(data);
                    } );      
                    
                }
                else
                {
                   $('#btn_like_1').attr('disabled', false);
                   $('#btn_dislike_2').attr('disabled', true); 
                   $('#btn_dislike_'+res[2]).css('color', 'blue');
                   var lcount  = $('#dislike_no_'+res[2]).html();
                   var lcount  = parseInt(lcount) +1;
                   $('#btn_like_1').css('color', '');
                   
                    $.post(root+'/template/php/like_dislike_count.php', {
                            status: 'like',
                            song_identity: song_id,
                        }, function(data) {
                            $('#dislike_no_'+res[2]).html(lcount);
                           $('#like_no_1').html(data);
                    } );  
                }
                
            },
            'text');
    }
    
    function like_dislike_song(btn_name, song_id, action_) {
        $.post(root+'/template/php/like_dislike_song.php', {
                song_identity: song_id,
                action: action_,
                l_d: 'yes'
            }, function(data) {
                //$('button[name=' + btn_name + ']').attr('disabled', true);
                var res = btn_name.split("_");
                //alert('#btn_dislike_'+res[2]);
                
                 if(action_ == 'like')
                {
                    $('#btn_like_1').attr('disabled', true);
                    $('#btn_dislike_2').attr('disabled', false);
                    $('#btn_like_'+res[2]).css('color', 'blue');
                    var lcount  = $('#like_no_'+res[2]).html();
                    $('#btn_dislike_2').css('color', '');
                    var lcount  = parseInt(lcount) +1;
                    
                    $.post(root+'/template/php/like_dislike_sogns_count.php', {
                            status: 'unlike',
                            song_identity: song_id,
                        }, function(data) {
                            $('#like_no_'+res[2]).html(lcount);
                            $('#dislike_no_2').html(data);
                    } );      
                    
                }
                else
                {
                   $('#btn_like_1').attr('disabled', false);
                   $('#btn_dislike_2').attr('disabled', true); 
                   $('#btn_dislike_'+res[2]).css('color', 'blue');
                   var lcount  = $('#dislike_no_'+res[2]).html();
                   var lcount  = parseInt(lcount) +1;
                   $('#btn_like_1').css('color', '');
                   
                    $.post(root+'/template/php/like_dislike_sogns_count.php', {
                            status: 'like',
                            song_identity: song_id,
                        }, function(data) {
                            $('#dislike_no_'+res[2]).html(lcount);
                            $('#like_no_1').html(data);
                    } );  
                }
                
            },
            'text');
    }
</script>

<?php

require 'closing-section.php';

function error()
{
    $item = page_type();
    $root = $_SESSION['root'];

    echo <<<ERROR
    <div class="error-top">
        <img src="images/pic_error.png" alt="Error" />
        <h3>$item Not Found...<h3>
        <div class="clearfix"></div>
        
        <div class="error">
            <a class="not" href="$root">Back To Home</a>
        </div>
    </div>
ERROR;
}

function page_type()
{
    $item = '';

    if (strpos($_SERVER['REQUEST_URI'], 'song') !== false) {
        $item = 'Song';
    } elseif (strpos($_SERVER['REQUEST_URI'], 'artist') !== false) {
        $item = 'Artist';
    } elseif (strpos($_SERVER['REQUEST_URI'], 'album') !== false) {
        $item = 'Album';
    } elseif (strpos($_SERVER['REQUEST_URI'], 'video') !== false) {
        $item = 'Video';
    }

    return $item;
}

function show_disqus_comments($url, $page_id)
{
    if ($_SERVER['SERVER_ADDR'] != '127.0.0.1') {
        echo <<<DIS
    <div id="disqus_thread"></div>
    <script>

    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

    var disqus_config = function () {
    //this.page.url = '$url';  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = '$page_id' // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };

    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://bammuso-online.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
DIS;
    }
}
