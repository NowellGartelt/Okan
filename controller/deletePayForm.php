<!-- controller/deletePayForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

include '../model/tools/databaseConnect.php';

$id = $_POST['ID'];

include '../model/searchPaymentByID.php';

$result = new searchPaymentByID();
$searchPaymentByID = $result -> searchPaymentByID($id);
$paymentInfo = $searchPaymentByID;

$paymentInfoDateYear = mb_substr($paymentInfo['payDate'], 0, 4);
$paymentInfoDateMonth = mb_substr($paymentInfo['payDate'], 5, 2);
$paymentInfoDateDay = mb_substr($paymentInfo['payDate'], 8, 2);

include '../view/deletePayForm.php';

mysqli_close($link);
?>