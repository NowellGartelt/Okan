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

// コントローラの共通処理取得
require 'controller.php';
$controller = new controller();

// ログインID取得
$loginID = $controller -> getLoginID();

$id = $_POST['ID'];
$errorInputPay = $_SESSION["errorInputPay"];

// 支出情報の取得
include '../model/searchPayByID.php';
$searchPayByID = new searchPayByID();
$payInfo = $searchPayByID -> searchPayByID($loginID, $id);

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

include '../view/updatePayForm.php';
