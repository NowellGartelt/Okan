<?php
/**
 * カテゴリ(収入)情報更新画面表示クラス
 * 
 * 登録済みカテゴリ(収入)情報を呼び出し、カテゴリ(収入)情報更新画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name updateIncCategoryForm
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

if ($fromPage !== "updateIncCategoryResult") {
    $errInput = "";
    
}

// 移動元ページの設定
$fromPage = "updateIncCategoryForm";
$controller -> setFromPage($fromPage);

// 指定されたNoに登録されているカテゴリ情報の取得
require_once '../model/searchIncCategoryByID.php';
$searchIncCategoryByID = new searchIncCategoryByID();
$cateList = $searchIncCategoryByID -> searchIncCategoryByID($userID, $personalID);

// カテゴリが空行だった場合、(未登録)を挿入
if ($cateList['categoryName'] == null) {
    $cateList['categoryName'] = "(未登録)";
}

// 画面の読み込み
include '../view/updateIncCategoryForm.php';
