<!-- model/searchPaySum.php -->
<?php
class searchPaySum {
    private $loginID = null;
    private $payDateFrom = null;
    private $payDateTo = null;
    
    // コンストラクタ、何もしない
    public function __construct() {
        
    }
    
    public function searchPaySum($loginID, $payDateFrom, $payDateTo) {
	    // DB接続情報取得
		include '../model/tools/databaseConnect.php';
		
		$this->loginID = $loginID;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        
        // 指定された期間の総支出の取得
        $query_refPay = "SELECT SUM(payment) FROM paymentTable 
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