<!-- controller/menu.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$_SESSION["errorInputPay"] = false;

include '../view/menu.php';
?>