<!-- controller/updatePayResult.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

include '../model/tools/databaseConnect.php';

$payName = $_POST['payName'];
$payment = $_POST['payment'];
$payCategory = $_POST['payCategory'];
$payDate = $_POST['payDate'];
$payState = $_POST['payState'];
$id = $_POST['ID'];

if($payName == "" || $payment == "" || $payCategory == "" || $payDate == ""){
 // 入力項目不足でエラー、入力画面に戻す
 $_SESSION["errorInputPay"] = true;
 $errorInputPay = $_SESSION["errorInputPay"];
 
 $query_getPayInfo = "SELECT * FROM paymentTable WHERE paymentID = '$id'";
 $result_getPayInfo = mysqli_query($link, $query_getPayInfo);
 $paymentInfo = mysqli_fetch_array($result_getPayInfo);

 include '../view/updatePayForm.php';

} else {
 $payName = htmlspecialchars($payName, ENT_QUOTES);
 $payment = htmlspecialchars($payment, ENT_QUOTES);
 $payCategory = htmlspecialchars($payCategory, ENT_QUOTES);
 $payState = htmlspecialchars($payState, ENT_QUOTES);

 $query_updatePayInfo = 
  "UPDATE paymentTable SET payName = 
  '$payName', payment = '$payment', payCategory = '$payCategory', 
  payDate = '$payDate', payState = '$payState' WHERE paymentID = '$id'";
 $result_updatePayInfo = mysqli_query($link, $query_updatePayInfo);
 $paymentInfo = mysqli_fetch_array($result_updatePayInfo);
 
 include '../view/updatePayResult.php';

}
mysqli_close($link);
?>