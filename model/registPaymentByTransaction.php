<!-- model/registPaymentByTransaction.php -->
<?php
class registPaymentByTransaction {
    private $query_registPayInfo = null;
    private $payName = null;
    private $payment = null;
    private $payCategory = null;
    private $payState = null;
    private $payDate = null;
    private $registDate = null;
  
    public function registPaymentByTransaction($payName, $payment, $payCategory, $payState, $payDate, $registDate){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
      
        $this->payName = $payName;
        $this->payment = $payment;
        $this->payCategory = $payCategory;
        $this->payDate = $payDate;
        $this->payState = $payState;
        $this->id = $id;

        $query_registPay =
            "INSERT INTO paymentTable (
            payName, payment, payCategory, payState, payDate, registDate, updateDate)
            VALUES (
            '$payName', '$payment', '$payCategory', '$payState', '$payDate', '$registDate', null)";
        $result_registPayInfo = mysqli_query($link, $query_registPay);
        $paymentInfo = mysqli_fetch_array($result_registPayInfo);
        
        mysqli_close($link);
        
        return $paymentInfo;
    }
}
?>