<!-- controller/deletePayResult.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$id = $_POST['ID'];
$payName = $_POST['payName'];
$payment = $_POST['payment'];

include '../model/deletePaymentByTransaction.php';

$result = new deletePaymentByTransaction();
$deletePaymentByTransaction =
$result -> deletePaymentByTransaction($loginID, $id);
$paymentInfo = $deletePaymentByTransaction;

include '../view/deletePayResult.php';
?>