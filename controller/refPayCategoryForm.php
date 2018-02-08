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
require 'controller.php';
$controller = new controller();

// ログインID取得
$loginID = $controller -> getLoginID();

// 現在登録されているカテゴリの取得
include '../model/searchPayCategory.php';
$getCategory = new searchPayCategory();
$result = $getCategory -> searchPayCategory($loginID);
$resultCount = $getCategory -> searchPayCategoryCount($loginID); 
$count = $resultCount[0]["COUNT(*)"];

for ($i = 0; $i < $count; $i++) {
    // カテゴリ登録がなかった場合、personalIDとcategoryNameに仮値を入れる
    if ($result[$i]['categoryName'] == false || $result[$i]['categoryName'] == "") {
        $result[$i]['personalID'] = $i + 1;
        $result[$i]['categoryName'] = "(未登録)";
    }
}

// 画面の読み込み
include '../view/refPayCategoryForm.php';
