<!-- model/updateIncByTrans.php -->
<?php
class updateIncByTrans {
    private $loginID = null;
    private $query_updateIncInfo = null;
    private $incName = null;
    private $income = null;
    private $incCategory = null;
    private $incDate = null;
    private $incState = null;
    private $id = null;
  
    public function updateIncByTrans($loginID, $incName, $income, $incCategory, 
            $incDate, $incState, $id){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->incName = $incName;
        $this->income = $income;
        $this->incCategory = $incCategory;
        $this->incDate = $incDate;
        $this->incState = $incState;
        $this->id = $id;

        $query_updateIncInfo =
            "UPDATE incomeTable 
            SET incName = '$incName', income = '$income', incCategory = '$incCategory',
            incDate = '$incDate', incState = '$incState' WHERE incomeID = '$id' AND loginID = '$loginID'";
        $result_updateIncInfo = mysqli_query($link, $query_updateIncInfo);
        $incomeInfo = mysqli_fetch_array($result_updateIncInfo);
        
        mysqli_close($link);
        
        return $incomeInfo;
    }
}
?>