<?php
/**
 * まとめて支払い検索(日ごと)検索結果画面表示クラス
 * 
 * まとめて支払い検索(日ごと)の検索条件として入力された値の妥当性チェック、検索結果の表示画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name refPaySortByDayResult
 */

session_start();

// ログイン検証
include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

// セッション関数へのセット
$payName = $_POST['payName'];
$payCategory = $_POST['payCategory'];
$payDateFrom = $_POST['payDateFrom'];
$payDateTo = $_POST['payDateTo'];
$choiceKey = $_POST['choiceKey'];

// スクリプト挿入攻撃、XSS対策
// パスワードの特殊文字をHTMLエンティティ文字へ変換する。
$payName = htmlspecialchars($payName, ENT_QUOTES);
$payCategory = htmlspecialchars($payCategory, ENT_QUOTES);

$_SESSION['payName'] = $payName;
$_SESSION['payCategory'] = $payCategory;
$_SESSION['payDateFrom'] = $payDateFrom;
$_SESSION['payDateTo'] = $payDateTo;
$_SESSION['choiceKey'] = $choiceKey;

include '../model/searchPayByDay.php';

if (($choiceKey == "payName" && $payName == "") 
        || ($choiceKey == "payCategory" && $payCategory == "")) {
    $errorNecessaryInfo = true;
 	
    $_SESSION['payName'] = null;
    $_SESSION['payCategory'] = null;
    $_SESSION['payDateFrom'] = null;
    $_SESSION['payDateTo'] = null;
    $_SESSION['choiceKey'] = null;
 	
    include '../view/refPaySortByDayForm.php';
} else {
    $result = new searchPayByDay();
    $searchPayByDay = $result->searchPayByDay(
            $loginID, $payName, $payCategory, 
            $payDateFrom, $payDateTo, $choiceKey);
 
    $payment = $searchPayByDay;
    $payCount = count($searchPayByDay);

// 結果が100行以上だった場合、検索結果過多でエラーとする
if ($payCount >= 101) {
    $errorReferencePayCount = true;

    $_SESSION['payName'] = null;
    $_SESSION['payCategory'] = null;
    $_SESSION['payDateFrom'] = null;
    $_SESSION['payDateTo'] = null;
    $_SESSION['choiceKey'] = null;

    include '../view/refPaySortByDayForm.php';

// 結果が0行だった場合、検索結果なしでエラーとする
} elseif ($payCount == 0) {
    $errorReferencePayNone = true;

    $_SESSION['payName'] = null;
    $_SESSION['payCategory'] = null;
    $_SESSION['payDateFrom'] = null;
    $_SESSION['payDateTo'] = null;
    $_SESSION['choiceKey'] = null;

    include '../view/refPaySortByDayForm.php';
 
// エラーとならなかった場合は結果を表示する
} else {
    $sumPayment = null;
    foreach ($payment as $SumPay) {
        $sumPayment += $SumPay['SUM(payment)'];
    }

    include '../view/refPaySortByDayResult.php';
}
}
?>