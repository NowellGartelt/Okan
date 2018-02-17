<?php
/**
 * 収入更新情報入力画面表示クラス
 * 
 * 収入情報を更新時、情報を入力する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name updateIncForm
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();
$fromPage = $controller -> getFromPage();

$id = $_POST['ID'];

if ($fromPage !== "updateIncResult") {
    // エラー値の初期化
    $errFlg = false;
    $errInput = "";
    $errGetInfo = "";

}

// 移動元ページの設定
$fromPage = "updateIncForm";
$controller -> setFromPage($fromPage);

// 収入情報の取得
require_once '../model/searchIncByID.php';
$searchIncByID = new searchIncByID();
$incList = $searchIncByID -> searchIncByID($userID, $id);
$DBConnect = $controller -> getDBConnectResult();

// DB接続に失敗した場合
if ($DBConnect == false) {
    $errFlg = true;
    $errGetInfo = "emptyList";
    
} else {
    // 収入カテゴリ一覧の取得
    require_once '../model/searchIncCategory.php';
    $searchIncCategory = new searchIncCategory();
    $cateList = $searchIncCategory -> searchIncCategory($userID);
    $DBConnect = $controller -> getDBConnectResult();
    
    // DB接続に失敗した場合
    if ($DBConnect == false) {
        $errFlg = true;
        $errGetInfo = "emptyList";
        
    } else {
        // 収入カテゴリ数取得
        require_once '../model/searchIncCategoryCount.php';
        $searchIncCategoryCount = new searchIncCategoryCount();
        $cateCount = $searchIncCategoryCount -> searchIncCategoryCount($userID);
        $count = $cateCount[0]["COUNT(*)"];
        $DBConnect = $controller -> getDBConnectResult();
        
        for ($i = 0; $i < $count; $i++) {
            // カテゴリ登録がなかった場合、空行を取り除く
            if ($cateList[$i]['categoryName'] == false || $cateList[$i]['categoryName'] == "") {
                unset($cateList[$i]);
                
            }
        }
    }
}
// 画面の表示
include '../view/updateIncForm.php';
