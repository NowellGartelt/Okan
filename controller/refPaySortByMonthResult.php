<?php
/**
 * まとめて支払い検索(月ごと)検索結果画面表示クラス
 * 
 * まとめて支払い検索(月ごと)の検索条件として入力された値の妥当性チェック、検索結果の表示画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name refPaySortByMonthResult
 */

session_start();

// ログイン検証
include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

// インスタンス変数の定義
$result = null;
$searchPayByMonth = null;
$payment = null;
$payCount = null;

// エラー変数のリセット
$errInput = "";

// セッション関数へのセット
$payName = $_POST['payName'];
$payCategory = $_POST['payCategory'];
$payDateFrom = $_POST['payDateFrom'];
$payDateTo = $_POST['payDateTo'];
$choiceKey = $_POST['choiceKey'];
$methodOfPayment = $_POST['methodOfPayment'];

// スクリプト挿入攻撃、XSS対策
// パスワードの特殊文字をHTMLエンティティ文字へ変換する。
$payName = htmlspecialchars($payName, ENT_QUOTES);
$payCategory = htmlspecialchars($payCategory, ENT_QUOTES);

$_SESSION['payName'] = $payName;
$_SESSION['payCategory'] = $payCategory;
$_SESSION['payDateFrom'] = $payDateFrom;
$_SESSION['payDateTo'] = $payDateTo;
$_SESSION['choiceKey'] = $choiceKey;
$_SESSION['$methodOfPayment'] = $methodOfPayment;

include '../model/searchPayByMonth.php';

// 項目不足だった場合、入力項目不足エラー
if (($choiceKey == "payName" && $payName == "") 
        || ($choiceKey == "payCategory" && $payCategory == "")) {
    $errInput = "luckNecessaryInfo";
    
} else {
    $result = new searchPayByMonth();
    $searchPayByMonth = $result->searchPayByMonth(
            $loginID, $payName, $payCategory, 
            $payDateFrom, $payDateTo, $choiceKey, $methodOfPayment);
 
    $payment = $searchPayByMonth;
    $payCount = count($searchPayByMonth);
    
    // 結果が100行以上だった場合、検索結果過多でエラー
    if ($payCount >= 101) {
        $errInput = "errReferencePayCount";
        
    }
}

// エラーがあった場合、入力画面に戻す
if ($errInput !== "") {
    $_SESSION['payName'] = null;
    $_SESSION['payCategory'] = null;
    $_SESSION['payDateFrom'] = null;
    $_SESSION['payDateTo'] = null;
    $_SESSION['choiceKey'] = null;
    $_SESSION['methodOfPayment'] = null;

    // 支払方法一覧の取得
    include '../model/searchMethodOfPayment.php';
    $searchMethodOfPayment = new searchMethodOfPayment();
    $mopList = $searchMethodOfPayment -> getMethodOfPayment();
    
    include '../view/refPaySortByMonthForm.php';

// エラーとならなかった場合は結果を表示する
} else {
    $sumPayment = null;
    foreach ($payment as $SumPay) {
        $sumPayment += $SumPay['SUM(payment)'];
    }

    include '../view/refPaySortByMonthResult.php';
}
