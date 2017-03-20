<!-- model/searchPayByDay.php -->
<?php
class searchPayByDay {
    private $loginID = NULL;
    private $query_refPay = null;
    private $payName = null;
    private $payCategory = null;
    private $payDateFrom = null;
    private $payDateTo = null;
    private $choiceKey = null;
    
    public function searchPayByDay($loginID, $payName, $payCategory, 
            $payDateFrom, $payDateTo, $choiceKey) {
	    // DB接続情報取得
		include '../model/tools/databaseConnect.php';
		
		$this->loginID = $loginID;
        $this->payName = $payName;
        $this->payCategory = $payCategory;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        $this->choiceKey = $choiceKey;
        
        // 日ごとの支出額の合計の取得

        // 検索条件で名前が指定された場合
        if ($choiceKey == "payName") {
            $query_refPay = "SELECT payDate, SUM(payment) FROM paymentTable 
                WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                GROUP BY payDate";
        
        // 検索条件でカテゴリを指定された場合
        } elseif ($choiceKey == "payCategory") {
            $query_refPay = "SELECT payDate, SUM(payment) FROM paymentTable 
                WHERE payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                GROUP BY payDate";

        // 検索条件で何も指定されなかった場合
        } else {
            $query_refPay = "SELECT payDate, SUM(payment) FROM paymentTable
                WHERE payDate >= '$payDateFrom' AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                GROUP BY payDate";
        }

        $result_refPay = mysqli_query ( $link, $query_refPay );
        $result_list = array ();
		
        while ( $row = mysqli_fetch_assoc ( $result_refPay ) ) {
            array_push ( $result_list, $row );
        }
        mysqli_close($link);

        return $result_list;
    }
}
?>