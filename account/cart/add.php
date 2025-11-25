<?php
require_once '../../template/php/config.php';

if (!isset($_SESSION['uid'])) {
    exit('{"error" : "You must be logged in to add items to your cart!"}');
}

if (isset($_POST['item_id']) && isset($_POST['item_type'])) {
    
    $item_id = $_POST['item_id'];
    $item_type = $_POST['item_type'];
    
    $item_id = mysqli_real_escape_string($connection, $item_id);
    $item_type = mysqli_real_escape_string($connection, $item_type);
    
    $item = '';
    $item_price = '';
    $user_id = $_SESSION['uid'];
    
    $tbl = '';
    $sl = '';
    $id = '';
    
    if ($item_type == 'song') {
        $tbl = 'songs';
        $sl = 'song_name, song_price';
        $id = 'song_id';
    }elseif ($item_type == 'album') {
        $tbl = 'albums';
        $sl = 'album_name, price';
        $id = 'album_id';
    }elseif ($item_type == 'video') {
        $tbl = 'video_files';
        $sl = 'video_name, price';
        $id = 'file_id';
    } else {
        exit('{"error" : "Invalid operation!"}');
    }
    
    $query = "SELECT $sl FROM $tbl WHERE $id = '$item_id' AND content_access in('1','2')";
    $results = mysqli_query($connection, $query) or die("Error: 1");
    
    if (mysqli_num_rows($results) > 0) {
        //item exists
        $row = mysqli_fetch_assoc($results);
        extract($row);
        
        if ($item_type == 'song') {
            $item = $song_name;
            $item_price = $song_price;
        }elseif ($item_type == 'album') {
            $item = $album_name;
            $item_price = $price;
        }elseif ($item_type == 'video') {
            $item = $video_name;
            $item_price = $price;
        } else {
            exit('{"error" : "Invalid operation: 1!"}');
        }
        
        //check for duplicate entry in to the cart
        $query = "SELECT item_name FROM cart WHERE item_id = '$item_id' AND `user_id` = '$user_id'";
        $results = mysqli_query($connection, $query) or die("Error: 2");
        
        if (mysqli_num_rows($results) > 0) {
            //duplicate, item already added
            exit('{"error": "You already added this item to your cart! \nView your cart at \n\nbmedia.online/account/cart/"}');
        } else {
            //insert item to database
            $query = "INSERT INTO cart (item_name, cost, user_id, item_id, item_type) VALUES ('$item', '$item_price', '$user_id', '$item_id', '$item_type')";
            $results = mysqli_query($connection, $query) or die("Error: 3" /*. mysqli_error($connection)*/);
            
            exit('{"error" : "none"}');
        }
    } else {
        //item does not exist
        exit('{"error" : "Item does not exist!"}');
    }
} else {
    exit('{"error" : "Invalid operation"}');
}
