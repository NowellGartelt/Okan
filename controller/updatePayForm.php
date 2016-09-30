<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$id = $_POST['ID'];

include '../model/tools/databaseConnect.php';

$query_getPayInfo = "SELECT * FROM paymentTable WHERE paymentID = '$id'";
$result_getPayInfo = mysqli_query($link, $query_getPayInfo);
$paymentInfo = mysqli_fetch_array($result_getPayInfo);

include '../view/updatePayForm.php';

mysqli_close($link);
?>