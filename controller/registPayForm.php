<!-- controller/registPayForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$errorInputPay = $_SESSION["errorInputPay"];

include '../view/registPayForm.php';
?>