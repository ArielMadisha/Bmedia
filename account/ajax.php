<?php
require_once '../template/php/config.php';
require_once '../template/php/admin_rights.php';

if (loggedIn()) {
    require 'acc.html';
} else {
    require '../template/php/require_login.php';
}
