<!-- controller/refPaySortByMonthForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$_SESSION['payName'] = null;
$_SESSION['payCategory'] = null;
$_SESSION['payDateFrom'] = null;
$_SESSION['payDateTo'] = null;
$_SESSION['payState'] = null;

$errorReferencePayCount = null;
$errorReferencePayNone = null;

include '../view/refPaySortByMonthForm.php';
?>