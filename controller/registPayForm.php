<?php
/**
 * 支払い登録画面表示クラス
 * 
 * 支払い情報を入力する画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name registPayForm
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$errorInputPay = $_SESSION["errorInputPay"];
$tax = 8;

include '../view/registPayForm.php';
?>