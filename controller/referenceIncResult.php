<?php
/**
 * 収入情報検索結果画面表示クラス
 * 
 * 収入情報を検索する条件として入力された値の妥当性チェック、検索結果を表示する画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name referenceIncResult
 */

session_start();

// コントローラの共通処理取得
require 'controller.php';
$controller = new controller();

// ログインID取得
$loginID = $controller -> getLoginID();

$page = $_POST['page'];

// 変数初期化
$incName = null;
$incCategory = null;
$incDateFrom = null;
$incDateTo = null;
$incState = null;

// 参照の検索初期画面からの遷移の場合、ポストされた値を取得する
if ($page == "reference") {
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

include '../model/searchIncByTrans.php';

$result = new searchIncByTrans();
$searchIncByTrans = $result -> searchIncByTrans($loginID, $incName, 
        $incCategory, $incState, $incDateFrom, $incDateTo);

$income = $searchIncByTrans;
$incCount = count($searchIncByTrans);

// 結果が100行以上だった場合、検索結果過多でエラーとする
if($incCount >= 101){
    $errorReferenceIncCount = true;

    $_SESSION['incName'] = null;
    $_SESSION['incCategory'] = null;
    $_SESSION['incDateFrom'] = null;
    $_SESSION['incDateTo'] = null;
    $_SESSION['incState'] = null;

    include '../view/referenceIncForm.php';

// 結果が0行だった場合、検索結果なしでエラーとする
} elseif ($incCount == 0) {
    $errorReferenceIncNone = true;

    $_SESSION['incName'] = null;
    $_SESSION['incCategory'] = null;
    $_SESSION['incDateFrom'] = null;
    $_SESSION['incDateTo'] = null;
    $_SESSION['incState'] = null;

    include '../view/referenceIncForm.php';

// エラーとならなかった場合は結果を表示する
} else {
    $sumIncome = null;
    foreach ($income as $SumInc) {
        $sumIncome += $SumInc['income'];
    }

    include '../view/referenceIncResult.php';
}
?>