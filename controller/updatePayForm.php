<!-- controller/updatePayForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$id = $_POST['ID'];

include '../model/searchPaymentByID.php';

$result = new searchPaymentByID();
$searchPaymentByID = $result -> searchPaymentByID($loginID, $id);
$paymentInfo = $searchPaymentByID;

include '../view/updatePayForm.php';
?>