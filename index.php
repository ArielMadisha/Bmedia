<?php 
/* echo $_SERVER['SERVER_NAME'];
echo "<br>";exit;
echo env('URL');exit; */
// $ip = getenv('URL');echo $ip;exit;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'top-section.php'; 

$root   =   $_SESSION['root'];
?>
<script src="<?php echo $root;?>/js/responsiveslides.min.js"></script>
        <script >
            // You can also use "$(window).load(function() {"
            $(function() {
                // Slideshow 4
                $("#slider4").responsiveSlides({
                    auto: true,
                    pager: true,
                    nav: true,
                    speed: 500,
                    namespace: "callbacks",
                    before: function() {
                        $(".events").append("<li>before event fired.</li>");
                    },
                    after: function() {
                        $(".events").append("<li>after event fired.</li>");
                    }
                });

            });
			$("#home").removeClass("nav-hover");
        </script>
        
<!--<audio id="audioFrenata"  controls="controls">
    <source src="http://www.w3schools.com/html/horse.ogg" type="audio/ogg">
    <source src="http://www.w3schools.com/html/horse.mp3" type="audio/mpeg">
</audio>-->
    <div class="music-left">
        <div id="trending" class="">
		<?php 	

		$isActiveAds=[];
		$queryadpage="SELECT title,url,image from advertisment where status ='1' order by position";
		 // echo $queryadpage; exit;
		$resultsListAds = mysqli_query($connection, $queryadpage);
		$isActiveAds=$resultsListAds->fetch_all(MYSQLI_BOTH);
		$div_li = '';
		foreach($isActiveAds as $v){
			 
			$display_img= $v['image'];
			$ad_url= $v['url'];
			$ad_title= $v['title'];

			$div_li .='<li> 
						<div class="banner-img"> 
							<img src="'. $display_img . '" class="img-responsive" alt=""> 
						</div>
						<div class="banner-info"> 
							<a class="trend" target="_blank" href="'. $ad_url . '">TRENDING MUSIC <br>2020</a>
							<h3 class="p-13">G 7</h3> <p class="p-13">Album by <span>'.$ad_title.'</span></p>
						</div>
						</li>';
		} 
		
		echo $a='<div class="banner-section animated fadeInDown"><div class="banner">
				<div class="callbacks_container"> 
					<ul class="rslides callbacks callbacks1" id="slider4">'.$div_li.'</ul>
			</div>
			<div class="clearfix"> </div>
			</div>
		</div>';
		
		?>
		
		</div>
        <!--<div id="song_pager" hidden>
            <button id="prev_releases" onclick="get_new_releases('prev', 'n')" class="btn pager-btn">&Lt;</button>
            <label id="releases_page_n" class="page-n"></label>
            <button id="next_releases" onclick="get_new_releases('next', 'n')" class="btn pager-btn">&Gt;</button>
        </div>-->
    </div>
    <!--
		<div class="music-right">
			<div id="vi"></div> 
		</div>
	-->  
	<div class="clearfix"></div>
<div class="inner-content" id="page_content">  

<!-- Category -->
<div class="row categories-new">
<div class="tittle-head new-title">
<center><h3 class="tittle"> Category<!--<a href="/projects/bmedia/songs/" target="_blank"> <span class="new">View More</span> </a>--></h3></center>
  </div>
  
  <div class="clearfix"></div>
<div id="songs_div" class="col-md-3 animated fadeInDown"><!--content-grid -->
  <img class="" src="<?php echo $root.'/images/songs.jpg';?>" title="IPHC Jerusalem Lives - kwakwariri" style="width:100%; border-radius: 10px 10px 0px 0px;">

  <div class="heading-bottom-click" style="border-radius: 0px 0px 10px 10px;">
	  <span title="IPHC Jerusalem Lives" style="padding-top: 3px;">Songs</span> 
	   <a  href="<?php echo $_SESSION['root'];?>/songs" ><span class="new">View More</span></a>
	   <div class="clearfix"></div>
  </div>
  
  <div class="btn-group" style="margin-top:10px;width: 100%">
  
    <a type="button" class="btn btn-default btn-sm grey" href="#" ><span class="glyphicon glyphicon-share"></span></a>
    
    <button type="button" class="btn btn-default btn-sm grey" ><span class="glyphicon glyphicon-play-circle pointer"></span></button>
  </div>

