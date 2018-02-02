<?php
/**
 * 支払い情報登録処理クラス
 * 
 * 入力された支払い情報を元に、情報の妥当性と登録処理の実施する
 * その結果を元に画面の呼び出しを行う
 * 
 * @access public
 * @package controller
 * @name registPayResult
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

include '../model/tools/databaseConnect.php';

$loginID = $_SESSION['loginID'];

$payName = $_POST['payName'];
$payment = $_POST['payment'];
$payCategory = $_POST['payCategory'];
$payState = $_POST['payState'];
$payDate = $_POST['payDate'];
$taxFlg = $_POST['taxFlg'];
$tax = $_POST['tax'];
$methodOfPayment = $_POST['methodOfPayment'];

// エラー値の初期化
$_SESSION["errorInputPay"] = "";
$errorInputPay = "";

// 入力値チェック
if($payName == "" || $payment == "" || $payCategory == "" || $payDate == "" || $payment < 0){
    if ($payment < 0) {
        // 入力値不正でエラー、入力画面に戻す
        $_SESSION["errorInputPay"] = "minusInput";
    } else {
        // 入力項目不足でエラー、入力画面に戻す
        $_SESSION["errorInputPay"] = "lackInput";
    }
    $errorInputPay = $_SESSION["errorInputPay"];
 
    include '../view/registPayForm.php';
    
} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $payName = htmlspecialchars($payName, ENT_QUOTES);
    $payment = htmlspecialchars($payment, ENT_QUOTES);
    $payState = htmlspecialchars($payState, ENT_QUOTES);
    $payCategory = htmlspecialchars($payCategory, ENT_QUOTES);
    $taxFlg = htmlspecialchars($taxFlg, ENT_QUOTES);
    $tax = htmlspecialchars($tax, ENT_QUOTES);
 
    $registDate = date("Y-m-d H:i:s");
    
    // 税率が入力されてるとき、自動で税率計算を行う
    // 消費税分を掛け算、小数点以下を切り捨てる
    if ($taxFlg == 1) {
        include 'tools/taxCalc.php';
        $taxCalc = new taxCalc();
        $payment = $taxCalc -> taxCalc($payment, $tax);
        
    } else {
        $taxFlg = 0;
        $tax = 0;
        
    }
    
    include '../model/registPayByTrans.php';
    
    $result = new registPayByTrans();
    $registPayByTrans = $result -> registPayByTrans($loginID, $payName, 
            $payment, $payCategory, $payState, $payDate, $registDate, 
            $taxFlg, $tax, $methodOfPayment);
    $payInfo = $registPayByTrans;
    
$query_kogotoList = <<<__SQL
    SELECT * FROM `kogoto`
    WHERE $payment <= `kogoto`.`lower_payment`
    ORDER BY `lower_payment` ASC
__SQL;
    $kogoto = mysqli_fetch_assoc(mysqli_query($link, $query_kogotoList));

    include '../view/registPayResult.php';

}
$_SESSION["errorInputPay"] = "";

mysqli_close($link);
?>