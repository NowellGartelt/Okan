<!-- controller/updatePayResult.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$payName = $_POST['payName'];
$payment = $_POST['payment'];
$payCategory = $_POST['payCategory'];
$payDate = $_POST['payDate'];
$payState = $_POST['payState'];
$id = $_POST['ID'];

if($payName == "" || $payment == "" || $payCategory == "" || $payDate == ""){
    // 入力項目不足でエラー、入力画面に戻す
    $_SESSION["errorInputPay"] = true;
    $errorInputPay = $_SESSION["errorInputPay"];

    include '../model/searchPaymentByID.php';
    
    $result = new searchPayByID();
    $searchPayByID = $result -> searchPayByID($id);
    $payInfo = $searchPayByID;
    
    include '../view/updatePayForm.php';
} else {
    $payName = htmlspecialchars($payName, ENT_QUOTES);
    $payment = htmlspecialchars($payment, ENT_QUOTES);
    $payCategory = htmlspecialchars($payCategory, ENT_QUOTES);
    $payState = htmlspecialchars($payState, ENT_QUOTES);

    include '../model/updatePayByTrans.php';
    
    $result = new updatePayByTrans();
    $updatePayByTrans = 
        $result -> updatePayByTrans($loginID, $payName, $payment, 
                $payCategory, $payDate, $payState, $id);
    $payInfo = $updatePayByTrans;
    
    include '../view/updatePayResult.php';
}
?>