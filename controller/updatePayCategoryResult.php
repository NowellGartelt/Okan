<?php
/**
 * カテゴリ(支出)情報更新結果画面表示クラス
 * 
 * 変更された値を元に、入力値の妥当性検証と情報の更新、カテゴリ情報表示画面の呼び出しをする
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name updatePayCategoryResult
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

$personalID = $_POST['personalID'];
$categoryName = $_POST['categoryName'];
$categoryNameBefore = $_POST['categoryNameBefore'];

// エラー変数の初期化
$errFlg = false;
$errInput = "";
$errResult = "";

// 移動元ページの設定
$fromPage = "updatePayCategoryResult";
$controller -> setFromPage($fromPage);

// カテゴリ名が入力されてなかった場合
if ($categoryName == ""){
    // 入力項目不足でエラー、入力画面に戻す
    $errInput = "nullInfo";
    
    require_once 'updatePayCategoryForm.php';
    
} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $categoryName = htmlspecialchars($categoryName, ENT_QUOTES);
    
    // 更新日時取得
    $updateDate = date("Y-m-d H:i:s");
    
    // DB接続に失敗した場合
    if ($DBConnect == "failed") {
        $errFlg = true;
        $errResult = "failedUpdate";
        
    } else {
        // カテゴリ名更新
        require_once '../model/updatePayCategory.php';
        $updatePayCategory = new updatePayCategory();
        $updResult = $updatePayCategory-> updatePayCategory($userID, $categoryName, 
                $personalID, $updateDate);
        $DBConnect = $controller -> getDBConnectResult();
        
    }
    
    // エラーがあった場合
    if ($errFlg == true && ($errInput !== "" || $errResult !== "")) {
        // エラー画面の表示
        include '../view/errUpdateResult.php';
        
    } else {
        // 画面の読み込み
        include '../view/updatePayCategoryResult.php';
        
    }
}