</div>



<div id="songs_div" class="col-md-3 animated fadeInDown"><!--content-grid -->
  <img class="" src="<?php echo $root.'/images/allbum.jpg';?>" title="IPHC Jerusalem Lives - kwakwariri" style="width:100%; border-radius: 10px 10px 0px 0px;">

  <div class="heading-bottom-click" style="border-radius: 0px 0px 10px 10px;">
	  <span title="IPHC Jerusalem Lives" style="padding-top: 3px;">Albums</span> 
	   <a  href="<?php echo $_SESSION['root'];?>/albums" ><span class="new">View More</span></a>
	   <div class="clearfix"></div>
  </div>
  
  <div class="btn-group" style="margin-top:10px;width: 100%">
    <a type="button" class="btn btn-default btn-sm grey" href="#" ><span class="glyphicon glyphicon-share"></span></a>
    <button type="button" class="btn btn-default btn-sm grey" ><span class="glyphicon glyphicon-play-circle pointer"></span></button>
  </div>

</div>



<div id="songs_div" class="col-md-3 animated fadeInDown"><!--content-grid -->
  <img class="" src="<?php echo $root.'/images/artists.jpg';?>" title="IPHC Jerusalem Lives - kwakwariri" style="width:100%; border-radius: 10px 10px 0px 0px;">

  <div class="heading-bottom-click" style="border-radius: 0px 0px 10px 10px;">
	  <span title="IPHC Jerusalem Lives" style="padding-top: 3px;">Artists</span> 
	   <a  href="<?php echo $_SESSION['root'];?>/artists" ><span class="new">View More</span></a>
	   <div class="clearfix"></div>
  </div>
  
  <div class="btn-group" style="margin-top:10px;width: 100%">
  
    <a type="button" class="btn btn-default btn-sm grey" href="#" ><span class="glyphicon glyphicon-share"></span></a>
    
    <button type="button" class="btn btn-default btn-sm grey"><span class="glyphicon glyphicon-play-circle pointer"></span></button>
  </div>

</div>



<div id="songs_div" class="col-md-3 animated fadeInDown"><!--content-grid -->
  <img class="" src="<?php echo $root.'/images/videos.jpg';?>" title="IPHC Jerusalem Lives - kwakwariri" style="width:100%; border-radius: 10px 10px 0px 0px;">

  <div class="heading-bottom-click" style="border-radius: 0px 0px 10px 10px;">
	  <span title="IPHC Jerusalem Lives" style="padding-top: 3px;">Videos</span> 
	   <a  href="<?php echo $_SESSION['root'];?>/videos" ><span class="new">View More</span></a>
	   <div class="clearfix"></div>
  </div>
  
  <div class="btn-group" style="margin-top:10px;width: 100%">
  
    <a type="button" class="btn btn-default btn-sm grey" href="#" target="_blank"><span class="glyphicon glyphicon-share"></span></a>
    
    <button type="button" class="btn btn-default btn-sm grey" ><span class="glyphicon glyphicon-play-circle pointer"></span></button>
  </div>

</div>

</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-lg-12">
		<figure>
			<div class="imagesContainer">
				<img src='https://bmedia.online/images/design-01.jpg' alt=''>
				<!--<img class="fadeInClass" src='https://bmedia.online/images/design-02.jpg' alt=''>-->
			</div>
		</figure>
	</div>
</div>

<div class="clearfix"></div>

