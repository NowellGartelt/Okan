<?php
/**
 * 収入情報登録結果画面表示クラス
 * 
 * 収入情報として入力された値の妥当性チェック、および登録結果を表示する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name registIncResult
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// 各モジュール使用フラグの取得
$moduleIncFlg = $controller -> getIncModuleFlg();
$moduleIncNameFlg = $moduleIncFlg['incNameFlg'];
$moduleIncCateFlg = $moduleIncFlg['incCateFlg'];
$moduleIncMemoFlg = $moduleIncFlg['incMemoFlg'];

$incName = $_POST['incName'];
$income = $_POST['income'];
$incCategory = $_POST['incCategory'];
$incState = $_POST['incState'];
$incDate = $_POST['incDate'];

// エラー値の初期化
$errInput = "";

// 移動元ページの設定
$fromPage = "registIncResult";
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
    
    require_once 'registIncForm.php';
    
} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $incName = htmlspecialchars($incName, ENT_QUOTES);
    $income = htmlspecialchars($income, ENT_QUOTES);
    $incState = htmlspecialchars($incState, ENT_QUOTES);
    $incCategory = htmlspecialchars($incCategory, ENT_QUOTES);
    
    // 登録日時取得
    $registDate = date("Y-m-d H:i:s");
    
    // 支出カテゴリID取得
    require_once '../model/searchIncCategoryByID.php';
    $searchIncCategoryByID = new searchIncCategoryByID();
    $cateList = $searchIncCategoryByID -> searchIncCategoryByID($userID, $incCategory);
    $cateID = $cateList['categoryID'];
    
    // 収入情報の登録
    require_once '../model/registIncByTrans.php';
    $registIncByTrans = new registIncByTrans();
    $regResult = $registIncByTrans -> registIncByTrans($userID, $incName, 
            $income, $cateID, $incState, $incDate, $registDate);
    
    // 支出の小言取得
    require_once '../model/searchIncKogoto.php';
    $searchIncKogoto = new searchIncKotgoto();
    $kogoto = $searchIncKogoto -> searchIncKogoto($income);
    
    include '../view/registIncResult.php';

}
