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
$fromPage = "refIncCategoryForm";
$controller -> setFromPage($fromPage);

// 現在登録されているカテゴリの取得
require_once '../model/searchIncCategory.php';
$searchIncCategory = new searchIncCategory();
$cateList = $searchIncCategory -> searchIncCategory($userID);

// DBアクセスに失敗したとき
if ($DBConnect == "failed") {
    $errFlg = true;
    $errGetInfo = "emptyList";
    
} else {
    // 現在登録されているカテゴリ数の取得
    require_once '../model/searchIncCategoryCount.php';
    $searchIncCategoryCount = new searchIncCategoryCount();
    $cateCount = $searchIncCategoryCount -> searchIncCategoryCount($userID);
    $count = $cateCount["COUNT(*)"];
    
    // DBアクセスに失敗したとき
    if ($DBConnect == "failed") {
        $errFlg = true;
        $errGetInfo = "emptyProperties";
        
    } else {
        for ($i = 0; $i < $count; $i++) {
            // カテゴリ登録がなかった場合、personalIDとcategoryNameに仮値を入れる
            if ($cateList[$i]['categoryName'] == false || $cateList[$i]['categoryName'] == "") {
                $cateList[$i]['personalID'] = $i + 1;
                $cateList[$i]['categoryName'] = "(未登録)";
                
            }
        }
    }
}
// 画面の読み込み
include '../view/refIncCategoryForm.php';
