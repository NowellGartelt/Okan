<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$_SESSION["errorInputPay"] = false;

include '../view/menu.php';
?>