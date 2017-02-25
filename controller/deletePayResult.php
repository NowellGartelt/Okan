<!-- controller/deletePayResult.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$id = $_POST['ID'];
$payName = $_POST['payName'];
$payment = $_POST['payment'];

include '../model/deletePayByTrans.php';

$result = new deletePayByTrans();
$deletePayByTrans =
$result -> deletePayByTrans($loginID, $id);
$payInfo = $deletePayByTrans;

include '../view/deletePayResult.php';
?>