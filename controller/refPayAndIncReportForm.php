<?php
/**
 * おこづかいレポート検索画面表示クラス
 * 
 * おこづかいレポート表示前に、検索条件を入力する画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name refPayAndIncReportForm
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

include '../view/refPayAndIncReportForm.php';
?>