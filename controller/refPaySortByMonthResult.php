<?php
/**
 * まとめて支払い検索(月ごと)検索結果画面表示クラス
 * 
 * まとめて支払い検索(月ごと)の検索条件として入力された値の妥当性チェック、検索結果の表示画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name refPaySortByMonthResult
 */
if (!isset($_SESSION)) {
    session_start();
    
}

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// インスタンス変数の定義
$result = null;
$searchPayByMonth = null;
$payment = null;
$payCount = null;

// エラー変数のリセット
$errFlg = false;
$errInput = "";
$errResult = "";

// 移動元ページの設定
$fromPage = "refPaySortByDayResult";
$controller -> setFromPage($fromPage);

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

// 項目不足だった場合、入力項目不足エラー
if (($choiceKey == "payName" && $payName == "") 
        || ($choiceKey == "payCategory" && $payCategory == "")) {
    $errFlg = true;
    $errInput = "luckNecessaryInfo";
    
} else {
    // 月ごとの支出情報の取得
    require_once '../model/searchPayByMonth.php';
    $searchPayByMonth = new searchPayByMonth();
    $payList = $searchPayByMonth -> searchPayByMonth(
            $userID, $payName, $payCategory, 
            $payDateFrom, $payDateTo, $choiceKey, $methodOfPayment);
    $DBConnect = $controller -> getDBConnectResult();
    
    $payCount = count($payList);
    
    // DB接続に失敗した場合
    if ($DBConnect == false) {
        $errFlg = true;
        $errResult = "failedDBConnect";
        
    } else {
        // 結果が100行以上だった場合、検索結果過多でエラー
        if ($payCount >= 101) {
            $errFlg = true;
            $errInput = "errReferencePayCount";
            
        }
    }
}

// エラーがあった場合
if ($errFlg == true) {
    // 取得時にエラーがあった場合、エラー画面を表示する
    if ($errResult == "failedDBConnect") {
        include '../view/errReferenceResult.php';
    
    // エラーがあった場合、入力画面に戻す
    } elseif ($errInput !== "") {
        require_once 'refPaySortByMonthForm.php';
        
    }
// エラーとならなかった場合は結果を表示する
} else {
    $sumPayment = null;
    foreach ($payList as $SumPay) {
        $sumPayment += $SumPay['SUM(payment)'];
    }
    // 画面の表示
    include '../view/refPaySortByMonthResult.php';
    
}
