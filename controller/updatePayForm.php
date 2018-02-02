<?php
/**
 * 支払い情報更新画面表示クラス
 * 
 * 登録済み支払い情報を呼び出し、支払い情報更新画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name updatePayForm
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];
$id = $_POST['ID'];
$errorInputPay = $_SESSION["errorInputPay"];

include '../model/searchPayByID.php';

$result = new searchPayByID();
$searchPayByID = $result -> searchPayByID($loginID, $id);
$payInfo = $searchPayByID;

// 支払方法一覧の取得
include '../model/searchMethodOfPayment.php';
$searchMethodOfPayment = new searchMethodOfPayment();
$mopList = $searchMethodOfPayment -> getMethodOfPayment();

include '../view/updatePayForm.php';
?>