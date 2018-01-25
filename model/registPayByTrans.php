<!-- model/registPayByTrans.php -->
<?php
class registPayByTrans {
    private $loginID = null;
    private $query_registPayInfo = null;
    private $payName = null;
    private $payment = null;
    private $payCategory = null;
    private $payState = null;
    private $payDate = null;
    private $registDate = null;
    private $taxFlg = null;
    private $tax = null;
  
    public function registPayByTrans($loginID, $payName, $payment, $payCategory, 
            $payState, $payDate, $registDate, $taxFlg, $tax){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->payName = $payName;
        $this->payment = $payment;
        $this->payCategory = $payCategory;
        $this->payDate = $payDate;
        $this->payState = $payState;
        $this->id = $id;
        $this->taxFlg = $taxFlg;
        $this->tax = $tax;

        if ($loginID == "" || $payName == "" || $payment == "" || 
                $payCategory == "" || $payDate == "" || $registDate == "") {
            $paymentInfo = null;
            
        } else {
            // 支出情報の登録
            $query_registPay =
                "INSERT INTO paymentTable (
                payName, payment, payCategory, payState, payDate, registDate, updateDate, loginID, taxFlg, tax)
                VALUES (
                '$payName', '$payment', '$payCategory', '$payState', '$payDate', '$registDate', null, '$loginID', $taxFlg, $tax)";
            $result_registPayInfo = mysqli_query($link, $query_registPay);
            $paymentInfo = mysqli_fetch_array($result_registPayInfo);
            
        }
        
        mysqli_close($link);
        
        return $paymentInfo;
    }
}
?>