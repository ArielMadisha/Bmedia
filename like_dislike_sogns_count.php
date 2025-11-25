<?php
if (!isset($_SESSION)) {
    session_start();
}
require 'db.php';

if (isset($_POST['status'])) {
    $status     = $_POST['status'];
    $song_id_   = $_POST['song_identity'];
    if($status =='like')
    {
        $query = "SELECT id FROM songs_likeunlike WHERE song_id = '$song_id_' and likes = 1";
        $results = mysqli_query($connection, $query) or die("Error 10211");

    }
    else
    {
        $query = "SELECT id FROM songs_likeunlike WHERE song_id = '$song_id_' and unlike = 1";
        $results = mysqli_query($connection, $query) or die("Error 10211");
    }
    
    echo mysqli_num_rows($results);

    //echo $action . ' ' . $song_id_;
} else {
    exit;
}
