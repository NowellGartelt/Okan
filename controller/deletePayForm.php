<?php
/**
 * 支払い情報削除確認画面表示クラス
 * 
 * 支払い情報削除前確認のため、支払い情報削除確認画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name deletePayForm
 */
/* controler準備ここから */

if (!isset($_SESSION)) {
    session_start();
    
}

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// 値の取得
$id = $_POST['ID'];

// 移動元ページの設定
$fromPage = "deletePayForm";
$controller -> setFromPage($fromPage);

// エラー変数の初期化
$errFlg = false;
$errGetInfo = "";

/* controller準備ここまで */

/* 画面表示準備ここから */

// 支出情報の取得
require_once '../model/searchPayByID.php';
$searchPayByID = new searchPayByID();
$payList = $searchPayByID -> searchPayByID($userID, $id);
$DBConnect = $controller -> getDBConnectResult();

// DB接続に失敗した場合
if ($DBConnect == false) {
    $errFlg = true;
    $errGetInfo = "emptyList";
    
} else {
    // 使ったものの名前が空のとき、(登録なし)を入れる
    if ($payList['payName'] == "") {
        $payList['payName'] = "(登録なし)";
    }
    // 一言メモが空のとき、(登録なし)を入れる
    if ($payList['payState'] == "") {
        $payList['payState'] = "(登録なし)";
    }
    // 支払方法が空のとき、(登録なし)を入れる
    if ($payList['paymentName'] == "") {
        $payList['paymentName'] = "(登録なし)";
    }
    // カテゴリ名が空のとき、(登録なし)を入れる
    if ($payList['categoryName'] == "") {
        $payList['categoryName'] = "(登録なし)";
    }
    
    // 日付の分割
    $payInfoDateYear = mb_substr($payList['payDate'], 0, 4);
    $payInfoDateMonth = mb_substr($payList['payDate'], 5, 2);
    $payInfoDateDay = mb_substr($payList['payDate'], 8, 2);
    
}

// エラーが発生した場合
if ($errFlg == true) {
    if ($errGetInfo !== "") {
        // エラー画面表示
        include '../view/errDeleteResult.php';
    
    }
} else {
    // 画面表示
    include '../view/deletePayForm.php';

}

/* 画面表示準備ここまで */
