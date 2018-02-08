<?php
/**
 * 収入情報更新結果画面表示クラス
 * 
 * 収入情報更新時、入力された情報の妥当性チェック、および情報更新結果の画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name updateIncResult
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

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
    include '../model/searchIncByID.php';
    $searchIncByID= new searchIncByID();
    $incInfo = $searchIncByID-> searchIncByID($loginID, $id);
    
    // 収入カテゴリ一覧の取得
    include '../model/searchIncCategory.php';
    $searchIncCategory = new searchIncCategory();
    $getCategory = $searchIncCategory -> searchIncCategoryName($loginID);
    
    // 収入カテゴリ数取得
    $getCount = $searchIncCategory -> searchIncCategoryCount($loginID);
    $count = $getCount[0]["COUNT(*)"];
    
    for ($i = 0; $i < $count; $i++) {
        // カテゴリ登録がなかった場合、空行を取り除く
        if ($getCategory[$i]['categoryName'] == false || $getCategory[$i]['categoryName'] == "") {
            unset($getCategory[$i]);
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
    include '../model/updateIncByTrans.php';
    $updateIncByTrans= new updateIncByTrans();
    $incInfo = $updateIncByTrans-> updateIncByTrans($loginID, 
            $incName, $income, $incCategory, $incDate, $incState, $id);
    
    include '../view/updateIncResult.php';
}
