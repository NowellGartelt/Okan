<!-- controller/registIncForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$errorInputInc = $_SESSION["errorInputInc"];

include '../view/registIncForm.php';
?>