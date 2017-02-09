<!-- controller/refPaySortByDayResult.php -->
<?php
session_start();

// ログイン検証
include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

// セッション関数へのセット
$payName = $_POST['payName'];
$payCategory = $_POST['payCategory'];
$payDateFrom = $_POST['payDateFrom'];
$payDateTo = $_POST['payDateTo'];
$choiceKey = $_POST['choiceKey'];
 
$payName = htmlspecialchars($payName, ENT_QUOTES);
$payCategory = htmlspecialchars($payCategory, ENT_QUOTES);

$_SESSION['payName'] = $payName;
$_SESSION['payCategory'] = $payCategory;
$_SESSION['payDateFrom'] = $payDateFrom;
$_SESSION['payDateTo'] = $payDateTo;
$_SESSION['choiceKey'] = $choiceKey;

include '../model/searchPaymentByDay.php';

if (($choiceKey == "payName" && $payName == "") 
 || ($choiceKey == "payCategory" && $payCategory == "")) {
 $errorNecessaryInfo = true;
 	
 $_SESSION['payName'] = "";
 $_SESSION['payCategory'] = "";
 $_SESSION['payDateFrom'] = "";
 $_SESSION['payDateTo'] = "";
 $_SESSION['choiceKey'] = "";
 	
 include '../view/refPaySortByDayForm.php';
 
} else {
 $result = new searchPaymentByDay();
 $searchPaymentByDay = $result->searchPaymentByDay($payName, 
  $payCategory, $payDateFrom, $payDateTo, $choiceKey);
 
 $payment = $searchPaymentByDay;
 $payCount = count($searchPaymentByDay);
}
// 結果が100行以上だった場合、検索結果過多でエラーとする
if ($payCount >= 101) {
 $errorReferencePayCount = true;

 $_SESSION['payName'] = "";
 $_SESSION['payCategory'] = "";
 $_SESSION['payDateFrom'] = "";
 $_SESSION['payDateTo'] = "";
 $_SESSION['choiceKey'] = "";

 include '../view/refPaySortByDayForm.php';

// 結果が0行だった場合、検索結果なしでエラーとする
} elseif ($payCount == 0) {
 $errorReferencePayNone = true;

 $_SESSION['payName'] = "";
 $_SESSION['payCategory'] = "";
 $_SESSION['payDateFrom'] = "";
 $_SESSION['payDateTo'] = "";
 $_SESSION['choiceKey'] = "";

 include '../view/refPaySortByDayForm.php';
 
// エラーとならなかった場合は結果を表示する
} else {
 $sumPayment = 0;
 foreach ($payment as $SumPay) {
   $sumPayment += $SumPay['SUM(payment)'];
 }

 include '../view/refPaySortByDayResult.php';

}

mysqli_close($link);
?>