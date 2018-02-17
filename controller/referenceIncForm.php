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
$fromPage = $controller -> getFromPage();

unset($_SESSION['refPay']);

if ($fromPage !== "referenceIncResult") {
    $errFlg = false;
    $errResult = "";
    
}

// 移動元ページの設定
$fromPage = "referenceIncForm";
$controller -> setFromPage($fromPage);

// 支出カテゴリ一覧の取得
require_once '../model/searchIncCategory.php';
$searchIncCategory = new searchIncCategory();
$cateList = $searchIncCategory -> searchIncCategory($userID);
$DBConnect = $controller -> getDBConnectResult();

// 取得に失敗したとき
if ($DBConnect == "failed") {
    $errFlg = true;
    $errResult = "emptyList";
    
} else {
    // 支出カテゴリ数取得
    require_once '../model/searchIncCategoryCount.php';
    $searchIncCategoryCount = new searchIncCategoryCount();
    $cateCount = $searchIncCategoryCount -> searchIncCategoryCount($userID);
    $count = $cateCount["COUNT(*)"];
    $DBConnect = $controller -> getDBConnectResult();
    
    // 取得に失敗したとき
    if ($DBConnect == "failed") {
        $errFlg = true;
        $errResult = "emptyProperties";
        
    } else {
        for ($i = 0; $i < $count; $i++) {
            // カテゴリ登録がなかった場合、空行を取り除く
            if ($cateList[$i]['categoryName'] == false || $cateList[$i]['categoryName'] == "") {
                unset($cateList[$i]);
            
            }
        }
    }
}
// 画面の表示
include '../view/referenceIncForm.php';
