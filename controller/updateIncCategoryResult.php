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
require 'controller.php';
$controller = new controller();

// ログインID取得
$loginID = $controller -> getLoginID();

$personalID = $_POST['personalID'];
$categoryName = $_POST['categoryName'];
$categoryNameBefore = $_POST['categoryNameBefore'];

// カテゴリ名が入力されてなかった場合
if($categoryName == ""){
    // 入力項目不足でエラー、入力画面に戻す
    $errorInput = "nullInfo";
    
    // 指定されたNoに登録されているカテゴリ情報の取得
    include '../model/searchIncCategoryByID.php';
    $getCategory = new searchIncCategoryByID();
    $result = $getCategory-> searchIncCategoryByID($loginID, $personalID);
    
    if ($result['categoryName'] == null) {
        $result['categoryName'] = "(未登録)";
    }
    
    // 画面の読み込み
    include '../view/updateIncCategoryForm.php';
    
} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $categoryName = htmlspecialchars($categoryName, ENT_QUOTES);
    
    // カテゴリ名更新
    include '../model/updateIncCategory.php';
    $result = new updateIncCategory();
    $updateIncCategory = $result -> updateIncCategory($loginID, $categoryName, $personalID);
    
    include '../view/updateIncCategoryResult.php';
}
