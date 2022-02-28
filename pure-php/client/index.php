<?php

session_start();

include('../resources/config/config.php');
include('../resources/routes/routes.php');

if (isset($_SESSION['status'])) {
    header('location:' . $path . '/user');
}

?>