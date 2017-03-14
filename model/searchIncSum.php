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
        
        $query_refPay = "SELECT SUM(payment) FROM IncomeTable 
            WHERE incDate >= '$incDateFrom' AND incDate <= '$incDateTo' 
            AND loginID = '$loginID'";

        $result_refPay = mysqli_query ($link, $query_refPay);
        $result_list = array ();
		
        while ( $row = mysqli_fetch_assoc ($result_refPay) ) {
            array_push ($result_list, $row);
        }
        if ($result_list == null) {
            $result_list[0]['SUM(income)'] = 0;
        }
        
        mysqli_close($link);

        return $result_list;
    }
}
?>