<?php
/**
 * 収入情報検索結果画面表示クラス
 * 
 * 収入情報を検索する条件として入力された値の妥当性チェック、検索結果を表示する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name referenceIncResult
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();
$fromPage = $controller -> getFromPage();

// 変数初期化
$incName = null;
$incCategory = null;
$incDateFrom = null;
$incDateTo = null;
$incState = null;

// エラー変数初期化
$errFlg = false;
$errResult = "";

// 参照の検索初期画面からの遷移の場合、ポストされた値を取得する
if ($fromPage == "referenceIncForm") {
     // ポストされた値の取得
    $incName = $_POST['incName'];
    $incCategory = $_POST['incCategory'];
    $incDateFrom = $_POST['incDateFrom'];
    $incDateTo = $_POST['incDateTo'];
    $incState = $_POST['incState'];

    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $incName = htmlspecialchars($incName, ENT_QUOTES);
    $incCategory = htmlspecialchars($incCategory, ENT_QUOTES);
    $incState = htmlspecialchars($incState, ENT_QUOTES);

    // 「なし」が選ばれた場合、検索条件から外すため空の値を入れる
    if ($payCategory == 0) {
        $payCategory = "";
    }
    
    // セッション関数へのセット
    $_SESSION['incName'] = $incName;
    $_SESSION['incCategory'] = $incCategory;
    $_SESSION['incDateFrom'] = $incDateFrom;
    $_SESSION['incDateTo'] = $incDateTo;
    $_SESSION['incState'] = $incState;

// 参照の検索初期画面以外からの遷移の場合、セッション関数から値を取得する
} else {
    // セッション関数からの値の読み込み
    $incName = $_SESSION['incName'];
    $incCategory = $_SESSION['incCategory'];
    $incDateFrom = $_SESSION['incDateFrom'];
    $incDateTo = $_SESSION['incDateTo'];
    $incState = $_SESSION['incState'];

}

// 移動元ページの設定
$fromPage = "referenceIncResult";
$controller -> setFromPage($fromPage);

// 収入情報の取得
require_once '../model/searchIncByTrans.php';
$searchIncByTrans = new searchIncByTrans();
$incList = $searchIncByTrans -> searchIncByTrans($userID, $incName, 
        $incCategory, $incState, $incDateFrom, $incDateTo);
$DBConnect = $controller -> getDBConnectResult();

// DB接続に失敗した場合
if ($DBConnect == false) {
    $errFlg = true;
    $errResult = "failedDBConnect";
    
} else {
    $incCount = count($incList);

    // 結果が100行以上だった場合、検索結果過多でエラーとする
    if($incCount >= 101){
        $errFlg = true;
        $errResult = "OverCapacity";
        
    // 結果が0行だった場合、検索結果なしでエラーとする
    } elseif ($incCount == 0) {
        $errFlg = true;
        $errResult = "noneResult";
        
    }
}

// 取得時にエラーがあった場合、エラー画面を表示する
if ($errFlg == true && $errResult == "failedDBConnect") {
    include '../view/errReferenceResult.php';
    
// 所得後のエラーがあった場合、入力画面へ戻す
} elseif ($errFlg == true && ($errResult == "OverCapacity" || $errResult == "noneResult")) {
    require_once 'referenceIncForm.php';
    
// エラーとならなかった場合は結果を表示する
} else {
    $sumIncome = null;
    foreach ($incList as $SumInc) {
        $sumIncome += $SumInc['income'];
    }

    include '../view/referenceIncResult.php';
    
}
