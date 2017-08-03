<?php
/**
 * まとめて支払い検索(月ごと)検索条件入力画面表示クラス
 * 
 * まとめて支払い検索(月ごと)の検索条件を入力する画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name refPaySortByMonthForm
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

$errorReferencePayCount = null;
$errorReferencePayNone = null;

include '../view/refPaySortByMonthForm.php';
?>