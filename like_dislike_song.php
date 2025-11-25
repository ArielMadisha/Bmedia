<?php
if (!isset($_SESSION)) {
    session_start();
}
require 'db.php';

if (isset($_POST['l_d'])) {
    $song_id_ = $_POST['song_identity'];
    $action = $_POST['action'];

    $song_id_ = mysqli_real_escape_string($connection, $song_id_);
    $action = mysqli_real_escape_string($connection, $action);

    $query = "SELECT id FROM songs_likeunlike WHERE song_id = '$song_id_' and uid = '".$_SESSION['uid']."' LIMIT 1";
     $results = mysqli_query($connection, $query) or die("Error 1021");

    if (mysqli_num_rows($results) > 0) {//song_exists

        if ($action == 'like') {
            $query = "UPDATE songs_likeunlike SET likes =  1, unlike = 0 WHERE song_id = '$song_id_' and uid = '".$_SESSION['uid']."'";
            $results = mysqli_query($connection, $query) or die("Error 1021");
        } elseif ($action == 'dislike') {
            $query = "UPDATE songs_likeunlike SET likes =  0, unlike = 1 WHERE song_id = '$song_id_' and uid = '".$_SESSION['uid']."'";
            $results = mysqli_query($connection, $query) or die("Error 1021");
        }

    } else {//song does not exists*/

        if ($action == 'like') {
            $query = "INSERT INTO songs_likeunlike (song_id, likes, unlike, uid) VALUES('$song_id_', 1, 0,'".$_SESSION['uid']."')";
            $results = mysqli_query($connection, $query) or die("Error 1021");
        } elseif ($action == 'dislike') {
            $query = "INSERT INTO songs_likeunlike (song_id, likes, unlike, uid)VALUES('$song_id_', 0, 1,'".$_SESSION['uid']."')";
            $results = mysqli_query($connection, $query) or die("Error 1021");
        }
    }

    //echo $action . ' ' . $song_id_;
} else {
    exit;
}
