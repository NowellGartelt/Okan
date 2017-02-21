<!-- controller/updatePayForm.php -->
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

include '../view/updatePayForm.php';
?>