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
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

$_SESSION['payName'] = null;
$_SESSION['payCategory'] = null;
$_SESSION['payDateFrom'] = null;
$_SESSION['payDateTo'] = null;
$_SESSION['payState'] = null;

include '../view/refPayAndIncReportForm.php';
