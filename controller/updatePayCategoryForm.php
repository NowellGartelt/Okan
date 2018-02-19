<?php
/**
 * カテゴリ(支出)情報更新画面表示クラス
 * 
 * 登録済みカテゴリ(支出)情報を呼び出し、カテゴリ(支出)情報更新画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name updatePayCategoryForm
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();
$fromPage = $controller -> getFromPage();

// カテゴリーID取得
$personalID = $_POST['personalID'];

if ($fromPage !== "updateCategoryResult") {
    $errFlg = false;
    $errInput = "";
    $errGetInfo = "";
    
}

// 移動元ページの設定
$fromPage = "updatePayCategoryForm";
$controller -> setFromPage($fromPage);

// 指定されたNoに登録されているカテゴリ情報の取得
require_once '../model/searchPayCategoryByID.php';
$searchPayCategoryByID = new searchPayCategoryByID();
$cateList = $searchPayCategoryByID -> searchPayCategoryByID($userID, $personalID);

// DBアクセスに失敗したとき
if ($DBConnect == "failed") {
    $errFlg = true;
    $errGetInfo = "emptyList";
    
} else {
    // カテゴリが空行だった場合、(未登録)を挿入
    if ($cateList['categoryName'] == null) {
        $cateList['categoryName'] = "(未登録)";
        
    }
}
// 画面の読み込み
include '../view/updatePayCategoryForm.php';
