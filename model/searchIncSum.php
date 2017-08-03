<!-- model/searchIncSum.php -->
<?php
class searchIncSum {
    private $loginID = null;
    private $incDateFrom = null;
    private $incDateTo = null;
    
    public function searchIncSum($loginID, $incDateFrom, $incDateTo) {
	    // DB接続情報取得
		include '../model/tools/databaseConnect.php';
		
		$this->loginID = $loginID;
        $this->incDateFrom = $incDateFrom;
        $this->incDateTo = $incDateTo;
        
        if ($loginID == "" || $incDateFrom == "" || $incDateTo == "") {
            $incomeInfo = null;
            
        } else {
            // 指定された期間の総収入を取得する
            $query_refPay = 
                "SELECT SUM(income) FROM incomeTable 
                WHERE incDate >= '$incDateFrom' AND incDate <= '$incDateTo' 
                AND loginID = '$loginID'";
        
            $result_refPay = mysqli_query ($link, $query_refPay);
            $incomeInfo = array ();
		
            while ( $row = mysqli_fetch_assoc ($result_refPay) ) {
                array_push ($incomeInfo, $row);
            }
            if ($incomeInfo == null) {
                $incomeInfo[0]['SUM(income)'] = 0;
            }
        }
        
        mysqli_close($link);

        return $incomeInfo;
    }
}
?>