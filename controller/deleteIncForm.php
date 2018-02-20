<?php
/**
* 収入情報削除確認画面表示クラス
* 
* 収入情報の削除前の確認として、削除対象の情報を表示する画面を呼び出す
* 
* @author NowellGartelt
* @access public
* @package controller
* @name deleteIncForm
*/
/* controller準備ここから */

session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// 値の取得
$id = $_POST['ID'];

// 移動元ページの設定
$fromPage = "deleteIncForm";
$controller -> setFromPage($fromPage);

// エラー変数の初期化
$errFlg = false;
$errGetInfo = "";

/* controller準備ここまで */

/* 画面表示準備ここから */

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
    // 使ったものの名前が空のとき、(登録なし)を入れる
    if ($incList['incName'] == "") {
        $incList['incName'] = "(登録なし)";
    }
    // 一言メモが空のとき、(登録なし)を入れる
    if ($incList['incState'] == "") {
        $incList['incState'] = "(登録なし)";
    }
    // カテゴリ名が空のとき、(登録なし)を入れる
    if ($incList['categoryName'] == "") {
        $incList['categoryName'] = "(登録なし)";
    }
    
    // 日付の分割
    $incInfoDateYear = mb_substr($incList['incDate'], 0, 4);
    $incInfoDateMonth = mb_substr($incList['incDate'], 5, 2);
    $incInfoDateDay = mb_substr($incList['incDate'], 8, 2);
    
}

// エラーがあった場合
if ($errFlg == true && $errGetInfo !== "") {
    // エラー画面表示
    include '../view/errDeleteResult.php';
    
} else {
    // 画面表示
    include '../view/deleteIncForm.php';
    
}
/* 画面表示準備ここまで */
