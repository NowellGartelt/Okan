<!-- controller/registPayResult.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

include '../model/tools/databaseConnect.php';

$payName = $_POST['payName'];
$payment = $_POST['payment'];
$payCategory = $_POST['payCategory'];
$payState = $_POST['payState'];
$payDate = $_POST['payDate'];

if($payName == "" || $payment == "" || $payCategory == "" || $payDate == ""){
 // 入力項目不足でエラー、入力画面に戻す
 $_SESSION["errorInputPay"] = true;
 $errorInputPay = $_SESSION["errorInputPay"];
 
 include '../view/registPayForm.php';

} else {
 $_SESSION["errorInputPay"] = false;
 $errorInputPay = $_SESSION["errorInputPay"];

 $payName = htmlspecialchars($payName, ENT_QUOTES);
 $payment = htmlspecialchars($payment, ENT_QUOTES);
 $payState = htmlspecialchars($payState, ENT_QUOTES);
 $payCategory = htmlspecialchars($payCategory, ENT_QUOTES);
 
 $registDate = date("Y-m-d H:i:s");
 
 $query_registPay = "INSERT INTO paymentTable (payName, payment, payCategory, payState, payDate, registDate, updateDate) 
                      VALUES ('$payName', '$payment', '$payCategory', '$payState', '$payDate', '$registDate', null)";
 $result = mysqli_query($link, $query_registPay);

 $query_kogotoList = <<<__SQL
SELECT *
FROM `kogoto`
WHERE $payment <= `kogoto`.`lower_payment`
ORDER BY `lower_payment` ASC
__SQL;
 $kogoto = mysqli_fetch_assoc(mysqli_query($link, $query_kogotoList));

 include '../view/registPayResult.php';

}
$_SESSION["errorInputPay"] = "";

?>