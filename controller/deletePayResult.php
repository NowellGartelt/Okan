<?php
/**
 * 支払い情報削除結果画面表示クラス
 * 
 * 支払い情報の削除処理を行い、削除結果を表示する
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name deletePayResult
 */
/* controller準備ここから */

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
$payDate = $_POST['payDate'];
$payName = $_POST['payName'];
$payment = $_POST['payment'];

// 移動元ページの設定
$fromPage = "deletePayResult";
$controller -> setFromPage($fromPage);

// エラー変数の初期化
$errFlg = false;
$errResult = "";

/* controller準備ここまで */

/* 画面表示ここから */

// 支出情報の削除
require_once '../model/deletePayByTrans.php';
$deletePayByTrans = new deletePayByTrans();
$payInfo = $deletePayByTrans -> deletePayByTrans($userID, $id);
$DBConnect = $controller -> getDBConnectResult();

// DB接続に失敗した場合
if ($DBConnect == false) {
    $errFlg = true;
    $errResult = "failedDelete";
    
}

// エラーがあった場合
if ($errFlg == true) {
    if ($errResult !== "") {
        // エラー画面表示
        include '../view/errDeleteResult.php';
    
    }
} else {
    // 画面表示
    include '../view/deletePayResult.php';
    
}

/* 画面表示ここまで */
