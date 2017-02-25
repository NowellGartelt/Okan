<!-- controller/referenceIncForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$_SESSION['incName'] = null;
$_SESSION['incCategory'] = null;
$_SESSION['incDateFrom'] = null;
$_SESSION['incDateTo'] = null;
$_SESSION['incState'] = null;

$errorReferenceIncCount = null;
$errorReferenceIncNone = null;

include '../view/referenceIncForm.php';
?>