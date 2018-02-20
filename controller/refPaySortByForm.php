<?php
/**
 * まとめて支払い検索選択画面表示クラス
 * 
 * まとめて支払い検索の日ごと、月ごとを選択する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name refPaySortByForm
 */
if (!isset($_SESSION)) {
    session_start();
    
}

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// 移動元ページの設定
$fromPage = "refPaySortByForm";
$controller -> setFromPage($fromPage);

// 画面の表示
include '../view/refPaySortByForm.php';
