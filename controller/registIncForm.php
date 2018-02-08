<?php
/**
 * 収入情報登録画面表示クラス
 * 
 * 収入情報を入力する画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name registIncForm
 */

session_start();

// コントローラの共通処理取得
require 'controller.php';
$controller = new controller();

// ログインID取得
$loginID = $controller -> getLoginID();

$errorInputInc = $_SESSION["errorInputInc"];

// 収入カテゴリ一覧の取得
include '../model/searchIncCategory.php';
$searchIncCategory = new searchIncCategory();
$getCategory = $searchIncCategory -> searchIncCategoryName($loginID);

// 収入カテゴリ数取得
$getCount = $searchIncCategory -> searchIncCategoryCount($loginID);
$count = $getCount[0]["COUNT(*)"];

for ($i = 0; $i < $count; $i++) {
    // カテゴリ登録がなかった場合、空行を取り除く
    if ($getCategory[$i]['categoryName'] == false || $getCategory[$i]['categoryName'] == "") {
        unset($getCategory[$i]);
    }
}

include '../view/registIncForm.php';
