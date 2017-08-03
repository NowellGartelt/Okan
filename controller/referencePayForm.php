<?php
/**
 * 支払い情報検索条件入力画面表示クラス
 * 
 * 支払い情報の検索条件の入力画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name referencePayForm
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

include '../view/referencePayForm.php';
?>