<!-- Songs -->
<?php 
/*--------------------------------------------------------------
 Name : Swapnil Acme
 Description : Lates release Songs
 Date : 05/10/2020
----------------------------------------------------------------*/
?>
<div class="row songs-section">
    <div class="col-lg-12">
        <div class="tittle-head new-title">
            <h3 class="tittle pull-left"> Songs </h3>
            <a href="/songs/" target="_blank" class="pull-right" style="margin-top: 3px;"> <span class="new" style=" font-size: 16px;">View More</span> </a>
        </div>
  </div>
<div class="clearfix"></div>
  
<?php 
$query = "SELECT * ,DATE_FORMAT(release_date, '%d %M %Y') AS d FROM songs LEFT JOIN artists USING(artist_id)
WHERE status = 'live' AND songs.deleted = '0' ORDER BY songs.song_added_on DESC limit 6";
// WHERE status = 'live' AND songs.deleted = '0' ORDER BY songs.song_added_on DESC LIMIT 8";
$results = mysqli_query($connection, $query) or die("Error 1021");
// $results = mysqli_query($connection, $query) or die("Error 1021" . mysqli_error($connection));
$songs = '';
 $i = 1;
if (mysqli_num_rows($results) > 0) {
  $btn_number = 0;
  while ($row = mysqli_fetch_assoc($results)) {
      extract($row);
      
    $artist_names_length = strlen($artist_name);
    //  $full_artist_name = $artist_name;
    $short_artist_name = $artist_name;
    //  $artist_names_length = strlen($other_primary_artist . ' & ' . $artist_name);
	$url_song_name = clean_name($song_name);
	$link = $root . '/song/' . $song_id . '/' . $url_song_name . '/';
	$add_to_card = in_array($content_access, [1, 2]) ? "<button type=\"button\" class=\"btn btn-primary btn-sm grey new-style-bbbtn\" name=\"btn_add_to_cart_$btn_number\" id=\"btn_add_$btn_number\" onclick=\"add_to_cart('$song_id','song')\"> <span  class=\"glyphicon glyphicon-shopping-cart\">  R$song_price</span></button>" : "";

    if ($artist_names_length > 15) {

      while ($artist_names_length > 15) {
        $short_artist_name = substr_replace($short_artist_name, '', -1);
        // $other_primary_artist = substr_replace($other_primary_artist, '', -1);
        $artist_names_length--;
      }

      // $other_primary_artist = substr_replace($other_primary_artist, '...', -3);
      $short_artist_name .= ' ...';
    } else {
      $short_artist_name = $artist_name;
    }

    $song_names_length = strlen($song_name);
    // $full_artist_name = $artist_name;
    $short_song_name = $song_name;

    if ($song_names_length > 14) {

      while ($song_names_length > 14) {
        $short_song_name = substr_replace($short_song_name, '', -1);
        $song_names_length--;
      }

      $short_song_name .= ' ...';
    } else {
      $short_song_name = $song_name;
    }
    
    $songs .= '"' . $i . '" : {"name" : "' . $song_name . '", "artist" : "' . $artist_name . '", "mp3" : "'.$_SESSION['root'] .'/content/song/' . $file_path . '", "artist_pic" : "'.$_SESSION['root'] .'/content/song/' . $cover_path . '" },';
  //             
?>
  <!--onclick="play('<?php //echo $item_id; ?>', '<?php //echo $file_path?>', '<?php //echo $song_name?>', '<?php //echo $artist_name ?>', 'album','<?php // $root.'/content/song/'.$cover_path ?>')" src="<?php //echo $root.'/content/song/'.$cover_path ?>" title="<?php //echo $artist_name.' - '.$song_name;  ?>"-->
<div id="songs_div" class="col-md-2 animated fadeInDown">
<a href="<?php echo $link; ?>">
  <img style="width:100%; min-height: 200px; max-height: 200px;" src="<?php echo $root.'/content/song/'.$cover_path ?>" title="<?php echo $artist_name.' - '.$song_name;  ?>"  class="pointer" >
  <?php echo $add_to_card; ?>
		<div class="song_inf"> 
			<span id="artist_name" title="<?php echo $artist_name?>"><?php echo $short_artist_name;?></span> <br>
			<span id="song_name" title="<?php echo $short_song_name?>"><?php echo $short_song_name?></span>
		</div></a>
  <div class="heading-bottom-click" style="display:none;">
	  <span title="IPHC Jerusalem Lives">Songs</span> 
	   <a  href="#" target="_blank"><span class="new">View More</span></a>
	   <div class="clearfix"></div>
  </div>
  
  <div class="btn-group" style="margin-top:10px;width: 100%">
    <a type="button" class="btn btn-default btn-sm grey" href="#" target="_blank"><span class="glyphicon glyphicon-share"></span></a>
     <button type="button" class="btn btn-default btn-sm grey" ><span class="glyphicon glyphicon-play-circle pointer"></span></button>
  </div>

</div>
<?php 
      $i++;
  }
    $totalSongs = $i - 1;
}?>
</div>

