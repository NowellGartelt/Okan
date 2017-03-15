<!-- controller/refPayAndIncReportResult.php -->
<?php
session_start();

// ログイン検証
include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

// セッション関数へのセット
$dateFrom = $_POST['dateFrom'];
$dateTo = $_POST['dateTo'];

// 期間開始日、終了日のいずれかが入力されていない場合
if ($dateFrom == "" || $dateTo == "") {
    // 入力項目不足エラー、入力画面へ戻す
    $errorNecessaryInfo = true;
 	
    include '../view/refPayAndIncReportForm.php';

// 期間が367日以上で指定された場合
} elseif ((strtotime($dateTo) - strtotime($dateFrom))/60/60/24 >= 367) {
    // 期間設定エラー、入力画面へ戻す
    $errorOverOneYear = true;
    
    include '../view/refPayAndIncReportForm.php';

} else {
    include '../model/searchPaySum.php';
    
    $resultPay = new searchPaySum($loginID, $dateFrom, $dateTo);
    $sumPay = $resultPay->searchPaySum($loginID, $dateFrom, $dateTo);
    
    include '../model/searchIncSum.php';
    
    $resultInc = new searchIncSum($loginID, $dateFrom, $dateTo);
    $sumInc = $resultInc->searchIncSum($loginID, $dateFrom, $dateTo);
    
    include '../model/searchSumPayByCategory.php';
    
    $resultPayCategory = new searchSumPayByCategory($loginID, $dateFrom, $dateTo);
    $sumPayCategory = $resultPayCategory->searchSumPayByCategory($loginID, $dateFrom, $dateTo);
    
    $difPayAndInc = $sumInc[0]['SUM(income)'] - $sumPay[0]['SUM(payment)'];
    
    if ($difPayAndInc > 0) {
        $difPayAndIncStatus = "surplus";
    } elseif ($difPayAndInc < 0) {
        $difPayAndIncStatus = "deficit";
    } else {
        $difPayAndIncStatus = "zero";
    }
    
    $dateFrom = substr($dateFrom, 0, 4)."年".substr($dateFrom, 5, 2)."月".substr($dateFrom, 8, 2)."日";
    $dateTo = substr($dateTo, 0, 4)."年".substr($dateTo, 5, 2)."月".substr($dateTo, 8, 2)."日";
    
    include '../view/refPayAndIncReportResult.php';
}
?>