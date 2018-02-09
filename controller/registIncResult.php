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

$incName = $_POST['incName'];
$income = $_POST['income'];
$incCategory = $_POST['incCategory'];
$incState = $_POST['incState'];
$incDate = $_POST['incDate'];

// エラー値の初期化
$_SESSION["errorInputInc"] = "";
$errorInputInc = "";

// 入力値チェック
if($incName == "" || $income == "" || $incCategory == "" || $incDate == "" || $income < 0){
    if ($income < 0) {
        // 入力値不正でエラー、入力画面に戻す
        $_SESSION["errorInputInc"] = "minusInput";
    } else {
        // 入力項目不足でエラー、入力画面に戻す
        $_SESSION["errorInputInc"] = "lackInput";
    }
    $errorInputInc = $_SESSION["errorInputInc"];
 
    // 支出カテゴリ一覧の取得
    require_once '../model/searchPayCategoryName.php';
    $searchPayCategoryName = new searchPayCategoryName();
    $cateList = $searchPayCategoryName -> searchPayCategoryName($loginID);
    
    // 支出カテゴリ数取得
    require_once '../model/searchPayCategoryCount.php';
    $searchPayCategoryCount = new searchPayCategoryCount();
    $cateCount = $searchPayCategoryCount -> searchPayCategoryCount($loginID);
    $count = $cateCount[0]["COUNT(*)"];
    
    for ($i = 0; $i < $count; $i++) {
        // カテゴリ登録がなかった場合、空行を取り除く
        if ($cateList[$i]['categoryName'] == false || $cateList[$i]['categoryName'] == "") {
            unset($cateList[$i]);
        }
    }
    
    include '../view/registIncForm.php';

} else {
    $_SESSION["errorInputInc"] = false;
    $errorInputInc = $_SESSION["errorInputInc"];

    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $incName = htmlspecialchars($incName, ENT_QUOTES);
    $income = htmlspecialchars($income, ENT_QUOTES);
    $incState = htmlspecialchars($incState, ENT_QUOTES);
    $incCategory = htmlspecialchars($incCategory, ENT_QUOTES);
 
    $registDate = date("Y-m-d H:i:s");
    
    // 収入情報の登録
    require_once '../model/registIncByTrans.php';
    $registIncByTrans = new registIncByTrans();
    $regResult = $registIncByTrans -> registIncByTrans($loginID, $incName, 
            $income, $incCategory, $incState, $incDate, $registDate);
    
$query_kogotoList = <<<__SQL
    SELECT * FROM `kogoto`
    WHERE $income <= `kogoto`.`lower_income`
    ORDER BY `lower_income` ASC
__SQL;
    $kogoto = mysqli_fetch_assoc(mysqli_query($link, $query_kogotoList));

    include '../view/registIncResult.php';

}
$_SESSION["errorInputInc"] = "";
