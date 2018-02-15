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
$errInput = "";

// 移動元ページの設定
$fromPage = "updateIncResult";
$controller -> setFromPage($fromPage);

// 入力値チェック
if($income == "" || $incDate == "" || $income < 0){
    if ($income < 0) {
        // 入力値不正でエラー、入力画面に戻す
        $errInput = "minusInput";
    } else {
        // 入力項目不足でエラー、入力画面に戻す
        $errInput = "lackInput";
    }
    
    require_once 'updateIncForm.php';
    
} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $incName = htmlspecialchars($incName, ENT_QUOTES);
    $income = htmlspecialchars($income, ENT_QUOTES);
    $incCategory = htmlspecialchars($incCategory, ENT_QUOTES);
    $incState = htmlspecialchars($incState, ENT_QUOTES);
    
    // 更新日時取得
    $updateDate = date("Y-m-d H:i:s");
    
    // 収入カテゴリID取得
    require_once '../model/searchIncCategoryByID.php';
    $searchIncCategoryByID = new searchIncCategoryByID();
    $cateList = $searchIncCategoryByID -> searchIncCategoryByID($userID, $incCategory);
    $cateID = $cateList['categoryID'];
    
    // 収入情報の更新
    require_once '../model/updateIncByTrans.php';
    $updateIncByTrans = new updateIncByTrans();
    $updResult = $updateIncByTrans -> updateIncByTrans($userID, 
            $incName, $income, $cateID, $incDate, $incState, $id, $updateDate);
    
    include '../view/updateIncResult.php';
}
