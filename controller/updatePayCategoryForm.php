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
require 'controller.php';
$controller = new controller();

// ログインID取得
$loginID = $controller -> getLoginID();

// カテゴリーID取得
$personalID = $_POST['personalID'];

// 指定されたNoに登録されているカテゴリ情報の取得
include '../model/searchPayCategoryByID.php';
$getCategory = new searchPayCategoryByID();
$result = $getCategory-> searchPayCategoryByID($loginID, $personalID);

// カテゴリが空行だった場合、(未登録)を挿入
if ($result[0]['categoryName'] == null) {
    $result[0]['categoryName'] = "(未登録)";
}

// 画面の読み込み
include '../view/updatePayCategoryForm.php';
