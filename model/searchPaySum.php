<!-- model/searchPaySum.php -->
<?php
class searchPaySum {
    private $loginID = null;
    private $payDateFrom = null;
    private $payDateTo = null;
    
    public function searchPaySum($loginID, $payDateFrom, $payDateTo) {
	    // DB接続情報取得
		include '../model/tools/databaseConnect.php';
		
		$this->loginID = $loginID;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        
        $query_refPay = "SELECT SUM(payment) FROM paymenttable 
            WHERE payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
            AND loginID = '$loginID'";

        $result_refPay = mysqli_query ($link, $query_refPay);
        $result_list = array ();
		
        while ( $row = mysqli_fetch_assoc ($result_refPay) ) {
            array_push ($result_list, $row);
        }
        if ($result_list == null) {
            $result_list[0]['SUM(payment)'] = 0;
        }
        mysqli_close($link);

        return $result_list;
    }
}
?>