<!-- model/registIncByTrans.php -->
<?php
class registIncByTrans {
    private $loginID = null;
    private $query_registIncInfo = null;
    private $incName = null;
    private $income = null;
    private $incCategory = null;
    private $incState = null;
    private $incDate = null;
    private $registDate = null;
  
    public function registIncByTrans($loginID, $incName, $income, $incCategory, 
            $incState, $incDate, $registDate){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        echo "YYYY";
        
        $this->loginID = $loginID;
        $this->incName = $incName;
        $this->income = $Income;
        $this->incCategory = $incCategory;
        $this->incDate = $incDate;
        $this->incState = $incState;
        $this->id = $id;

        $query_registInc =
            "INSERT INTO IncomeTable (
            incName, income, incCategory, incState, incDate, registDate, updateDate, loginID)
            VALUES (
            '$incName', '$income', '$incCategory', '$incState', '$incDate', '$registDate', null, '$loginID')";
        $result_registIncInfo = mysqli_query($link, $query_registInc);
        $incomeInfo = mysqli_fetch_array($result_registIncInfo);
        
        mysqli_close($link);
        
        var_dump($incomeInfo);
        
        return $incomeInfo;
    }
}
?>