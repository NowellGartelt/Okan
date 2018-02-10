<?php
/**
 * まとめて支払い検索(日ごと)検索結果画面表示クラス
 * 
 * まとめて支払い検索(日ごと)の検索条件として入力された値の妥当性チェック、検索結果の表示画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name refPaySortByDayResult
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// インスタンス変数の定義
$result = null;
$searchPayByDay = null;
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
$_SESSION['methodOfPayment'] = $methodOfPayment;

// 項目不足だった場合、入力項目不足エラー
if (($choiceKey == "payName" && $payName == "") 
        || ($choiceKey == "payCategory" && $payCategory == "")) {
    $errInput = "luckNecessaryInfo";
    
// 項目が十分であれば取得実施
} else {
    // 日ごとの支出情報の取得
    require_once '../model/searchPayByDay.php';
    $searchPayByDay = new searchPayByDay();
    $payList = $searchPayByDay -> searchPayByDay(
            $userID, $payName, $payCategory, 
            $payDateFrom, $payDateTo, $choiceKey, $methodOfPayment);
 
    $payCount = count($payList);
    
    // 結果が100行以上だった場合、検索結果過多でエラー
    if ($payCount >= 101) {
        $errInput = "errReferencePayCount";
        
        // 結果が0行だった場合、検索結果なしでエラー
    } elseif ($payCount == 0) {
        $errInput = "errReferencePayNone";
        
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
    require_once '../model/searchMethodOfPayment.php';
    $searchMethodOfPayment = new searchMethodOfPayment();
    $mopList = $searchMethodOfPayment -> getMethodOfPayment();
    
    // 支出カテゴリ一覧の取得
    require_once '../model/searchPayCategory.php';
    $searchPayCategory = new searchPayCategory();
    $cateList = $searchPayCategory -> searchPayCategory($userID);
    
    // 支出カテゴリ数取得
    require_once '../model/searchPayCategoryCount.php';
    $searchPayCategoryCount = new searchPayCategoryCount();
    $cateCount = $searchPayCategoryCount -> searchPayCategoryCount($userID);
    $count = $cateCount[0]["COUNT(*)"];
    
    for ($i = 0; $i < $count; $i++) {
        // カテゴリ登録がなかった場合、空行を取り除く
        if ($cateList[$i]['categoryName'] == false || $cateList[$i]['categoryName'] == "") {
            unset($cateList[$i]);
        }
    }
    
    include '../view/refPaySortByDayForm.php';
        
// エラーとならなかった場合は結果を表示する
} else {
    $sumPayment = null;
    foreach ($payList as $SumPay) {
        $sumPayment += $SumPay['SUM(payment)'];
    }

    include '../view/refPaySortByDayResult.php';
}
