<?php
/**
 * モジュールフラグ更新結果画面表示クラス
 * 
 * モジュールフラグのチェックフラグをON、OFFを判別、更新結果画面を表示する
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name updateModuleResult
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// 各支出モジュール使用フラグの取得
$moduleTaxCalcFlg = $_POST['taxCalc'];
$modulePayNameFlg = $_POST['payName'];
$modulePayCateFlg = $_POST['payCategory'];
$modulePaymentFlg = $_POST['payment'];
$modulePayMemoFlg = $_POST['payMemo'];

// 各支出モジュール使用フラグの取得
$moduleIncNameFlg = $_POST['incName'];
$moduleIncCateFlg = $_POST['incCategory'];
$moduleIncMemoFlg = $_POST['incMemo'];

if ($moduleTaxCalcFlg == null) {
    $moduleTaxCalcFlg = "0";
    $taxCalcFlg = "なし";
} else {
    $moduleTaxCalcFlg = "1";
    $taxCalcFlg = "あり";
}
if ($modulePayNameFlg == null) {
    $modulePayNameFlg = "0";
    $payNameFlg = "なし";
} else {
    $modulePayNameFlg = "1";
    $payNameFlg = "あり";
}
if ($modulePayCateFlg == null) {
    $modulePayCateFlg = "0";
    $payCateFlg = "なし";
} else {
    $modulePayCateFlg = "1";
    $payCateFlg = "あり";
}
if ($modulePaymentFlg == null) {
    $modulePaymentFlg = "0";
    $paymentFlg = "なし";
} else {
    $modulePaymentFlg = "1";
    $paymentFlg = "あり";
}
if ($modulePayMemoFlg == null) {
    $modulePayMemoFlg = "0";
    $payMemoFlg = "なし";
} else {
    $modulePayMemoFlg = "1";
    $payMemoFlg = "あり";
}
if ($moduleIncNameFlg == null) {
    $moduleIncNameFlg = "0";
    $incNameFlg = "なし";
} else {
    $moduleIncNameFlg = "1";
    $incNameFlg = "あり";
}
if ($moduleIncCateFlg == null) {
    $moduleIncCateFlg = "0";
    $incCateFlg = "なし";
} else {
    $moduleIncCateFlg = "1";
    $incCateFlg = "あり";
}
if ($moduleIncMemoFlg == null) {
    $moduleIncMemoFlg = "0";
    $incMemoFlg = "なし";
} else {
    $moduleIncMemoFlg = "1";
    $incMemoFlg = "あり";
}

// 更新日時取得
$updateDate = date("Y-m-d H:i:s");

// モジュールフラグ更新
require_once '../model/updateModule.php';
$updateModule = new updateModule();
$updResult = $updateModule -> updateModule($userID, 
        $moduleTaxCalcFlg, $modulePayNameFlg, $modulePayCateFlg, $modulePaymentFlg, 
        $modulePayMemoFlg, $moduleIncNameFlg, $moduleIncCateFlg, $moduleIncMemoFlg,
        $updateDate);

// セッションのモジュールフラグ更新
$setPayModuleFlg = $controller -> setPayModuleFlg($moduleTaxCalcFlg, $modulePayNameFlg, 
        $modulePayCateFlg, $modulePaymentFlg, $modulePayMemoFlg);
$setIncModuleFlg = $controller -> setIncModuleFlg($moduleIncNameFlg, $moduleIncCateFlg, 
        $moduleIncMemoFlg);

include '../view/updateModuleResult.php';
