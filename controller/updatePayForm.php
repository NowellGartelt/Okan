<?php
/**
 * 支払い情報更新画面表示クラス
 * 
 * 登録済み支払い情報を呼び出し、支払い情報更新画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name updatePayForm
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

if ($fromPage !== "updatePayResult") {
    $errFlg = false;
    $errInput = "";
    $errGetInfo = "";
    
}

// 移動元ページの設定
$fromPage = "updatePayForm";
$controller -> setFromPage($fromPage);

// 支出情報の取得
require_once '../model/searchPayByID.php';
$searchPayByID = new searchPayByID();
$payList = $searchPayByID -> searchPayByID($userID, $id);
$DBConnect = $controller -> getDBConnectResult();

// DB接続に失敗した場合
if ($DBConnect == false) {
    $errFlg = true;
    $errGetInfo= "emptyList";
    
} else {
    // 支払方法一覧の取得
    require_once '../model/searchMethodOfPayment.php';
    $searchMethodOfPayment = new searchMethodOfPayment();
    $mopList = $searchMethodOfPayment -> getMethodOfPayment();
    $DBConnect = $controller -> getDBConnectResult();
    
    // DB接続に失敗した場合
    if ($DBConnect == false) {
        $errFlg = true;
        $errGetInfo= "emptyList";
        
    } else {
        // 支出カテゴリ一覧の取得
        require_once '../model/searchPayCategory.php';
        $searchPayCategory = new searchPayCategory();
        $cateList = $searchPayCategory -> searchPayCategory($userID);
        $DBConnect = $controller -> getDBConnectResult();
        
        // DB接続に失敗した場合
        if ($DBConnect == false) {
            $errFlg = true;
            $errGetInfo= "emptyList";
            
        } else {
            // 支出カテゴリ数取得
            require_once '../model/searchPayCategoryCount.php';
            $searchPayCategoryCount = new searchPayCategoryCount();
            $cateCount = $searchPayCategoryCount -> searchPayCategoryCount($userID);
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
}
// 画面の表示
include '../view/updatePayForm.php';
