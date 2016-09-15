<?php
session_start();

$errorInputPay = $_SESSION["errorInputPay"];

include '../view/registPayForm.php';
?>