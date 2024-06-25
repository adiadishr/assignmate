<?php
require '../config.php';
$_SESSION['error'] = 'This feature is not available yet';
header("Location: ../view/pages/dashboard/dashboard.php");
die;
