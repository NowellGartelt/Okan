<?php
/**
 * メニュー表示クラス
 *
 * メニュー画面を呼び出す
 *
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name refUserConfMenu
 */
session_start();

// コントローラの共通処理取得
require 'controller.php';
$controller = new controller();

// ログインID取得
$loginID = $controller -> getLoginID();

$_SESSION["errorInputPay"] = false;

include '../view/refUserConfMenu.php';
