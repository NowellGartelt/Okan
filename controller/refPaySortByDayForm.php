<?php
/**
 * まとめて支払い検索(日ごと)検索条件入力画面表示クラス
 * 
 * まとめて支払い検索(日ごと)の検索条件を入力する画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name refePaySortByDayForm
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$_SESSION['payName'] = null;
$_SESSION['payCategory'] = null;
$_SESSION['payDateFrom'] = null;
$_SESSION['payDateTo'] = null;
$_SESSION['payState'] = null;
$_SESSION['methodOfPayment'] = null;

// エラー変数のリセット
$errInput = null;

// 支払方法一覧の取得
include '../model/searchMethodOfPayment.php';
$searchMethodOfPayment = new searchMethodOfPayment();
$mopList = $searchMethodOfPayment -> getMethodOfPayment();

include '../view/refPaySortByDayForm.php';
