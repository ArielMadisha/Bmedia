<?php
require_once '../template/php/config.php';
if (!isset($_SESSION)) {
  session_start();
}

//get artists from the db

$artists = '';
/*$query =    "SELECT DISTINCT artists.artist_id, artists.artist_name, artist_image_path 
            FROM artists 
            left JOIN songs on songs.artist_id = artists.artist_id
            left JOIN albums on albums.artist_id =  artists.artist_id
            WHERE artists.deleted = '0' 
            ";*/
$query = "SELECT DISTINCT artists.artist_id, artists.artist_name, artist_image_path FROM artists left JOIN songs using (artist_id) left JOIN albums using (artist_id) WHERE artists.deleted = 0 AND songs.status = 'live' or albums.status = 'live' LIMIT 10";
$results = mysqli_query($connection, $query) or die("Error 1021");

if (mysqli_num_rows($results) > 0) {
  while ($row = mysqli_fetch_assoc($results)) {
    extract($row);

    $url_artist_name = clean_name($artist_name);
    $root = $_SESSION['root'];
    $link = $root . '/artist/' . $artist_id . '/' . $url_artist_name . '/';

    $artists .= "

<div class=\"col-md-3 browse-grid animated fadeInDown\">
    <a href=\"#\"><img src=\"$root/content/artist/artist_images/$artist_image_path\" title=\"Artist Image\"></a>
    <!--<a href=\"#\"><i class=\"glyphicon glyphicon-play-circle\"></i></a>-->
    <a class=\"sing\" href=\"$link\">$artist_name</a>
  </div>
";
  }

  echo <<<A
   $artists
   <script>
   $('#artists').removeClass('nav-hover');
</script>
A;
} else {
  echo 'No records found';
}
