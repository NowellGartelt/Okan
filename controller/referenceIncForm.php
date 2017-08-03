<?php
/**
 * 収入情報検索条件入力画面表示クラス
 * 
 * 収入情報を検索するため、情報を入力する画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name referenceIncForm
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$_SESSION['incName'] = null;
$_SESSION['incCategory'] = null;
$_SESSION['incDateFrom'] = null;
$_SESSION['incDateTo'] = null;
$_SESSION['incState'] = null;

$errorReferenceIncCount = null;
$errorReferenceIncNone = null;

include '../view/referenceIncForm.php';
?>