<?php
/**
 * おこづかいレポート検索結果画面表示クラス
 * 
 * おこづかいレポート検索時、入力された値の妥当性チェック、検索結果を表示する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name refPayAndIncReportResult
 */

session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

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
    require_once '../model/searchPaySum.php';
    $resultPay = new searchPaySum();
    $sumPay = $resultPay -> searchPaySum($loginID, $dateFrom, $dateTo);
    
    if ($sumPay[0]['SUM(payment)'] == null) {
        $sumPay[0]['SUM(payment)'] = 0;
    }
    
    // 指定された期間の総支出額(現金のみ)の取得
    require_once '../model/searchPaySumOnlyCash.php';
    $resultPayOnlyCash = new searchPaySumOnlyCash($loginID, $dateFrom, $dateTo);
    $sumPayOnlyCash = $resultPayOnlyCash -> searchPaySumOnlyCash($loginID, $dateFrom, $dateTo);
    
    if ($sumPayOnlyCash[0]['SUM(payment)'] == null) {
        $sumPayOnlyCash[0]['SUM(payment)'] = 0;
    }
    
    // 指定された期間の総収入額の取得
    require_once '../model/searchIncSum.php';
    $searchIncSum= new searchIncSum();
    $sumInc = $searchIncSum -> searchIncSum($loginID, $dateFrom, $dateTo);
    
    if ($sumInc[0]['SUM(income)'] == null) {
        $sumInc[0]['SUM(income)'] = 0;
    }
    
    // 指定された期間のカテゴリごとの支出額の取得、支出の多い順に並べる
    require_once '../model/searchSumPayByCategory.php';
    $searchSumPayByCategory = new searchSumPayByCategory();
    $sumPayCategory = $searchSumPayByCategory -> searchSumPayByCategory($loginID, $dateFrom, $dateTo);
    
    // 指定された期間の支払方法ごとの支出額の取得、支出の多い順に並べる
    require_once '../model/searchSumPayByPayment.php';
    $searchSumPayByPayment = new searchSumPayByPayment();
    $sumPayPayment = $searchSumPayByPayment -> searchSumPayByPayment($loginID, $dateFrom, $dateTo);
    
    // 総収入額 - 総支出額の計算
    $difPayAndInc = $sumInc[0]['SUM(income)'] - $sumPayOnlyCash[0]['SUM(payment)'];
    
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