<div class="clearfix"></div>
<?php 
/*--------------------------------------------------------------
 Name : Swapnil Acme
 Description : Featured albums
 Date : 05/10/2020
----------------------------------------------------------------*/
?>
<!-- Featured Albums -->
<div class="row featured-section">
<div class="col-lg-12">
<div class="tittle-head new-title">
<h3 class="tittle pull-left" style="margin-top: -6px; margin-bottom: 0;"> Featured Albums </h3>
<a href="/albums/" target="_blank" class="pull-right" style="margin-top: 3px;"> <span class="new" style=" font-size: 16px;">View More</span> </a>
  </div>
  </div>
  
  <div class="clearfix"></div>
<?php 
$query = "SELECT album_name, album_id, album_artist, album_cover_path, DATE_FORMAT(release_date, '%d %M %Y') AS d FROM albums WHERE status = 'live' 
            ORDER BY albums.date_added DESC LIMIT 6";
$results = mysqli_query($connection, $query) or die("Error 1021");

if (mysqli_num_rows($results) > 0) {
  while ($row = mysqli_fetch_assoc($results)) {
    extract($row);

   $url_album_name = clean_name($album_name);
   $album_cover = $root.'/content/album/'.$album_cover_path;

   $link = $root.'/album/'.$album_id.'/'.$url_album_name .'/';

   $album_name_length = strlen($album_name);
   $short_album_name = $album_name;

   if ($album_name_length > 13) {
    while ($album_name_length > 13) {
        $short_album_name = substr_replace($short_album_name, '', -1);
        $album_name_length--;
    }
    $short_album_name .= ' ...';
  } else {
    $short_album_name = $album_name;
  }

  $d = str_replace("February", "Feb", $d);
  $d = str_replace("November", "Nov", $d);
  $d = str_replace("September", "Sep", $d);
  $d = str_replace("October", "Oct", $d);
  $date = $d;
?>  
<a href="<?php echo $link;?>">
<div id="songs_div" class="col-md-2 animated fadeInDown">
  <img style="width:100%; min-height: 200px; max-height: 200px;" src="<?php echo $album_cover;?>" title="Album cover">
		<div class="song_inf new-setion">
			<span id="artist_name" title="<?php echo $album_name?>"><?php echo $short_album_name?></span> <br>
			<span id="song_name" title="<?php echo $d?>" style="font-size:14px;"><?php echo $d?></span>
		</div>
  <div class="heading-bottom-click" style="display:none;">
	  <span title="IPHC Jerusalem Lives">Songs</span> 
	   <a  href="#" target="_blank"><span class="new">View More</span></a>
	   <div class="clearfix"></div>
  </div>
 
  <div class="btn-group" style="margin-top:10px;width: 100%">
  
    <a type="button" class="btn btn-default btn-sm grey" href="#" target="_blank"><span class="glyphicon glyphicon-share"></span></a>
    
    <button type="button" class="btn btn-default btn-sm grey" ><span class="glyphicon glyphicon-play-circle pointer"></span></button>
  </div>

</div>
</a>
<?php 
    }
}
?>



