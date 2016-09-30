<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

if ($_SESSION['payment'] == "" && $_SESSION['payCategory'] == "" && $_SESSION['payDateFrom'] == "" && $_SESSION['payDateTo'] == "" && $_SESSION['payState'] == ""){
 $payName = $_POST['payName'];
 $payCategory = $_POST['payCategory'];
 $payDateFrom = $_POST['payDateFrom'];
 $payDateTo = $_POST['payDateTo'];
 $payState = $_POST['payState'];
 
 $payName = htmlspecialchars($payName, ENT_QUOTES);
 $payCategory = htmlspecialchars($payCategory, ENT_QUOTES);
 $payState = htmlspecialchars($payState, ENT_QUOTES);

 $_SESSION['payName'] = $payName;
 $_SESSION['payCategory'] = $payCategory;
 $_SESSION['payDateFrom'] = $payDateFrom;
 $_SESSION['payDateTo'] = $payDateTo;
 $_SESSION['payState'] = $payState;

} else {
 $payName = $_SESSION['payName'];
 $payCategory = $_SESSION['payCategory'];
 $payDateFrom = $_SESSION['payDateFrom'];
 $payDateTo = $_SESSION['payDateTo'];
 $payState = $_SESSION['payState'];

}

include '../model/tools/databaseConnect.php';

// 5つすべて入力されている場合
// 5から5を選択する組み合わせ
// x = 5! / 5! * (5 - 5)!
// x = 5 * 4 * 3 * 2 * 1 / 5 * 4 * 3 * 2 * 1 * 1
// x = 120 /120
// x = 1
if($payName !== ""  && $payCategory !== "" && $payState !=="" && $payDateFrom !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' AND payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";

// 4つ入力されている場合
// 5から4を選択する組み合わせ
// x = 5! / 4! * (5 - 4)!
// x = 5 * 4 * 3 * 2 * 1 / 4 * 3 * 2 * 1 * 1
// x = 120 / 24
// x = 5
} elseif($payName !== ""  && $payCategory !== "" && $payDateFrom !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";
} elseif($payName !== ""  && $payState !== "" && $payDateFrom !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";
} elseif($payCategory !== "" && $payState !== "" && $payDateFrom !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";
} elseif($payName !== ""  && $payCategory !== "" && $payState !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateTo'";
} elseif($payName !== ""  && $payCategory !== "" && $payDateFrom !== "" && $payState !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payState LIKE '%{$payState}%' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payState LIKE '%{$payState}%'";

// 3つ入力されている場合
// 5から3を選択する組み合わせ
// x = 5! / 3! * (5 - 3)!
// x = 5 * 4 * 3 * 2 * 1 / 3 * 2 * 1 * 2 * 1
// x = 120 / 12
// x = 10
} elseif($payName !== "" && $payCategory !== "" && $payState !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%'";
} elseif($payName !== "" && $payCategory !== "" && $payDateFrom !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateFrom' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateFrom'";
} elseif($payName !== "" && $payState !== "" && $payDateFrom !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateFrom' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateFrom'";
} elseif($payCategory !== "" && $payState !== "" && $payDateFrom !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateFrom' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateFrom'";
} elseif($payName !== "" && $payCategory !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateTo'";
} elseif($payName !== "" && $payState !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateTo'";
} elseif($payCategory !== "" && $payState !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateTo'";
} elseif($payName !== "" && $payDateFrom !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";
} elseif($payCategory !== "" && $payDateFrom !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";
} elseif($payState !== "" && $payDateFrom !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payState LIKE '%{$payState}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payState LIKE '%{$payState}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";

// 2つ入力されている場合
// 5から2を選択する組み合わせ
// x = 5! / 2! * (5 - 2)!
// x = 5 * 4 * 3 * 2 * 1 / 2 * 1 * 3 * 2 * 1
// x = 120 / 12
// x = 10
} elseif($payName !== "" && $payCategory !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%'";
} elseif($payName !== "" && $payDateFrom !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom'";
} elseif($payName !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate <= '$payDateTo'";
} elseif($payCategory !== "" && $payDateFrom !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateFrom' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateFrom'";
} elseif($payCategory !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateTo'";
} elseif($payDateFrom !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payDate >= '$payDateFrom' AND payDate <= '$payDateTo'";
} elseif($payName !== "" && $payState !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%'";
} elseif($payCategory !== "" && $payState !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%'";
} elseif($payState !== "" && $payDateFrom !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payState LIKE '%{$payState}%' AND payDate <= '$payDateFrom' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payState LIKE '%{$payState}%' AND payDate <= '$payDateFrom'";
} elseif($payState !== "" && $payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payState LIKE '%{$payState}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payState LIKE '%{$payState}%' AND payDate <= '$payDateTo'";

// 1つ入力されている場合
// 5から1を選択する組み合わせ
// x = 5! / 1! * (5 - 1)!
// x = 5 * 4 * 3 * 2 * 1 / 1 * 4 * 3 * 2 * 1
// x = 120 / 24
// x = 5
} elseif($payName !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payName LIKE '%{$payName}%'";
} elseif($payCategory !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%'";
} elseif($payState !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payState LIKE '%{$payState}%' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payState LIKE '%{$payState}%'";
} elseif($payDateFrom !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payDate >= '$payDateFrom' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payDate >= '$payDateFrom'";
} elseif($payDateTo !== ""){
 $query_referencePay = "SELECT * FROM paymentTable WHERE payDate <= '$payDateTo' ORDER BY payDate ASC";
 $query_sumPay = "SELECT SUM(payment) FROM paymentTable WHERE payDate <= '$payDateTo'";
} else {
 
}

$result_referencePay = mysqli_query($link, $query_referencePay);
$result_sumPay = mysqli_query($link, $query_sumPay);
$i = 1;
while ($row = mysqli_fetch_array($result_referencePay)) {
	$payment[$i] = $row;
	$i++;
}

if($i >= 102){
 $errorReferencePayCount = true;

 $_SESSION['payName'] = "";
 $_SESSION['payCategory'] = "";
 $_SESSION['payDateFrom'] = "";
 $_SESSION['payDateTo'] = "";
 $_SESSION['payState'] = "";

 include '../view/referencePayForm.php';

} elseif ($i == 1) {
 $errorReferencePayNone = true;

 $_SESSION['payName'] = "";
 $_SESSION['payCategory'] = "";
 $_SESSION['payDateFrom'] = "";
 $_SESSION['payDateTo'] = "";
 $_SESSION['payState'] = "";

 include '../view/referencePayForm.php';

} else {
 $sumPayment[0] = mysqli_fetch_array($result_sumPay);

 include '../view/referencePayResult.php';

}

mysqli_close($link);
?>