<style>
.table.table-bordered a{ color:#fff;}
/* #btn_like_1{background: #002B7F; color: #fff;}
#btn_dislike_1{background: #002B7F; color: #fff;} */
#btn_dislike_1, #btn_like_1{font-weight: 800;}
.thumbnail img{float: left; width: 38%; margin-right: 10px;}
</style>
<?php

$d = str_replace("February", "Feb", $d);
$d = str_replace("November", "Nov", $d);
$date = $d;

$genre_query = "SELECT genre FROM genres WHERE genre_id = '$genre_id'";
$genre_results = mysqli_query($connection, $genre_query) or die(mysqli_error($connection));
$genre_row = mysqli_fetch_assoc($genre_results);

$genre = $genre_row['genre'];
$genre = str_replace("&", "&amp;", $genre);

if (!empty($other_primary_artist)) {
    $amp = '&amp;';
} else {
    $amp = '';
}

$artist_names_length = strlen($other_primary_artist . ' & ' . $artist_name);

/**
 * Reduce primary artist names length if longer than 26 characters
 */
if ($artist_names_length > 26) {

    while ($artist_names_length > 26) {
        $other_primary_artist = substr_replace($other_primary_artist, '', -1);
        $artist_names_length--;
    }

    $other_primary_artist = substr_replace($other_primary_artist, '...', -3);
}

$url_song_name = $song_name;
$url_song_name = strtolower($url_song_name);
$url_song_name = str_replace(' ', '-', $url_song_name);
$url_song_name = str_replace('(', '', $url_song_name);
$url_song_name = str_replace(')', '', $url_song_name);
$url_song_name = str_replace('.', '', $url_song_name);

$item = '';

    if (strpos($_SERVER['REQUEST_URI'], 'song') !== false) {
        $item = 'song';
    } elseif (strpos($_SERVER['REQUEST_URI'], 'artist') !== false) {
        $item = 'artist';
    } elseif (strpos($_SERVER['REQUEST_URI'], 'album') !== false) {
        $item = 'album';
    } elseif (strpos($_SERVER['REQUEST_URI'], 'video') !== false) {
        $item = 'video';
    }

$link = $root .'/'.$item.'/'.$song_id.'/'.$url_song_name .'/';

// if ($downloadable == 'yes') {
//     $download_btn = "<button type=\"button\" class=\"btn btn-default btn-sm grey\" onclick=\"download_song('$song_id')\"> <span  class=\"glyphicon glyphicon-download-alt\"></span> </button>";
// } else {
//     $download_btn = '';
// }

/*----------------------------------------------------
//name        : Swapnil acme
//description : get count of like dislike
------------------------------------------------------*/

$like_query    = "SELECT count(id) as lk FROM songs_likeunlike WHERE likes = 1 and  song_id = '$url_release_id'";
$like_results  = mysqli_query($connection, $like_query) or die(mysqli_error($connection));
$like_row      = mysqli_fetch_assoc($like_results);

$like       =   $like_row ['lk'];



$unlike_query    = "SELECT count(id) as ulk FROM songs_likeunlike WHERE unlike = 1 and song_id = '$url_release_id'";
$unlike_results  = mysqli_query($connection, $unlike_query) or die(mysqli_error($connection));
$unlike_row      = mysqli_fetch_assoc($unlike_results);

$dislike       =   $unlike_row['ulk'];

if($dislike == '') $dislike = 0;
if($like == '') $like = 0;
$unlikeUser =   $likesUser  ='';

/// already liked
if(isset($_SESSION['uid']) && $_SESSION['uid'] !='')
{
    $usrlike_query    = "SELECT id,likes,unlike  FROM songs_likeunlike WHERE  uid = '".$_SESSION['uid']."' and song_id = '$url_release_id'";
    $usrlike_results  = mysqli_query($connection, $usrlike_query) or die(mysqli_error($connection));
    $usrlike_row      = mysqli_fetch_assoc($usrlike_results);
    
    $uli             =   count($usrlike_row);
    $unlikeUser      =   $usrlike_row['unlike'];
    $likesUser       =   $usrlike_row['likes'];
    
}

 
if(isset($_SESSION['uid']) && $_SESSION['uid'] !='')
{    
    if($uli == 0)
    {
        $like_dislike_button   =  '<button type="button" class="btn btn-default btn-sm grey" name="btn_stats_1" id="btn_like_1" onclick="like_dislike_song(\'btn_stats_1\',\''.$url_release_id.'\',\'like\')"><span id=\'like_no_1\'>'.$like.'</span>&nbsp;&nbsp;<span  class="glyphicon glyphicon-thumbs-up"></span> </button>
                                   <button type="button" class="btn btn-default btn-sm grey" name="btn_stats_2" id="btn_dislike_2" onclick="like_dislike_song(\'btn_stats_2\',\''.$url_release_id.'\',\'dislike\')"><span id=\'dislike_no_2\'>'.$dislike.'</span>&nbsp;&nbsp;<span  class="glyphicon glyphicon-thumbs-down"></span> </button>';
    }
    else
    {
    
        if($unlikeUser ==1)
        {
            
            $like_dislike_button   =  '<button type="button"  class="btn btn-default btn-sm grey" name="btn_stats_1" id="btn_like_1" onclick="like_dislike_song(\'btn_stats_1\',\''.$url_release_id.'\',\'like\')" ><span id=\'like_no_1\'>'.$like.'</span>&nbsp;&nbsp;<span  class="glyphicon glyphicon-thumbs-up"></span> </button>
                                      <button type="button"   class="btn btn-default btn-sm" name="btn_stats_2" id="btn_dislike_2" onclick="like_dislike_song(\'btn_stats_2\',\''.$url_release_id.'\',\'dislike\')" style="color: blue;"><span id=\'dislike_no_2\'>'.$dislike.'</span>&nbsp;&nbsp;<span  class="glyphicon glyphicon-thumbs-down"></span> </button>';        
        }
        
        if($likesUser ==1)
        {
            $like_dislike_button   =  '<button type="button"  class="btn btn-default btn-sm" name="btn_stats_1" id="btn_like_1" onclick="like_dislike_song(\'btn_stats_1\',\''.$url_release_id.'\',\'like\')" style="color: blue;"><span id=\'like_no_1\'>'.$like.'</span>&nbsp;&nbsp;<span  class="glyphicon glyphicon-thumbs-up"></span> </button>
                                      <button type="button" class="btn btn-default btn-sm grey" name="btn_stats_2" id="btn_dislike_2" onclick="like_dislike_song(\'btn_stats_2\',\''.$url_release_id.'\',\'dislike\')"><span id=\'dislike_no_2\'>'.$dislike.'</span>&nbsp;&nbsp;<span  class="glyphicon glyphicon-thumbs-down"></span> </button>';        
        }
    }
}
else
{
      $like_dislike_button   =  '<button type="button" class="btn btn-default btn-sm grey showloginbox" name="btn_stats_1" id="btn_like_1" ><span id=\'like_no_1\'>'.$like.'</span>&nbsp;&nbsp;<span  class="glyphicon glyphicon-thumbs-up"></span> </button>
                                    <button type="button" class="btn btn-default btn-sm grey showloginbox" name="btn_stats_1" id="btn_dislike_1" ><span id=\'dislike_no_1\'>'.$dislike.'</span>&nbsp;&nbsp;<span  class="glyphicon glyphicon-thumbs-down"></span> </button>';

}
//----------------------------------------------------------------------------

$buy_btn_click_event;
if (isset($_SESSION['uid'])) {
    $buy_btn_click_event = "buyItem('$song_id', 'song')";
} else {
    $buy_btn_click_event = "initBuyOffline('$song_id', 'song')";
}

$buy_btn = '';
$add_to_cart = '';

// echo $access_level;
// exit;

if ($access_level == '1' || $access_level == '2') {
    $buy_btn = "<button type=\"button\" class=\"btn btn-default btn-sm grey\" name=\"btn_stats_$btn_number\" id=\"btn_buy_$btn_number\" onclick=\"$buy_btn_click_event\"> <span  class=\"glyphicon glyphicon-download-alt\"></span> R$song_price </button>";

    $add_to_cart = "<button type=\"button\" class=\"btn btn-default btn-sm grey\" name=\"btn_add_to_cart_$btn_number\" id=\"btn_add_$btn_number\" onclick=\"add_to_cart('$song_id','song')\"> <span  class=\"glyphicon glyphicon-shopping-cart\"></span></button>";
} elseif($access_level == '3'){
    $buy_btn = "<button type=\"button\" class=\"btn btn-default btn-sm grey\" name=\"btn_stats_$btn_number\" id=\"btn_buy_$btn_number\" onclick=\"$buy_btn_click_event\"> R0.00 </button>";
}

/*
Access levels
* 1 = paid downloads only
* 2 = paid downloads and streaming

* 3 = free downloads and streaming
* 4 = free streaing only

* 5 = streaming only - entry level and premium subscribers
* 6 = streaming only - premium subscribers only
*/

echo<<<BTNS
    <img src="$root/content/song/$cover_path" alt="cover-art"/>
    <div class="caption" style="padding:0px">
        <strong>
            <!-- <span class="label label-success">Rank #$btn_number</span>-->
            <!--<span style="color:green;" class="glyphicon glyphicon-arrow-up"> From #20</span>-->
            </strong>
        <p class="r-text grey" style="margin-bottom: 0px;"> <a class="no-jump" href="#" onclick="sch('$artist_id', 'artists')" id="artist_name">$artist_name</a> $amp <a class="no-jump" href="#" onclick="sch('$other_artists', 'artists')">$other_primary_artist</a>
        <br>
            <span id="song_name">$song_name</span>
        <br>
            Time: $duration
        <br>
            Genre: <a class="a_name no-jump" href="#" onclick="sch('$genre_id', 'genre')">$genre</a>
        <br>
            Label: <a class="a_name no-jump" href="#" onclick="sch('$label', 'label')">$label</a>
        <br>
            Released: $date

        <div style="margin-bottom: 10px; margin-top: 10px; width: 100%;" class="btn-group">
		<hr style="margin-top: 5px; margin-bottom: 10px;">
            <button type="button" class="btn btn-default btn-sm grey" onclick="share('$song_id')"> <span  class="glyphicon glyphicon-share"></span> </button>

            
            <button type="button" class="btn btn-default btn-sm grey" onclick="play('$item_id', '$file_path', '$song_name', '$artist_name', 'single')"> <span  class="glyphicon glyphicon-play"></span> </button>
            $like_dislike_button
            $add_to_cart

            $buy_btn

        </div>

    </div>
BTNS;
