<?php
/**
 * 支払い情報検索結果画面表示クラス
 * 
 * 入力された検索条件の値の妥当性検証、及び検索結果表示画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name referencePayResult
 */
if (!isset($_SESSION)) {
    session_start();
    
}

// コントローラの共通処理取得
require 'controller.php';
$controller = new controller();

// ログインIDとユーザID、移動前のページ名取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();
$fromPage = $controller -> getFromPage();

// 変数初期化
$payName = null;
$payCategory = null;
$payDateFrom = null;
$payDateTo = null;
$payState = null;

// エラー変数初期化
$errFlg = false;
$errResult = "";

// 参照の検索初期画面からの遷移の場合、ポストされた値を取得する
if ($fromPage == "referencePayForm") {
     // ポストされた値の取得
    $payName = $_POST['payName'];
    $payCategory = $_POST['payCategory'];
    $payDateFrom = $_POST['payDateFrom'];
    $payDateTo = $_POST['payDateTo'];
    $payState = $_POST['payState'];
    $methodOfPayment = $_POST['methodOfPayment'];

    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $payName = htmlspecialchars($payName, ENT_QUOTES);
    $payCategory = htmlspecialchars($payCategory, ENT_QUOTES);
    $payState = htmlspecialchars($payState, ENT_QUOTES);
    $methodOfPayment = htmlspecialchars($methodOfPayment, ENT_QUOTES);
    
    // 「なし」が選ばれた場合、検索条件から外すため空の値を入れる
    if ($payCategory == 0) {
        $payCategory = "";
    }
    if ($methodOfPayment == 0) {
        $methodOfPayment = "";
    }
    
    // セッション関数へのセット
    $_SESSION['refPay']['payName'] = $payName;
    $_SESSION['refPay']['payCategory'] = $payCategory;
    $_SESSION['refPay']['payDateFrom'] = $payDateFrom;
    $_SESSION['refPay']['payDateTo'] = $payDateTo;
    $_SESSION['refPay']['payState'] = $payState;
    $_SESSION['refPay']['methodOfPayment'] = $methodOfPayment;

// 参照の検索初期画面以外からの遷移の場合、セッション関数から値を取得する
} else {
    // セッション関数からの値の読み込み
    $payName = $_SESSION['refPay']['payName'];
    $payCategory = $_SESSION['refPay']['payCategory'];
    $payDateFrom = $_SESSION['refPay']['payDateFrom'];
    $payDateTo = $_SESSION['refPay']['payDateTo'];
    $payState = $_SESSION['refPay']['payState'];
    $methodOfPayment = $_SESSION['refPay']['methodOfPayment'];

}

// 移動元ページの設定
$fromPage = "referencePayResult";
$controller -> setFromPage($fromPage);

// 支出情報の取得
require_once '../model/searchPayByTrans.php';
$searchPayByTrans = new searchPayByTrans();
$payList = $searchPayByTrans -> searchPayByTrans($userID, $payName, 
        $payCategory, $payState, $payDateFrom, $payDateTo, $methodOfPayment);
$DBConnect = $controller -> getDBConnectResult();

// DB接続に失敗した場合
if ($DBConnect == false) {
    $errFlg = true;
    $errResult = "failedDBConnect";
    
} else {    
    $payCount = count($payList);
    
    // 結果が100行以上だった場合、検索結果過多でエラーとする
    if($payCount >= 101){
        $errFlg = true;
        $errResult = "OverCapacity";
        
    // 結果が0行だった場合、検索結果なしでエラーとする
    } elseif ($payCount == 0) {
        $errFlg = true;
        $errResult = "noneResult";
        
    }
}

// エラーがあった場合
if ($errFlg == true) {
    // 取得時にエラーがあった場合、エラー画面を表示する
    if ($errResult == "failedDBConnect") {
        include '../view/errReferenceResult.php';
    
    // 所得後のエラーがあった場合、入力画面へ戻す
    } elseif ($errResult == "OverCapacity" || $errResult == "noneResult") {
        require_once 'referencePayForm.php';
}
// エラーとならなかった場合は結果を表示する
} else {
    $sumPayment = null;
    foreach ($payList as $SumPay) {
        $sumPayment += $SumPay['payment'];
    }

    include '../view/referencePayResult.php';
    
}
