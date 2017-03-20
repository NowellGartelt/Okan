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

// 指定された期間が367日以上の場合
} elseif ((strtotime($dateTo) - strtotime($dateFrom))/60/60/24 >= 367) {
    // 期間設定エラー、入力画面へ戻す
    $errorOverOneYear = true;
    
    include '../view/refPayAndIncReportForm.php';

// 指定された期間が問題なかった場合
} else {
    // 指定された期間の総支出額の取得
    include '../model/searchPaySum.php';
    
    $resultPay = new searchPaySum($loginID, $dateFrom, $dateTo);
    $sumPay = $resultPay->searchPaySum($loginID, $dateFrom, $dateTo);
    
    // 指定された期間の総収入額の取得
    include '../model/searchIncSum.php';
    
    $resultInc = new searchIncSum($loginID, $dateFrom, $dateTo);
    $sumInc = $resultInc->searchIncSum($loginID, $dateFrom, $dateTo);
    
    // 指定された期間のカテゴリごとの支出額の取得、支出の多い順に並べる
    include '../model/searchSumPayByCategory.php';
    
    $resultPayCategory = new searchSumPayByCategory($loginID, $dateFrom, $dateTo);
    $sumPayCategory = $resultPayCategory->searchSumPayByCategory($loginID, $dateFrom, $dateTo);
    
    // 総収入額 - 総支出額の計算
    $difPayAndInc = $sumInc[0]['SUM(income)'] - $sumPay[0]['SUM(payment)'];
    
    // 計算結果、黒字の場合
    if ($difPayAndInc > 0) {
        $difPayAndIncStatus = "surplus";
    // 計算結果、赤字の場合
    } elseif ($difPayAndInc < 0) {
        $difPayAndIncStatus = "deficit";
    // 計算結果、プラスマイナスゼロの場合
    } else {
        $difPayAndIncStatus = "zero";
    }
    
    // 指定期間の開始日
    $dateFrom = substr($dateFrom, 0, 4)."年".substr($dateFrom, 5, 2)."月".substr($dateFrom, 8, 2)."日";
    // 指定期間の終了日
    $dateTo = substr($dateTo, 0, 4)."年".substr($dateTo, 5, 2)."月".substr($dateTo, 8, 2)."日";
    
    include '../view/refPayAndIncReportResult.php';
}
?>