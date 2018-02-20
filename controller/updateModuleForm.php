<?php
/**
 * モジュールフラグ更新フォーム画面表示クラス
 * 
 * モジュールフラグ更新フォーム画面を表示する
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name updateModuleForm
 */
if (!isset($_SESSION)) {
    session_start();
    
}

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// 移動元ページの設定
$fromPage = "updateModuleForm";
$controller -> setFromPage($fromPage);

// 各支出モジュール使用フラグの取得
$payModuleFlg = $controller -> getPayModuleFlg();
$moduleTaxCalcFlg = $payModuleFlg['taxCalcFlg'];
$modulePayNameFlg = $payModuleFlg['payNameFlg'];
$modulePayCateFlg = $payModuleFlg['payCateFlg'];
$modulePaymentFlg = $payModuleFlg['paymentFlg'];
$modulePayMemoFlg = $payModuleFlg['payMemoFlg'];

// 各支出モジュール使用フラグの取得
$incModuleFlg = $controller -> getIncModuleFlg();
$moduleIncNameFlg = $incModuleFlg['incNameFlg'];
$moduleIncCateFlg = $incModuleFlg['incCateFlg'];
$moduleIncMemoFlg = $incModuleFlg['incMemoFlg'];

// 画面の読み込み
include '../view/updateModuleForm.php';
