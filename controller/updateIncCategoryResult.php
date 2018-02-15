<?php
/**
 * カテゴリ(収入)情報更新結果画面表示クラス
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
$errInput = "";

// 移動元ページの設定
$fromPage = "updateIncCategoryResult";
$controller -> setFromPage($fromPage);

// カテゴリ名が入力されてなかった場合
if ($categoryName == "") {
    // 入力項目不足でエラー、入力画面に戻す
    $errInput = "nullInfo";
    
    // 指定されたNoに登録されているカテゴリ情報の取得
    require_once '../model/searchIncCategoryByID.php';
    $searchIncCategoryByID = new searchIncCategoryByID();
    $cateList = $searchIncCategoryByID -> searchIncCategoryByID($userID, $personalID);
    
    if ($cateList['categoryName'] == null) {
        $cateList['categoryName'] = "(未登録)";
    }
    
    // 画面の読み込み
    include '../view/updateIncCategoryForm.php';
    
} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $categoryName = htmlspecialchars($categoryName, ENT_QUOTES);
    
    // 更新日時取得
    $updateDate = date("Y-m-d H:i:s");
    
    // カテゴリ名更新
    require_once '../model/updateIncCategory.php';
    $updateIncCategory = new updateIncCategory();
    $updResult = $updateIncCategory -> updateIncCategory($userID, $categoryName, 
            $personalID, $updateDate);
    
    include '../view/updateIncCategoryResult.php';
}
