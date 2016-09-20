<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$errorInputPay = $_SESSION["errorInputPay"];

include '../view/registPayForm.php';
?>