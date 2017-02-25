<!-- controller/deletePayForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$id = $_POST['ID'];

include '../model/searchPayByID.php';

$result = new searchPayByID();
$searchPayByID = $result -> searchPayByID($loginID, $id);
$payInfo = $searchPayByID;

$payInfoDateYear = mb_substr($payInfo['payDate'], 0, 4);
$payInfoDateMonth = mb_substr($payInfo['payDate'], 5, 2);
$payInfoDateDay = mb_substr($payInfo['payDate'], 8, 2);

include '../view/deletePayForm.php';
?>