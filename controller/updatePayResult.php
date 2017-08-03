<?php
/**
 * 支払い情報更新結果画面表示クラス
 * 
 * 変更された値を元に、入力値の妥当性検証と情報の更新、更新完了画面の呼び出しをする
 * 
 * @access public
 * @package controller
 * @name updatePayResult
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$payName = $_POST['payName'];
$payment = $_POST['payment'];
$payCategory = $_POST['payCategory'];
$payDate = $_POST['payDate'];
$payState = $_POST['payState'];
$id = $_POST['ID'];

if($payName == "" || $payment == "" || $payCategory == "" || $payDate == ""){
    // 入力項目不足でエラー、入力画面に戻す
    $_SESSION["errorInputPay"] = true;
    $errorInputPay = $_SESSION["errorInputPay"];

    include '../model/searchPayByID.php';
    
    $result = new searchPayByID();
    $searchPayByID = $result -> searchPayByID($id);
    $payInfo = $searchPayByID;
    
    include '../view/updatePayForm.php';
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