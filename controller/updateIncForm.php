<?php
/**
 * 収入更新情報入力画面表示クラス
 * 
 * 収入情報を更新時、情報を入力する画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name updateIncForm
 */

session_start();

// コントローラの共通処理取得
require 'controller.php';
$controller = new controller();

// ログインID取得
$loginID = $controller -> getLoginID();

$id = $_POST['ID'];

// 収入情報の取得
include '../model/searchIncByID.php';
$searchIncByID = new searchIncByID();
$incInfo = $searchIncByID-> searchIncByID($loginID, $id);

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

include '../view/updateIncForm.php';
