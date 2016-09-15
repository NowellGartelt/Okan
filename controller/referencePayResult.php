<?php
$payName = $_POST['payName'];
$payment = $_POST['payment'];
$payDateFrom = $_POST['payDateFrom'];
$payDateTo = $_POST['payDateTo'];

include '../model/databaseConnect.php';

if($payName !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%'";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%'";
} 

$result_referencePay = mysqli_query($link, $query_referencePay);
$result_sumPay = mysqli_query($link, $query_sumPay);
$i = 1;
while ($row = mysqli_fetch_array($result_referencePay)) {
	$payment[$i] = $row;
	$i++;
}
$sumPayment[0] = mysqli_fetch_array($result_sumPay);

mysqli_close($link);

include '../view/referencePayResult.php';
?>