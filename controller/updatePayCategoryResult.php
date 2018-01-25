<?php
/**
 * カテゴリ(支払)情報更新結果画面表示クラス
 * 
 * 変更された値を元に、入力値の妥当性検証と情報の更新、カテゴリ情報表示画面の呼び出しをする
 * 
 * @access public
 * @package controller
 * @name updatePayCategoryResult
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$categoryID = $_POST['ID'];
$categoryName = $_POST['categoryName'];

// カテゴリ名が入力されてなかった場合
if($categoryName == ""){
    // 入力項目不足でエラー、入力画面に戻す
    $errorInputInfo = "nullInfo";
    
    // 最大登録数
    $maxRegist = 10;
    
    // 現在の登録カテゴリ情報取得
    include '../model/searchPayCategory.php';
    $getCategory = new searchPayCategory();
    $result = $getCategory-> searchPayCategory($loginID, $maxRegist);
    
    // 画面の読み込み
    include '../view/refPayCategoryForm.php';

} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $payName = htmlspecialchars($payName, ENT_QUOTES);
    $payment = htmlspecialchars($payment, ENT_QUOTES);
    $payCategory = htmlspecialchars($payCategory, ENT_QUOTES);
    $payState = htmlspecialchars($payState, ENT_QUOTES);

    include '../model/updatePayByTrans.php';
    
    $result = new updatePayByTrans();
    $updatePayByTrans = $result -> updatePayByTrans($loginID, $payName, 
            $payment, $payCategory, $payDate, $payState, $id);
    $payInfo = $updatePayByTrans;
    
    include '../view/updatePayResult.php';
}
?>