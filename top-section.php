

<?php
session_start();
$_SESSION['bmedia'] = true;

require_once 'template/php/config.php';
require_once 'count_pager_elements.php';

function getCurrentUrl()
{
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

function getRoot($urlArray)
{
    $pathArray = $urlArray['protocol'] . $urlArray['host']; //explode('/', $urlArray['request_uri']);
    return $pathArray;
}

$fullPath  = getCurrentUrl();
$root      = getRoot($fullPath);

$_SESSION['root'] = $root;
if (isset($_SESSION['password_strength'])) {
    $password_strength = $_SESSION['password_strength'];
} else {
    $password_strength = 0;
}
//  echo 'df';exit;


// write_debug_data( __FILE__ .": ". __LINE__ . "\n");
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!DOCTYPE HTML>
<html>

<head>
    <title>bMedia Entertainment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="bMedia" />
    <meta name="root" content="<?php echo $root; ?>" />
    <meta name="pass_validate" content="<?php echo $password_strength; ?>" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <?php
    echo <<<A
<script>
var published_songs_total_pages = $published_songs_total_pages;
var published_songs_per_page = $published_songs_results_per_page;
var songs_total_pages = $songs_total_pages;
var songs_per_page = $songs_results_per_page;
var albums_total_pages = $albums_total_pages;
var albums_per_page = $albums_results_per_page;
</script>
A;
    ?>

    <!-- Bootstrap Core CSS -->
    <!-- <link rel="stylesheet" href="bootstrap/style.css"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
 
    <!-- <link rel="stylesheet" href="css/bootstrap.css" type='text/css'> -->
    <link href="<?php echo $root; ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="<?php echo $root; ?>/css/style.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo $root; ?>/css/style-2.css" rel='stylesheet' type='text/css' />
    <!-- Graph CSS -->
    <link href="<?php echo $root; ?>/css/font-awesome.css" rel="stylesheet">

    <!-- jQuery -->
    <!-- lined-icons -->
    <link rel="stylesheet" href="<?php echo $root; ?>/css/icon-font.css" type='text/css' />
    <link rel="stylesheet" href="<?php echo $root; ?>/css/animate.min.css">
    <!-- //lined-icons -->
    <!-- Meters graphs -->
    <script src="<?php echo $root; ?>/js/jquery-2.1.4.js"></script>
    <script async src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script async  type="text/javascript" src="<?php echo $root; ?>/js/jquery.flexisel.js"></script>

    <style>
        .v_name:hover {
            background-color: #00133a;
        }

        .v_l {
            color: #fff;
            margin-left: 45px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            text-transform: capitalize;
            vertical-align: middle;
            font-family: 'myriadb';
            font-style: normal;
        }

        .v_name {
            padding: 15px 10px 20px;
            cursor: pointer;
            background: #002B7F;
            cursor: pointer;
            border-bottom: #fff;
            border-bottom-width: 1px;
            border-bottom-style: solid;
        }

        .v_name img {
            margin-left: 10px;
        }

        .v_l:hover {
            text-decoration: none;
            color: #cc004a;
        }
	a:hover { 
            text-decoration: none; 
        } 
    </style>

    <?php
    require 'template/php/recaptcha.php';
    ?>

    <link rel="stylesheet" href="<?php echo $root; ?>/css/ckin.min.css">

</head>
<!-- /w3layouts-agile -->

<body class="sticky-header left-side-collapsed">
    <!-- <body class="sticky-header left-side-collapsed" > -->

    <form id="paygate_redirect_form" action="https://secure.paygate.co.za/payweb3/process.trans" method="POST">
        <input type="hidden" name="PAY_REQUEST_ID" id="req_id" value="">
        <input type="hidden" name="CHECKSUM" id="checksum" value="">
    </form>

    <section>

        <?php require 'template/html/left-side-start.php'; ?>



        <!-- /w3l-agile -->

        <?php require 'template/html/sign-up-modal.html'; ?>
        <?php require 'template/html/reset-pass-mobile.html'; ?>
        <?php require 'template/html/reset-pass-modal.html'; ?>
        <?php require 'template/html/resend-otp-modal.html'; ?>
        <?php require 'template/html/password-strength-update.html'; ?>

        <!-- /w3l-agile -->
        <!-- left side end-->
        <!-- main content start-->
        <div class="main-content">

            <?php require 'template/html/header-section.php'; ?>
           <!-- <script src="<?php echo $root; ?>/js/multimedia.js"></script>-->

            <!-- /w3l-agileits -->
            <!-- //header-ends -->
            <div id="page-wrapper">
                <div class="inner-content" id="page_content">