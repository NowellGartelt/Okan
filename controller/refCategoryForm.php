<?php
/**
 * カテゴリ参照画面表示クラス
 * 
 * 現在のカテゴリを表示する前の、収入か支出か選択する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name refCategoryForm
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// 画面の読み込み
include '../view/refCategoryForm.php';
