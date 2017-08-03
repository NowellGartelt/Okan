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

if($incName == "" || $income == "" || $incCategory == "" || $incDate == ""){
    // 入力項目不足でエラー、入力画面に戻す
    $_SESSION["errorInputInc"] = true;
    $errorInputInc = $_SESSION["errorInputInc"];

    include '../model/searchIncByID.php';
    
    $result = new searchIncByID();
    $searchIncByID = $result -> searchIncByID($id);
    $incInfo = $searchIncByID;
    
    include '../view/updateIncForm.php';
} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $incName = htmlspecialchars($incName, ENT_QUOTES);
    $income = htmlspecialchars($income, ENT_QUOTES);
    $incCategory = htmlspecialchars($incCategory, ENT_QUOTES);
    $incState = htmlspecialchars($incState, ENT_QUOTES);

    include '../model/updateIncByTrans.php';
    
    $result = new updateIncByTrans();
    $updateIncByTrans = $result -> updateIncByTrans($loginID, 
            $incName, $income, $incCategory, $incDate, $incState, $id);
    $incInfo = $updateIncByTrans;
    
    include '../view/updateIncResult.php';
}
?>