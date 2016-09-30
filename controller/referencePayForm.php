<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$_SESSION['payName'] = "";
$_SESSION['payCategory'] = "";
$_SESSION['payDateFrom'] = "";
$_SESSION['payDateTo'] = "";
$_SESSION['payState'] = "";

include '../view/referencePayForm.php';
?>