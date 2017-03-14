<!-- model/searchSumPayByCategory.php -->
<?php
class searchSumPayByCategory {
    // 変数初期化
    private $loginID = null;
    private $payDateFrom = null;
    private $payDateTo = null;
  
    public function searchSumPayByCategory($loginID, $payDateFrom, $payDateTo){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        
        if ($loginID == "" || $payDateFrom == "" || $payDateTo == "") {
            $paymentInfo = null;
            
        } else {
            // IDで対象のデータを引き当て
            $query_getPayInfo = 
                "SELECT payCategory, SUM(payment) 
                FROM paymentTable 
                WHERE loginID = '$loginID' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
                GROUP BY payCategory 
                ORDER BY SUM(payment) DESC";
            $result_getPayInfo = mysqli_query($link, $query_getPayInfo);
            $paymentInfo = array();
            
            while($row = mysqli_fetch_assoc($result_getPayInfo)) {
                array_push($paymentInfo, $row);
            }
        }

        mysqli_close($link);
        
        return $paymentInfo;
    }
}
?>