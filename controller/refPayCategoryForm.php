<?php
/**
 * カテゴリ(支出)参照画面表示クラス
 * 
 * 現在のカテゴリ(支出)を表示する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name refPayCategory
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// 移動元ページの設定
$fromPage = "refPayCategoryForm";
$controller -> setFromPage($fromPage);

// 現在登録されているカテゴリの取得
require_once '../model/searchPayCategory.php';
$searchPayCategory = new searchPayCategory();
$cateList = $searchPayCategory -> searchPayCategory($userID);

// 現在登録されているカテゴリ数の取得
require_once '../model/searchPayCategoryCount.php';
$searchPayCategoryCount = new searchPayCategoryCount();
$cateCount = $searchPayCategoryCount -> searchPayCategoryCount($userID); 
$count = $cateCount[0]["COUNT(*)"];

for ($i = 0; $i < $count; $i++) {
    // カテゴリ登録がなかった場合、personalIDとcategoryNameに仮値を入れる
    if ($cateList[$i]['categoryName'] == false || $cateList[$i]['categoryName'] == "") {
        $cateList[$i]['personalID'] = $i + 1;
        $cateList[$i]['categoryName'] = "(未登録)";
    }
}

// 画面の読み込み
include '../view/refPayCategoryForm.php';
