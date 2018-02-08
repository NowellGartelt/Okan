<?php
/**
 * 収入情報更新結果画面表示クラス
 * 
 * 収入情報更新時、入力された情報の妥当性チェック、および情報更新結果の画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name updateIncResult
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

$incName = $_POST['incName'];
$income = $_POST['income'];
$incCategory = $_POST['incCategory'];
$incDate = $_POST['incDate'];
$incState = $_POST['incState'];
$id = $_POST['ID'];

// エラー値の初期化
$_SESSION["errorInputInc"] = "";
$errorInputInc = "";

// 入力値チェック
if($incName == "" || $income == "" || $incCategory == "" || $incDate == "" 
        || $income == "" || $income < 0){
    if ($income < 0) {
        // 入力値不正でエラー、入力画面に戻す
        $_SESSION["errorInputInc"] = "minusInput";
    } else {
        // 入力項目不足でエラー、入力画面に戻す
        $_SESSION["errorInputInc"] = "lackInput";
    }
    $errorInputInc = $_SESSION["errorInputInc"];
    
    // 収入情報の取得
    require_once '../model/searchIncByID.php';
    $searchIncByID = new searchIncByID();
    $incList = $searchIncByID -> searchIncByID($loginID, $id);
    
    // 収入カテゴリ一覧の取得
    require_once '../model/searchIncCategory.php';
    $searchIncCategory = new searchIncCategory();
    $cateList = $searchIncCategory -> searchIncCategoryName($loginID);
    
    // 収入カテゴリ数取得
    $cateCount = $searchIncCategory -> searchIncCategoryCount($loginID);
    $count = $cateCount[0]["COUNT(*)"];
    
    for ($i = 0; $i < $count; $i++) {
        // カテゴリ登録がなかった場合、空行を取り除く
        if ($cateList[$i]['categoryName'] == false || $cateList[$i]['categoryName'] == "") {
            unset($cateList[$i]);
        }
    }
    
    include '../view/updateIncForm.php';
    
} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $incName = htmlspecialchars($incName, ENT_QUOTES);
    $income = htmlspecialchars($income, ENT_QUOTES);
    $incCategory = htmlspecialchars($incCategory, ENT_QUOTES);
    $incState = htmlspecialchars($incState, ENT_QUOTES);
    
    // 収入情報の更新
    require_once '../model/updateIncByTrans.php';
    $updateIncByTrans = new updateIncByTrans();
    $updResult = $updateIncByTrans -> updateIncByTrans($loginID, 
            $incName, $income, $incCategory, $incDate, $incState, $id);
    
    include '../view/updateIncResult.php';
}
