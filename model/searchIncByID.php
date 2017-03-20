<!-- model/searchIncByID.php -->
<?php
class searchIncByID {
    // 変数初期化
    private $loginID = null;
    private $query_getIncInfo = null;
    private $id = null;
  
    public function searchIncByID($loginID, $id){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->id = $id;

        // IDで一致する収入情報の取得
        $query_getIncInfo = "SELECT * FROM incomeTable WHERE incomeID = '$id' AND loginID = '$loginID'";
        $result_getIncInfo = mysqli_query($link, $query_getIncInfo);
        $incomeInfo = mysqli_fetch_array($result_getIncInfo);

        mysqli_close($link);
        
        return $incomeInfo;
    }
}
?>