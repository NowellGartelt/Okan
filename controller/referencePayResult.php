<!-- controller/referencePayResult.php -->
<?php
session_start();

// ログイン検証
include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

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

    // エスケープ処理
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