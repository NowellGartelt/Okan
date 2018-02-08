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
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

include '../view/refUserConfMenu.php';
