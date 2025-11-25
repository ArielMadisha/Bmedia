<div class="row">
<?php
require_once '../template/php/config.php';
require_once '../count_pager_elements.php';
if (!isset($_SESSION)) {
  session_start();
}

//get new releasses from database, sort by date newest first
if (isset($_POST['results_per_page'])) {
  $rpp = $_POST['results_per_page'];
} else {
  $rpp = $albums_results_per_page;
}

$page_number_set = false;
$albums_page_num_msg = '';
if (isset($_POST['page_number'])) {
  $pn = $_POST['page_number'];
$page_number_set = true;
} else {
  $pn = 1;
}

if (!$page_number_set) {
  $albums_page_num_msg = "document.getElementById('albums_page_n').innerHTML = 'Page $pn of $albums_total_pages'; albums_page_number = 1;";
}

$limit = 'LIMIT ' . ($pn - 1) * $rpp .', ' .$rpp;

$albums = '';
//get new releasses from database, sort by date newest first
$query = "SELECT album_name, album_id, album_artist, album_cover_path, DATE_FORMAT(release_date, '%d %M %Y') AS d FROM albums WHERE status = 'live' ORDER BY albums.date_added DESC ";//$limit
// $query = "SELECT album_name, album_id, album_artist, album_cover_path, DATE_FORMAT(release_date, '%d %M %Y') AS d FROM albums WHERE status = 'live' ORDER BY albums.date_added DESC LIMIT 10";
$results = mysqli_query($connection, $query) or die("Error 1021");

if (mysqli_num_rows($results) > 0) {
  while ($row = mysqli_fetch_assoc($results)) {
    extract($row);

   $url_album_name = clean_name($album_name);
   $root = $_SESSION['root'];
   $album_cover = $root . '/content/album/'.$album_cover_path;

   $link = $root . '/album/'.$album_id.'/'.$url_album_name .'/';

   $album_name_length = strlen($album_name);
   $short_album_name = $album_name;

   if ($album_name_length > 12) {
    while ($album_name_length > 12) {
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
   $d = str_replace("August", "Aug", $d);
   $date = $d;

$albums .= "
<div id=\"albums_div\" class=\"col-md-2 animated fadeInDown\">
    <a href=\"$link\"><img src=\"$album_cover\" alt=\"Album cover\" / style=''></a>
    <div class=\"slide-title\">
        <h4 title=\"$album_name\">$short_album_name</h4>
    </div>
    <div class=\"date-city\">
        <h5>$d</h5>
        <!--<div class=\"buy-tickets\">-->
        <div class=\"\">
            <a style=\"text-decoration: none;color: cadetblue;\" href=\"$link\">ALBUM PAGE</a>
        </div>
    </div>
</div>"
;
  }

  echo<<<A
    $albums
    <div class="clearfix"></div>

    <div id="albums_pager"  class="animated fadeInDown">
      <button id="prev_albums" onclick="loadAlbums('prev', 'n')" class="btn pager-btn">&Lt;</button>
      <label id="albums_page_n" class="page-n"></label>
      <button id="next_albums" onclick="loadAlbums('next', 'n')" class="btn pager-btn">&Gt;</button>
    </div>
  
    <script>
      $('#albums').removeClass('nav-hover');
      $albums_page_num_msg;
      document.getElementById('albums_div').scrollIntoView();
    </script>
A;
} else {
  echo 'No records found';
}

?>
</div>
