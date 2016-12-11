<!-- controller/updatePayForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

include '../model/tools/databaseConnect.php';

$id = $_POST['ID'];

$query_getPayInfo = "SELECT * FROM paymentTable WHERE paymentID = '$id'";
$result_getPayInfo = mysqli_query($link, $query_getPayInfo);
$paymentInfo = mysqli_fetch_array($result_getPayInfo);

include '../view/updatePayForm.php';

mysqli_close($link);
?>