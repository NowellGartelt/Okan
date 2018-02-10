<?php
/**
 * 収入情報検索条件入力画面表示クラス
 * 
 * 収入情報を検索するため、情報を入力する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name referenceIncForm
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

$_SESSION['incName'] = null;
$_SESSION['incCategory'] = null;
$_SESSION['incDateFrom'] = null;
$_SESSION['incDateTo'] = null;
$_SESSION['incState'] = null;

$errResult = null;

// 支出カテゴリ一覧の取得
require_once '../model/searchIncCategory.php';
$searchIncCategory = new searchIncCategory();
$cateList = $searchIncCategory -> searchIncCategory($userID);

// 支出カテゴリ数取得
require_once '../model/searchIncCategoryCount.php';
$searchIncCategoryCount = new searchIncCategoryCount();
$cateCount = $searchIncCategoryCount -> searchIncCategoryCount($userID);
$count = $cateCount[0]["COUNT(*)"];

for ($i = 0; $i < $count; $i++) {
    // カテゴリ登録がなかった場合、空行を取り除く
    if ($cateList[$i]['categoryName'] == false || $cateList[$i]['categoryName'] == "") {
        unset($cateList[$i]);
    }
}

include '../view/referenceIncForm.php';
