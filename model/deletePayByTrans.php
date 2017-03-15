<!-- model/deletePayByTrans.php -->
<?php
class deletePayByTrans {
    private $loginID = null;
    private $query_registPayInfo = null;
    private $id = null;
  
    public function deletePayByTrans($loginID, $id){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;
        $this->id = $id;

        $query_deletePayInfo = "DELETE FROM paymentTable WHERE incomeID = '$id' AND loginID = '$loginID'";
        $result_deletePayInfo = mysqli_query($link, $query_deletePayInfo);
        $paymentInfo = mysqli_fetch_array($result_deletePayInfo);
        
        mysqli_close($link);
        
        return $paymentInfo;
    }
}
?>