<?php
/**
 * メニュー表示クラス
 * 
 * メニュー画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name menu
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$_SESSION["errorInputPay"] = false;

include '../view/menu.php';
?>