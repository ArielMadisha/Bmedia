<?php
require_once 'template/php/config.php';


/*******************SONGS*************************/
//count number of published song
$query = "SELECT COUNT(item_id) FROM songs WHERE `status` = 'live' AND deleted = '0' AND album_id = ''";
$results = mysqli_query($connection, $query) or die('{"error" : "Error: Failed to count elements!"}' . mysqli_error($connection));
$row = mysqli_fetch_row($results);

//total number of published_songs live in the db
$num_published_songs = $row[0];

//TODO: read this value from database
$published_songs_results_per_page = 8;
$published_songs_total_pages = ceil($num_published_songs / $published_songs_results_per_page);

if ($published_songs_total_pages < 1) {
    $published_songs_total_pages = 1;
}

$songs_results_per_page = 8;
$songs_total_pages = ceil($num_published_songs / $songs_results_per_page);

if ($songs_total_pages < 1) {
    $songs_total_pages = 1;
}

/*******************Albums*************************/
//count number of published albums
$query = "SELECT COUNT(album_id) FROM albums WHERE `status` = 'live' AND deleted = '0'";
$results = mysqli_query($connection, $query) or die('{"error" : "Error: Failed to count albums!"}' . mysqli_error($connection));
$row = mysqli_fetch_row($results);

//total number of live albums in the db
$num_published_albums = $row[0];

//TODO: read this value from database
$albums_results_per_page = 8;

$albums_total_pages = ceil($num_published_albums / $albums_results_per_page);

if ($albums_total_pages < 1) {
    $albums_total_pages = 1;
}

?>