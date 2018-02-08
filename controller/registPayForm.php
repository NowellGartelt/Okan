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

// コントローラの共通処理取得
require 'controller.php';
$controller = new controller();

// ログインID取得
$loginID = $controller -> getLoginID();

$errorInputPay = $_SESSION["errorInputPay"];

// ユーザのデフォルト税率設定の取得
include '../model/searchDefTaxByID.php';
$searchDefTaxByID = new searchDefTaxByID();
$tax = $searchDefTaxByID -> searchDefTaxByID($loginID);

// 支払方法一覧の取得
include '../model/searchMethodOfPayment.php';
$searchMethodOfPayment = new searchMethodOfPayment();
$mopList = $searchMethodOfPayment -> getMethodOfPayment();

// 支出カテゴリ一覧の取得
include '../model/searchPayCategory.php';
$searchPayCategory = new searchPayCategory();
$getCategory = $searchPayCategory -> searchPayCategoryName($loginID);

// 支出カテゴリ数取得
$getCount = $searchPayCategory -> searchPayCategoryCount($loginID);
$count = $getCount[0]["COUNT(*)"];

for ($i = 0; $i < $count; $i++) {
    // カテゴリ登録がなかった場合、空行を取り除く
    if ($getCategory[$i]['categoryName'] == false || $getCategory[$i]['categoryName'] == "") {
        unset($getCategory[$i]);
    }
}

include '../view/registPayForm.php';
