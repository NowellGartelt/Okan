<?php
/**
 * 収入情報検索条件入力画面表示クラス
 * 
 * 収入情報を検索するため、情報を入力する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name referenceIncForm
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

$_SESSION['incName'] = null;
$_SESSION['incCategory'] = null;
$_SESSION['incDateFrom'] = null;
$_SESSION['incDateTo'] = null;
$_SESSION['incState'] = null;

$errResult = null;

include '../view/referenceIncForm.php';
