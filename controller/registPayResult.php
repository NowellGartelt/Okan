<?php
$payName = $_POST['payName'];
$payment = $_POST['payment'];
$payCategory = $_POST['payCategory'];
$payDate = $_POST['payDate'];

include '../model/databaseConnect.php';

$registDate = date("Y-m-d H:i:s");

$query_registPay = "INSERT INTO paymentTable (payName, payment, payCategory, payDate, registDate, updateDate) 
                     VALUES ('$payName', '$payment', '$payCategory', '$payDate', '$registDate', null)";
$result = mysqli_query($link, $query_registPay);

include '../view/registPayResult.php';
?>