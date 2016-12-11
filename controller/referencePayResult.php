<!-- controller/referencePayResult.php -->
<?php
session_start();

// ログイン検証
include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

// セッション関数のチェック
// セッション関数が空の場合、入力された値をセッション関数に入れる
// セッション関数が空でない場合、セッション関数から値を取得する
// if ($_SESSION['payName'] == "" && $_SESSION['payCategory'] == "" && $_SESSION['payDateFrom'] == "" && $_SESSION['payDateTo'] == "" && $_SESSION['payState'] == "" && $_SESSION['sortBy'] == ""){
 $payName = $_POST['payName'];
 $payCategory = $_POST['payCategory'];
 $payDateFrom = $_POST['payDateFrom'];
 $payDateTo = $_POST['payDateTo'];
 $payState = $_POST['payState'];
 $sortBy = $_POST['sortBy'];
 
 $payName = htmlspecialchars($payName, ENT_QUOTES);
 $payCategory = htmlspecialchars($payCategory, ENT_QUOTES);
 $payState = htmlspecialchars($payState, ENT_QUOTES);

 $_SESSION['payName'] = $payName;
 $_SESSION['payCategory'] = $payCategory;
 $_SESSION['payDateFrom'] = $payDateFrom;
 $_SESSION['payDateTo'] = $payDateTo;
 $_SESSION['payState'] = $payState;
 $_SESSION['sortBy'] = $sortBy;

// } else {
 /*
 $payName = $_SESSION['payName'];
 $payCategory = $_SESSION['payCategory'];
 $payDateFrom = $_SESSION['payDateFrom'];
 $payDateTo = $_SESSION['payDateTo'];
 $payState = $_SESSION['payState'];
 $sortBy = $_SESSION['sortBy'];
*/
//}

include '../model/searchPaymentByTransaction.php';
include '../model/searchPaySumByTransaction.php';

$test = new searchPaymentByTransaction();
$searchPaymentByTransaction = $test->searchPaymentByTransaction($payName, $payCategory, $payState, $payDateFrom, $payDateTo);

$payment = $searchPaymentByTransaction;
$payCount = count($searchPaymentByTransaction);

// 結果が100行以上だった場合、検索結果過多でエラーとする
if($payCount >= 101){
 $errorReferencePayCount = true;

 $_SESSION['payName'] = "";
 $_SESSION['payCategory'] = "";
 $_SESSION['payDateFrom'] = "";
 $_SESSION['payDateTo'] = "";
 $_SESSION['payState'] = "";

 include '../view/referencePayForm.php';

// 結果が0行だった場合、検索結果なしでエラーとする
} elseif ($payCount == 0) {
 $errorReferencePayNone = true;

 $_SESSION['payName'] = "";
 $_SESSION['payCategory'] = "";
 $_SESSION['payDateFrom'] = "";
 $_SESSION['payDateTo'] = "";
 $_SESSION['payState'] = "";

 include '../view/referencePayForm.php';

// エラーとならなかった場合は結果を表示する
} else {
 $sumPayment = 0;
 foreach ($payment as $SumPay) {
   $sumPayment += $SumPay['payment'];
 }

 include '../view/referencePayResult.php';

}

mysqli_close($link);
?>