</div>
<?php 
/*--------------------------------------------------------------
 Name : Swapnil Acme
 Description :Artist
 Date : 05/10/2020
----------------------------------------------------------------*/
?>
<!-- Featured Albums -->
<!-- Artists --> 
<div class="row artistss-section">
<div class="col-lg-12">
<div class="tittle-head new-title">
<h3 class="tittle pull-left" style="margin-top: -6px; margin-bottom: 0;"> Artists  </h3>
<a href="/artists/" target="_blank" class="pull-right" style="margin-top: 3px;"> <span class="new" style=" font-size: 16px;">View More</span> </a>
  </div>
  </div>
  
  <div class="clearfix"></div>
  
<?php
 $query =    "SELECT DISTINCT artists.artist_id, artists.artist_name, artist_image_path FROM artists 
            left JOIN songs on songs.artist_id = artists.artist_id
            left JOIN albums on albums.artist_id =  artists.artist_id
            WHERE artists.deleted = '0' limit 6";//LIMIT 10

$results = mysqli_query($connection, $query) or die("Error 1021");

if (mysqli_num_rows($results) > 0) {
  while ($row = mysqli_fetch_assoc($results)) {
    extract($row);  
    $url_artist_name = clean_name($artist_name);
                //$artist_cover = 'content/artist/artist_images/' . $artist_image_path;

                $link = 'artist/' . $artist_id . '/' . $url_artist_name . '/';
    
    ?>
<a href="<?php echo $link;?>">
<div id="songs_div" class="col-md-2 animated fadeInDown">
  <img style="width:100%; min-height: 200px; max-height: 200px;" src="<?php echo $root."/content/artist/artist_images/".$artist_image_path?>" title="Artist Image">
		<div class="song_inf">
			<span id="artist_name" title="<?php echo $artist_name;?>"><?php echo $artist_name;?></span> <br>
			<!--<span id="song_name" title="Ke Nako.">Ke Nako.</span>-->
		</div>
  <div class="heading-bottom-click" style="display:none;">
	  <span title="IPHC Jerusalem Lives">Songs</span> 
	   <a  href="#" target="_blank"><span class="new">View More</span></a>
	   <div class="clearfix"></div>
  </div>
  
  <div class="btn-group" style="margin-top:10px;width: 100%">
  
    <a type="button" class="btn btn-default btn-sm grey" href="#" target="_blank"><span class="glyphicon glyphicon-share"></span></a>
    
    <button type="button" class="btn btn-default btn-sm grey"><span class="glyphicon glyphicon-play-circle pointer"></span></button>
  </div>

</div>
</a>
<?php } 
} ?>
</div>

  <div class="clearfix"></div>
<?php 
/*--------------------------------------------------------------
 Name : Swapnil Acme
 Description :videos
 Date : 05/10/2020
----------------------------------------------------------------*/

  $query = "SELECT video_name, `file_id`, file_path, video_cover_path, content_access, price FROM video_files WHERE deleted = '0' 
   AND status = 'live' ORDER BY added_on DESC LIMIT 6";
   $results = mysqli_query($connection, $query) or die("Error 1021");

