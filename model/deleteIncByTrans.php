<!-- model/deleteIncByTrans.php -->
<?php
class deleteincByTrans {
    private $loginID = null;
    private $query_registIncInfo = null;
    private $id = null;
  
    public function deleteIncByTrans($loginID, $id){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;
        $this->id = $id;

        $query_deleteIncInfo = "DELETE FROM incomeTable WHERE incomeID = '$id' AND loginID = '$loginID'";
        $result_deleteIncInfo = mysqli_query($link, $query_deleteIncInfo);
        $incomeInfo = mysqli_fetch_array($result_deleteIncInfo);
        
        mysqli_close($link);
        
        return $incomeInfo;
    }
}
?>