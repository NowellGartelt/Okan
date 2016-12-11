<!-- controller/referencepayForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$_SESSION['payName'] = "";
$_SESSION['payCategory'] = "";
$_SESSION['payDateFrom'] = "";
$_SESSION['payDateTo'] = "";
$_SESSION['payState'] = "";

$errorReferencePayCount = "";
$errorReferencePayNone = "";

include '../view/referencePayForm.php';
?>