<?php
$payName = $_POST['payName'];
$payment = $_POST['payment'];
$payDateFrom = $_POST['payDateFrom'];
$payDateTo = $_POST['payDateTo'];

include '../model/databaseConnect.php';

if($payName !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' LIMIT 30";
} 

$result = mysqli_query($link, $query_referencePay);
$i = 1;
while ($row = mysqli_fetch_array($result)) {
	$payment[$i] = $row;
	$i++;
}

mysqli_close($link);

include '../view/referencePayResult.php';
?>