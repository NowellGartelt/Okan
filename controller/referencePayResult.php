<?php
/**
 * 支払い情報検索結果画面表示クラス
 * 
 * 入力された検索条件の値の妥当性検証、及び検索結果表示画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name referencePayResult
 */

session_start();

// コントローラの共通処理取得
require 'controller.php';
$controller = new controller();

// ログインID取得
$loginID = $controller -> getLoginID();

$page = $_POST['page'];

// 変数初期化
$payName = null;
$payCategory = null;
$payDateFrom = null;
$payDateTo = null;
$payState = null;

// 参照の検索初期画面からの遷移の場合、ポストされた値を取得する
if ($page == "reference") {
     // ポストされた値の取得
    $payName = $_POST['payName'];
    $payCategory = $_POST['payCategory'];
    $payDateFrom = $_POST['payDateFrom'];
    $payDateTo = $_POST['payDateTo'];
    $payState = $_POST['payState'];

    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $payName = htmlspecialchars($payName, ENT_QUOTES);
    $payCategory = htmlspecialchars($payCategory, ENT_QUOTES);
    $payState = htmlspecialchars($payState, ENT_QUOTES);

    // セッション関数へのセット
    $_SESSION['payName'] = $payName;
    $_SESSION['payCategory'] = $payCategory;
    $_SESSION['payDateFrom'] = $payDateFrom;
    $_SESSION['payDateTo'] = $payDateTo;
    $_SESSION['payState'] = $payState;

// 参照の検索初期画面以外からの遷移の場合、セッション関数から値を取得する
} else {
    // セッション関数からの値の読み込み
    $payName = $_SESSION['payName'];
    $payCategory = $_SESSION['payCategory'];
    $payDateFrom = $_SESSION['payDateFrom'];
    $payDateTo = $_SESSION['payDateTo'];
    $payState = $_SESSION['payState'];

}

include '../model/searchPayByTrans.php';

$result = new searchPayByTrans();
$searchPayByTrans = $result -> searchPayByTrans($loginID, $payName, 
        $payCategory, $payState, $payDateFrom, $payDateTo);

$payment = $searchPayByTrans;
$payCount = count($searchPayByTrans);

// 結果が100行以上だった場合、検索結果過多でエラーとする
if($payCount >= 101){
    $errorReferencePayCount = true;

    $_SESSION['payName'] = null;
    $_SESSION['payCategory'] = null;
    $_SESSION['payDateFrom'] = null;
    $_SESSION['payDateTo'] = null;
    $_SESSION['payState'] = null;

    include '../view/referencePayForm.php';

// 結果が0行だった場合、検索結果なしでエラーとする
} elseif ($payCount == 0) {
    $errorReferencePayNone = true;

    $_SESSION['payName'] = null;
    $_SESSION['payCategory'] = null;
    $_SESSION['payDateFrom'] = null;
    $_SESSION['payDateTo'] = null;
    $_SESSION['payState'] = null;

    include '../view/referencePayForm.php';

// エラーとならなかった場合は結果を表示する
} else {
    $sumPayment = null;
    foreach ($payment as $SumPay) {
        $sumPayment += $SumPay['payment'];
    }

    include '../view/referencePayResult.php';
}
?>