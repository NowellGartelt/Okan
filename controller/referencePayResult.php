<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$payName = $_POST['payName'];
$payCategory = $_POST['payCategory'];
$payDateFrom = $_POST['payDateFrom'];
$payDateTo = $_POST['payDateTo'];

include '../model/tools/databaseConnect.php';

$payName = htmlspecialchars($payName, ENT_QUOTES);
$payCategory = htmlspecialchars($payCategory, ENT_QUOTES);

if($payName !== ""  && $payCategory !== "" && $payDateFrom !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";

} elseif($payName !== "" && $payDateFrom !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";
} elseif($payCategory !== "" && $payDateFrom !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";
} elseif($payName !== "" && $payCategory !== "" && $payDateFrom !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateFrom'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateFrom'";
} elseif($payName !== "" && $payCategory !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateTo'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateTo'";

} elseif($payName !== "" && $payCategory !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%'";
} elseif($payName !== "" && $payDateFrom !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom'";
} elseif($payName !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate <= '$payDateTo'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate <= '$payDateTo'";
} elseif($payCategory !== "" && $payDateFrom !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateFrom'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateFrom'";
} elseif($payCategory !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateTo'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateTo'";
} elseif($payDateFrom !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHEREpayDate >= '$payDateFrom' AND payDate <= '$payDateTo'";

} elseif($payName !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%'";
} elseif($payCategory !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%'";
} elseif($payDateFrom !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payDate >= '$payDateFrom'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payDate >= '$payDateFrom'";
} elseif($payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payDate <= '$payDateTo'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payDate <= '$payDateTo'";
} 

$result_referencePay = mysqli_query($link, $query_referencePay);
$result_sumPay = mysqli_query($link, $query_sumPay);
$i = 1;
while ($row = mysqli_fetch_array($result_referencePay)) {
	$payment[$i] = $row;
	$i++;
}

if($i >= 102){
 $_SESSION['errorReferencePayCount'] = true;

} elseif ($i == 1) {
 $_SESSION['errorReferencePayNone'] = true;

} else {
 $sumPayment[0] = mysqli_fetch_array($result_sumPay);
 include '../view/referencePayResult.php';

}
mysqli_close($link);

?>