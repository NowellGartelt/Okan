<?php
/**
 * おこづかいレポート検索画面表示クラス
 * 
 * おこづかいレポート表示前に、検索条件を入力する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name refPayAndIncReportForm
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
$fromPage = $controller -> getFromPage();

if ($fromPage !== "refPayAndIncReportResult") {
    // エラー変数の初期化
    $errInput = "";
    
}

// 移動元ページの設定
$fromPage = "refPayAndIncReportForm";
$controller -> setFromPage($fromPage);

// 画面の表示
include '../view/refPayAndIncReportForm.php';
