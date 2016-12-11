<!-- controller/deletePayResult.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

include '../model/tools/databaseConnect.php';

$id = $_POST['ID'];
$payName = $_POST['payName'];
$payment = $_POST['payment'];
$payCategory = $_POST['payCategory'];
$payDateYear = $_POST['payDateYear'];
$payDateMonth = $_POST['payDateMonth'];
$payDateDay = $_POST['payDateDay'];
$payState = $_POST['payState'];

$query_deletePayInfo = "DELETE FROM paymentTable WHERE paymentID = '$id'";
$result_deletePayInfo = mysqli_query($link, $query_deletePayInfo);
$paymentInfo = mysqli_fetch_array($result_deletePayInfo);

include '../view/deletePayResult.php';

mysqli_close($link);
?>