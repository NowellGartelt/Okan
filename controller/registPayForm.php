<?php
/**
 * 支払い登録画面表示クラス
 * 
 * 支払い情報を入力する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name registPayForm
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

$errorInputPay = $_SESSION["errorInputPay"];

// ユーザのデフォルト税率設定の取得
require_once '../model/searchDefTaxByID.php';
$searchDefTaxByID = new searchDefTaxByID();
$tax = $searchDefTaxByID -> searchDefTaxByID($userID);

// 支払方法一覧の取得
require_once '../model/searchMethodOfPayment.php';
$searchMethodOfPayment = new searchMethodOfPayment();
$mopList = $searchMethodOfPayment -> getMethodOfPayment();

// 支出カテゴリ一覧の取得
require_once '../model/searchPayCategory.php';
$searchPayCategory = new searchPayCategory();
$cateList = $searchPayCategory -> searchPayCategory($userID);

// 支出カテゴリ数取得
require_once '../model/searchPayCategoryCount.php';
$searchPayCategoryCount = new searchPayCategoryCount();
$cateCount = $searchPayCategoryCount -> searchPayCategoryCount($userID);
$count = $cateCount[0]["COUNT(*)"];

for ($i = 0; $i < $count; $i++) {
    // カテゴリ登録がなかった場合、空行を取り除く
    if ($cateList[$i]['categoryName'] == false || $cateList[$i]['categoryName'] == "") {
        unset($cateList[$i]);
    }
}

include '../view/registPayForm.php';
