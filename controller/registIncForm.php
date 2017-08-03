<?php
/**
 * 収入情報登録画面表示クラス
 * 
 * 収入情報を入力する画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name registIncForm
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$errorInputInc = $_SESSION["errorInputInc"];

include '../view/registIncForm.php';
?>