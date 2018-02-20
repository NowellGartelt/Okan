<?php
/**
 * 収入情報登録画面表示クラス
 * 
 * 収入情報を入力する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name registIncForm
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
$fromPage = $controller -> getFromPage();

// 各モジュール使用フラグの取得
$moduleFlg = $controller -> getIncModuleFlg();
$moduleIncNameFlg = $moduleFlg['incNameFlg'];
$moduleIncCateFlg = $moduleFlg['incCateFlg'];
$moduleIncMemoFlg = $moduleFlg['incMemoFlg'];

if ($fromPage !== "registIncForm") {
    // エラー変数の初期化
    $errFlg = false;
    $errInput = "";
    $errGetInfo = "";
    
}

// 移動元ページの設定
$fromPage = "registIncForm";
$controller -> setFromPage($fromPage);

// 収入カテゴリ一覧の取得
require_once '../model/searchIncCategory.php';
$searchIncCategory = new searchIncCategory();
$cateList = $searchIncCategory -> searchIncCategory($userID);
$DBConnect = $controller -> getDBConnectResult();

if ($DBConnect == "failed") {
    $errFlg = true;
    $errGetInfo = "emptyList";
    
} else {
    // 収入カテゴリ数取得
    require_once '../model/searchIncCategoryCount.php';
    $searchIncCategoryCount = new searchIncCategoryCount();
    $cateCount = $searchIncCategoryCount -> searchIncCategoryCount($userID);
    $count = $cateCount["COUNT(*)"];
    $DBConnect = $controller -> getDBConnectResult();
    
    if ($DBConnect == "failed") {
        $errFlg = true;
        $errGetInfo = "emptyProperties";
        
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
include '../view/registIncForm.php';
