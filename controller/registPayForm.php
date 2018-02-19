<?php
/**
 * 支払い登録画面表示クラス
 * 
 * 支払い情報を入力する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name registPayForm
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID、移動前のページ名取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();
$fromPage = $controller -> getFromPage();

// 各モジュール使用フラグの取得
$modulePayFlg = $controller -> getPayModuleFlg();
$moduleTaxCalcFlg = $modulePayFlg['taxCalcFlg'];
$modulePayNameFlg = $modulePayFlg['payNameFlg'];
$modulePayCateFlg = $modulePayFlg['payCateFlg'];
$modulePaymentFlg = $modulePayFlg['paymentFlg'];
$modulePayMemoFlg = $modulePayFlg['payMemoFlg'];

// 移動前ページが支出登録結果クラス以外だった場合
if ($fromPage !== "registPayResult") {
    // エラー変数の初期化
    $errFlg = false;
    $errInput = "";
    $errGetInfo = "";
    
} 

// 移動元ページの設定
$fromPage = "registPayForm";
$controller -> setFromPage($fromPage);

// ユーザのデフォルト税率設定の取得
require_once '../model/searchDefTaxByID.php';
$searchDefTaxByID = new searchDefTaxByID();
$tax = $searchDefTaxByID -> searchDefTaxByID($userID);
$DBConnect = $controller -> getDBConnectResult();

// デフォルト税率の取得に失敗したとき
if ($DBConnect == "failed") {
    $errFlg = true;
    $errGetInfo = "emptyProperties";
    
} else {
    // 支払方法一覧の取得
    require_once '../model/searchMethodOfPayment.php';
    $searchMethodOfPayment = new searchMethodOfPayment();
    $mopList = $searchMethodOfPayment -> getMethodOfPayment();
    $DBConnect = $controller -> getDBConnectResult();
    
    // 支払方法一覧取得に失敗したとき
    if ($DBConnect == "failed") {
        $errFlg = true;
        $errGetInfo = "emptyList";
        
    } else {
        // 支出カテゴリ一覧の取得
        require_once '../model/searchPayCategory.php';
        $searchPayCategory = new searchPayCategory();
        $cateList = $searchPayCategory -> searchPayCategory($userID);
        $DBConnect = $controller -> getDBConnectResult();
        
        // 支出カテゴリ一覧取得に失敗したとき
        if ($DBConnect == "failed") {
            $errFlg = true;
            $errGetInfo = "emptyList";
            
        } else {
            // 支出カテゴリ数取得
            require_once '../model/searchPayCategoryCount.php';
            $searchPayCategoryCount = new searchPayCategoryCount();
            $cateCount = $searchPayCategoryCount -> searchPayCategoryCount($userID);
            $count = $cateCount["COUNT(*)"];
            $DBConnect = $controller -> getDBConnectResult();
            
            // DB接続に失敗したとき
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
}
// 画面の表示
include '../view/registPayForm.php';
