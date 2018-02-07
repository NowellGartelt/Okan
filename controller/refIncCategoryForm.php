<?php
/**
 * カテゴリ(収入)参照画面表示クラス
 * 
 * 現在のカテゴリ(収入)を表示する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name refIncCategory
 */

session_start();

// コントローラの共通処理取得
require 'controller.php';
$controller = new controller();

// ログインID取得
$loginID = $controller -> getLoginID();

// カテゴリ登録数の設定
$maxRegist = 10;

// 現在登録されているカテゴリの取得
include '../model/searchIncCategory.php';
$getCategory = new searchIncCategory();
$result = $getCategory->searchIncCategory($loginID, $maxRegist);

for ($i = 0; $i < $maxRegist; $i++) {
    // カテゴリ登録がなかった場合、personalIDとcategoryNameに仮値を入れる
    if ($result[$i]['categoryName'] == false || $result[$i]['categoryName'] == "") {
        $result[$i]['personalID'] = $i + 1;
        $result[$i]['categoryName'] = "(未登録)";
    }
}

// 画面の読み込み
include '../view/refIncCategoryForm.php';
