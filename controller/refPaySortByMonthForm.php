<?php
/**
 * まとめて支払い検索(月ごと)検索条件入力画面表示クラス
 * 
 * まとめて支払い検索(月ごと)の検索条件を入力する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name refPaySortByMonthForm
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
$_SESSION['methodOfPayment'] = null;

// エラー変数のリセット
$errInput = null;

// 支払方法一覧の取得
require_once '../model/searchMethodOfPayment.php';
$searchMethodOfPayment = new searchMethodOfPayment();
$mopList = $searchMethodOfPayment -> getMethodOfPayment();

include '../view/refPaySortByMonthForm.php';
