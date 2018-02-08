<?php
/**
 * 支払い情報検索条件入力画面表示クラス
 * 
 * 支払い情報の検索条件の入力画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name referencePayForm
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

$errResult = null;

include '../view/referencePayForm.php';
