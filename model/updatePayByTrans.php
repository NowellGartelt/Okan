<!-- model/updatePayByTrans.php -->
<?php
class updatePayByTrans {
    private $loginID = null;
    private $query_updatePayInfo = null;
    private $payName = null;
    private $payment = null;
    private $payCategory = null;
    private $payDate = null;
    private $payState = null;
    private $id = null;
  
    public function updatePayByTrans($loginID, $payName, $payment, $payCategory, 
            $payDate, $payState, $id){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->payName = $payName;
        $this->payment = $payment;
        $this->payCategory = $payCategory;
        $this->payDate = $payDate;
        $this->payState = $payState;
        $this->id = $id;

        $query_updatePayInfo =
            "UPDATE paymentTable 
            SET payName = '$payName', payment = '$payment', payCategory = '$payCategory',
            payDate = '$payDate', payState = '$payState' WHERE paymentID = '$id' AND loginID = '$loginID'";
        $result_updatePayInfo = mysqli_query($link, $query_updatePayInfo);
        $paymentInfo = mysqli_fetch_array($result_updatePayInfo);
        
        mysqli_close($link);
        
        return $paymentInfo;
    }
}
?>