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

// ユーザのデフォルト税率設定の取得
include '../model/searchDefTaxByID.php';
$searchDefTaxByID = new searchDefTaxByID();
$tax = $searchDefTaxByID -> searchDefTaxByID($loginID);

include '../model/searchMethodOfPayment.php';
$searchMethodOfPayment = new searchMethodOfPayment();
$mopList = $searchMethodOfPayment -> getMethodOfPayment();

include '../view/registPayForm.php';
