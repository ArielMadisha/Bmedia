<?php
require_once '../../template/php/config.php';

//check whether user is loggen in
if (!isset($_SESSION['uid'])) {
    exit('{"error" : "login required!"}');
}

if (isset($_POST['clear'])) {
    $user_id = $_SESSION['uid'];
    
    $query = "DELETE FROM cart WHERE user_id = '$user_id'";
    $results = mysqli_query($connection, $query) or die("Error: 1"/*. mysqli_error($connection)*/);
    
    exit("Cart items removed successfully");
} elseif (isset($_POST['remove']) && isset($_POST['id'])) {
    $user_id = $_SESSION['uid'];
    $item_id = $_POST['id'];

    $item_id = mysqli_escape_string($connection, $item_id);
    
    $query = "DELETE FROM cart WHERE user_id = '$user_id' AND item_id = '$item_id'";
    $results = mysqli_query($connection, $query) or die("Error: 1"/*. mysqli_error($connection)*/);
    
    exit("success");
} else {
    exit("Error: Invalid operation");
}

?>