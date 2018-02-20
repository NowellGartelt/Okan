<?php
/**
 * まとめて支払い検索(月ごと)検索条件入力画面表示クラス
 * 
 * まとめて支払い検索(月ごと)の検索条件を入力する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name refPaySortByMonthForm
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

unset($_SESSION['refPay']);

if ($fromPage !== "refPaySortByDayResult") {
    // エラー変数のリセット
    $errFlg = false;
    $errInput = null;
    
}

// 移動元ページの設定
$fromPage = "refPaySortByDayForm";
$controller -> setFromPage($fromPage);

// 支払方法一覧の取得
require_once '../model/searchMethodOfPayment.php';
$searchMethodOfPayment = new searchMethodOfPayment();
$mopList = $searchMethodOfPayment -> getMethodOfPayment();
$DBConnect = $controller -> getDBConnectResult();

// デフォルト税率の取得に失敗したとき
if ($DBConnect == "failed") {
    $errFlg = true;
    $errGetInfo = "emptyList";
    
} else {
    // 支出カテゴリ一覧の取得
    require_once '../model/searchPayCategory.php';
    $searchPayCategory = new searchPayCategory();
    $cateList = $searchPayCategory -> searchPayCategory($userID);
    $DBConnect = $controller -> getDBConnectResult();
    
    // デフォルト税率の取得に失敗したとき
    if ($DBConnect == "failed") {
        $errFlg = true;
        $errGetInfo = "emptyList";
        
    } else {
        // 支出カテゴリ数取得
        require_once '../model/searchPayCategoryCount.php';
        $searchPayCategoryCount = new searchPayCategoryCount();
        $cateCount = $searchPayCategoryCount -> searchPayCategoryCount($userID);
        $count = $cateCount[0]["COUNT(*)"];
        $DBConnect = $controller -> getDBConnectResult();
        
        // 支出カテゴリ数取得に失敗したとき
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
}
// 画面の表示
include '../view/refPaySortByMonthForm.php';
