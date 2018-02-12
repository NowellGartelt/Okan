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
session_start();

// コントローラの共通処理取得
require 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

$page = $_POST['page'];

// 変数初期化
$payName = null;
$payCategory = null;
$payDateFrom = null;
$payDateTo = null;
$payState = null;
$errResult = null;

// 参照の検索初期画面からの遷移の場合、ポストされた値を取得する
if ($page == "reference") {
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
    $_SESSION['payName'] = $payName;
    $_SESSION['payCategory'] = $payCategory;
    $_SESSION['payDateFrom'] = $payDateFrom;
    $_SESSION['payDateTo'] = $payDateTo;
    $_SESSION['payState'] = $payState;
    $_SESSION['methodOfPayment'] = $methodOfPayment;

// 参照の検索初期画面以外からの遷移の場合、セッション関数から値を取得する
} else {
    // セッション関数からの値の読み込み
    $payName = $_SESSION['payName'];
    $payCategory = $_SESSION['payCategory'];
    $payDateFrom = $_SESSION['payDateFrom'];
    $payDateTo = $_SESSION['payDateTo'];
    $payState = $_SESSION['payState'];
    $methodOfPayment = $_SESSION['methodOfPayment'];

}

require_once '../model/searchPayByTrans.php';
$searchPayByTrans = new searchPayByTrans();
$payList = $searchPayByTrans -> searchPayByTrans($userID, $payName, 
        $payCategory, $payState, $payDateFrom, $payDateTo, $methodOfPayment);

$payCount = count($payList);

// 結果が100行以上だった場合、検索結果過多でエラーとする
if($payCount >= 101){
    $errResult = "OverCapacity";

// 結果が0行だった場合、検索結果なしでエラーとする
} elseif ($payCount == 0) {
    $errResult = "noneResult";

}

// エラーがあった場合、入力画面に戻す
if ($errResult !== null) {
    $_SESSION['payName'] = null;
    $_SESSION['payCategory'] = null;
    $_SESSION['payDateFrom'] = null;
    $_SESSION['payDateTo'] = null;
    $_SESSION['payState'] = null;
    $_SESSION['methodOfPayment'] = null;
    
    // 支払方法一覧の取得
    require_once '../model/searchMethodOfPayment.php';
    $searchMethodOfPayment = new searchMethodOfPayment();
    $mopList = $searchMethodOfPayment -> getMethodOfPayment();
    
    // 支出カテゴリ一覧の取得
    require_once '../model/searchPayCategory.php';
    $searchPayCategory = new searchPayCategory();
    $cateList = $searchPayCategory -> searchPayCategory($userID);
    
    // 支出カテゴリ数取得
    require_once '../model/searchPayCategoryCount.php';
    $searchPayCategoryCount = new searchPayCategoryCount();
    $cateCount = $searchPayCategoryCount -> searchPayCategoryCount($userID);
    $count = $cateCount[0]["COUNT(*)"];
    
    for ($i = 0; $i < $count; $i++) {
        // カテゴリ登録がなかった場合、空行を取り除く
        if ($cateList[$i]['categoryName'] == false || $cateList[$i]['categoryName'] == "") {
            unset($cateList[$i]);
        }
    }
    
    include '../view/referencePayForm.php';
    
// エラーとならなかった場合は結果を表示する
} else {
    $sumPayment = null;
    foreach ($payList as $SumPay) {
        $sumPayment += $SumPay['payment'];
    }

    include '../view/referencePayResult.php';
}
