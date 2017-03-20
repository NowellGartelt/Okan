<!-- controller/registIncResult.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

include '../model/tools/databaseConnect.php';

$loginID = $_SESSION['loginID'];

$incName = $_POST['incName'];
$income = $_POST['income'];
$incCategory = $_POST['incCategory'];
$incState = $_POST['incState'];
$incDate = $_POST['incDate'];

if($incName == "" || $income == "" || $incCategory == "" || $incDate == ""){
    // 入力項目不足でエラー、入力画面に戻す
    $_SESSION["errorInputInc"] = true;
    $errorInputInc = $_SESSION["errorInputInc"];
 
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
    
    include '../model/registIncByTrans.php';
    
    $result = new registIncByTrans();
    $registIncByTrans = $result -> registIncByTrans($loginID, $incName, 
            $income, $incCategory, $incState, $incDate, $registDate);
    $incInfo = $registIncByTrans;
    
$query_kogotoList = <<<__SQL
    SELECT * FROM `kogoto`
    WHERE $income <= `kogoto`.`lower_income`
    ORDER BY `lower_income` ASC
__SQL;
    $kogoto = mysqli_fetch_assoc(mysqli_query($link, $query_kogotoList));

    include '../view/registIncResult.php';

}
$_SESSION["errorInputInc"] = "";

mysqli_close($link);
?>