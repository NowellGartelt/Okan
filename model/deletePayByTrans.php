<!-- model/deletePayByTrans.php -->
<?php
class deletePayByTrans {
    private $loginID = null;
    private $query_registPayInfo = null;
    private $id = null;
  
    // コンストラクタ、何もしない
    public function __construct() {
        
    }
    
    public function deletePayByTrans($loginID, $id){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;
        $this->id = $id;

        // 支出情報の削除
        $query_deletePayInfo = "DELETE FROM paymentTable WHERE paymentID = '$id' AND loginID = '$loginID'";
        $result_deletePayInfo = mysqli_query($link, $query_deletePayInfo);
        $paymentInfo = mysqli_fetch_array($result_deletePayInfo);
        
        mysqli_close($link);
        
        return $paymentInfo;
    }
}
?>