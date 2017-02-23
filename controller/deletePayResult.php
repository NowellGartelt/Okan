<!-- controller/deletePayResult.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

include '../model/tools/databaseConnect.php';

$id = $_POST['ID'];
$payName = $_POST['payName'];
$payment = $_POST['payment'];

include '../model/deletePaymentByTransaction.php';

$result = new deletePaymentByTransaction();
$deletePaymentByTransaction =
$result -> deletePaymentByTransaction($id);
$paymentInfo = $deletePaymentByTransaction;

include '../view/deletePayResult.php';

mysqli_close($link);
?>