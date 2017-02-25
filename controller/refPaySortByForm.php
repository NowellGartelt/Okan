<!-- controller/refePaySortByForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

include '../view/refPaySortByForm.php';
?>