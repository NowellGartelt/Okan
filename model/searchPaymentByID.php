<!-- model/searchPaymentByID.php -->
<?php
class searchPaymentByID {
    // 変数初期化
    private $loginID = null;
    private $query_getPayInfo = null;
    private $id = null;
  
    public function searchPaymentByID($loginID, $id){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->id = $id;

        // IDで対象のデータを引き当て
        $query_getPayInfo = "SELECT * FROM paymentTable WHERE paymentID = '$id' AND loginID = '$loginID'";
        $result_getPayInfo = mysqli_query($link, $query_getPayInfo);
        $paymentInfo = mysqli_fetch_array($result_getPayInfo);

        mysqli_close($link);
        
        return $paymentInfo;
    }
}
?>