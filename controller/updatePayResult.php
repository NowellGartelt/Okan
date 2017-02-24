<!-- controller/updatePayResult.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

include '../model/tools/databaseConnect.php';

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
    
    $result = new searchPaymentByID();
    $searchPaymentByID = $result -> searchPaymentByID($id);
    $paymentInfo = $searchPaymentByID;
    
    include '../view/updatePayForm.php';
} else {
    $payName = htmlspecialchars($payName, ENT_QUOTES);
    $payment = htmlspecialchars($payment, ENT_QUOTES);
    $payCategory = htmlspecialchars($payCategory, ENT_QUOTES);
    $payState = htmlspecialchars($payState, ENT_QUOTES);

    include '../model/updatePaymentByTransaction.php';
    
    $result = new updatePaymentByTransaction();
    $updatePaymentByTransaction = 
        $result -> updatePaymentByTransaction($payName, $payment, 
                                              $payCategory, $payDate, $payState, $id);
    $paymentInfo = $updatePaymentByTransaction;
    
    include '../view/updatePayResult.php';
}
?>