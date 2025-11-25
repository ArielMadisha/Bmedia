<?php 
session_start();

 

 function getCurrentUrl() {

    $url = array();
  
    // set protocol
    $url['protocol'] = 'http://';
    if (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) === 'on' || $_SERVER['HTTPS'] == 1)) {
      $url['protocol'] = 'https://';
    } elseif (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) {
      $url['protocol'] = 'https://';
    }
  
    // set host
    $url['host'] = $_SERVER['HTTP_HOST'];
    // set request uri in a secure way
    $url['request_uri'] = $_SERVER['REQUEST_URI'];
  
    return $url;
  }
  
  function getRoot($urlArray){
  
    $pathArray =$urlArray['protocol'].$urlArray['host'] ;//explode('/', $urlArray['request_uri']);
  
    return $pathArray;
  }
  
    $fullPath  = getCurrentUrl();
    $root      = getRoot($fullPath);
    
 if(! isset($_SESSION['logged_in']) && ! isset($_SESSION['isAdmin']) == 1){
    
    header('Location: '.$root);
}
    $_SESSION['root']=$root;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>bMedia Entertainment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="root" content="<?php echo $root;?>" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="<?php echo $root;?>/css/style.css" rel='stylesheet' type='text/css' />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!-- datatable css -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
  
  <!-- validation -->

    <!-- datatable js -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.7/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> 
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="<?php echo $root;?>/js/login_create.js"></script>
 

  
  
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header logo">
<!--      <a class="navbar-brand" href="<?php echo $root;?>/admin">bMedi<span>a</span></a> -->
<img src="/../../images/LOGO-03.png" alt="bmedia" style="height: 44px;">
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="<?php echo $root;?>"><span class="fa fa-home"></span> Home</a></li>
      <li ><a href="<?php echo $root;?>/admin/"><span class="fa fa-bookmark"></span> Dashboard</a></li>
      <li><a href="<?php echo $root;?>/admin/master/"><span class="fa fa-cog"></span> Master</a></li>
      <!-- <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li>
      <li><a href="#">Page 2</a></li> -->
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
<li><a><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['name'];?></a></li> 
      <li><a href="javascript:void(1)" onclick="logout()"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
<div class="container" style="width:90%">
