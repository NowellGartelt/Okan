<?php
/**
 * カテゴリ参照画面表示クラス
 * 
 * 現在のカテゴリを表示する前の、収入か支出か選択する画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name refCategoryForm
 */

session_start();

// ログインチェック
// ログイン済みかどうか確認実施
include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

// ログインID取得
$loginID = $_SESSION['loginID'];

// コントローラの共通処理取得
include 'controller.php';
$controller = new controller();

// 画面の読み込み
include '../view/refCategoryForm.php';
?>