if (mysqli_num_rows($results) > 0) {
    $i = 1;
    $mailnroot = $root;
    $url = $root.'/content/video/';
	 $rowcount=mysqli_num_rows($results);
	if($rowcount > 0 ){ 
?>
<!-- VIDEO --> 
<div class="row">
<div class="col-lg-12">
<div class="tittle-head new-title">
<h3 class="tittle pull-left" style="margin-top: -6px; margin-bottom: 0;"> Videos</h3>
<a href="/videos/"  class="pull-right" style="margin-top: 3px;"> <span class="new" style=" font-size: 16px;">View More</span> </a>
  </div>
  </div>
  
<div class="clearfix"></div>

<?php 
 
    
    while ($row = mysqli_fetch_assoc($results)) {
      extract($row);
       $video = $url . "videos/" . $file_path;
      $poster = $url . "covers/" . $video_cover_path;
    
     
?>
<div id="songs_div" class="col-md-2 animated fadeInDown">
    <!--<div class="v_name">
        <a >
        <img src='<?php echo $mailnroot?>/res/img/play.svg'>
        </a>
        <a href="javascript:;" class="v_l" onclick="play_video('v_player', '<?php echo $video?>', '<?php echo $poster ?>')"><?php echo $i. $video_name?></a>
    </div>-->
    <div class="video-main animated fadeIn">
    <video  id="v_player" style="min-height: 200px; max-height: 200px;" poster="<?php echo $poster ?>" src="<?php echo $video?>" data-overlay="1" data-ckin="minimal" data-color="#fefefe" data-title=" "></video> 
    </div>
	
	<div class="videoList" style="background-color:#222222;color:#707070; max-height: unset; overflow-y: unset;/*padding: 10px 0;*/;">
  
      <div class="v_name" style="padding: 5px; padding: 6px 5px 14px 5px; background: #002B7F !important; border-bottom: none !important;">
        
        <a href="javascript:;" class="v_l" style="margin-left: 0; color: #fff !important; font-size: 13px;" onclick="play_video('v_player', 'dev/content/video/videos/f8da803f560fe32f685b98d0ffc2b28b2f6a8a3618b737d1522f30d813a7d9705e0a978.mp4', 'dev/content/video/covers/a4f65cce2dfd6424147c2d0c67c933c5546357f5bd67a0f247aaff559fa184dcffd2c77.jpg')">1. The bored birds</a>

        <button type="button" class="btn btn-default btn-sm grey" name="btn_stats_1" id="btn_buy_1" onclick="initBuyOffline('dd464f9e99020e1', 'video')"> <span class="glyphicon glyphicon-shopping-cart"></span> R10.00 </button>
      <!-- <button type="button" class="btn btn-default btn-sm grey" name="btn_add_to_cart_1" id="btn_add_1" onclick="add_to_cart('dd464f9e99020e1','video')"> <span class="glyphicon glyphicon-shopping-cart"></span></button> -->
      </div>
    
    </div>

</div>

<?php } 
	}
}
?>


</div>
<script src="<?php echo $root?>/js/ckin.min.js"></script>
     <div class="clearfix"></div>
    </div>
				
				
    <!--<div class="clearfix"></div>
    <div class="blue-bar"></div>
    <div id="new_releases"></div>
    <div id="featured_albums"></div>

    <div id="discover"></div>-->
<!--
<div class="player_new" style="display:none">
    <div class="audio-player">
		<h1 id="nowplaying">G7-1</h1>
		<img class="cover" style="" src="<?php //echo $_SESSION['root'] ?>/content/song/imgs/48c084debcec7d5889a5c714490c8cb4e4354ab54df5abc05de8342f83689527ec95166.jpg" alt="">
		<audio id="audio-player" src="<?php //echo $_SESSION['root'] ?>/media/G7-1.mp3" type="audio/mp3" controls="controls"
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
    <link rel="stylesheet" type="text/css" href="<?php //echo $root;?>/css/player.css">
    <script async  src="<?php //echo $root; ?>/js/multimedia.js"></script>
        <ul class="next-top">
          <li><a class="ar" id="ar" onclick="nextSong(-1)" href="#"> <img src="<?php //echo $root;?>/images/arrow.png" alt="" /></a></li>
          <li><a class="ar2" id="ar2" onclick="nextSong(1)" href="#"><img src="<?php //echo $root;?>/images/arrow2.png" alt="" /></a></li>
    </ul>
    </div>
    
<script>
    songs = {<?php //echo  $songs ?>};
    
   
    totalSongs = <?php //echo $totalSongs ?>;
</script>  -->  
<?php require 'bottom-section.php'; ?>

<script>
    $('#home').addClass('active');
    page = 'home';
</script>

<?php require 'closing-section.php'; ?>
