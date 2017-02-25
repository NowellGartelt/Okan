<!-- model/searchPayByTrans.php -->
<?php
class searchPayByTrans {
    // 変数初期化
    private $loginID = null;
    private $query_refPay = null;
    private $payName = null;
    private $payCategory = null;
    private $payState = null;
    private $payDateFrom = null;
    private $payDateTo = null;
  
    public function searchPayByTrans($loginID, $payName, $payCategory, 
            $payState, $payDateFrom, $payDateTo){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;
        $this->payName = $payName;
        $this->payCategory = $payCategory;
        $this->payState = $payState;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;

        // 5つすべて入力されている場合
        // 5から5を選択する組み合わせ
        // x = 5! / 5! * (5 - 5)!
        // x = 5 * 4 * 3 * 2 * 1 / 5 * 4 * 3 * 2 * 1 * 1
        // x = 120 /120
        // x = 1
        if($payName !== ""  && $payCategory !== "" && $payState !=="" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payState LIKE '%{$payState}%' AND payCategory LIKE '%{$payCategory}%' 
                AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";

        // 4つ入力されている場合
        // 5から4を選択する組み合わせ
        // x = 5! / 4! * (5 - 4)!
        // x = 5 * 4 * 3 * 2 * 1 / 4 * 3 * 2 * 1 * 1
        // x = 120 / 24
        // x = 5
        } elseif($payName !== ""  && $payCategory !== "" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== ""  && $payState !== "" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payState LIKE '%{$payState}%' AND payDate >= '$payDateFrom' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payState !== "" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' 
                AND payState LIKE '%{$payState}%' AND payDate >= '$payDateFrom' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== ""  && $payCategory !== "" && $payState !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== ""  && $payCategory !== "" && $payDateFrom !== "" && $payState !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' 
                AND payState LIKE '%{$payState}%' AND loginID = '$loginID' 
                ORDER BY payDate ASC";

        // 3つ入力されている場合
        // 5から3を選択する組み合わせ
        // x = 5! / 3! * (5 - 3)!
        // x = 5 * 4 * 3 * 2 * 1 / 3 * 2 * 1 * 2 * 1
        // x = 120 / 12
        // x = 10
        } elseif($payName !== "" && $payCategory !== "" && $payState !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' 
                AND loginID = '$loginID' ORDER BY payDate ASC";
        } elseif($payName !== "" && $payCategory !== "" && $payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateFrom' 
                AND loginID = '$loginID' ORDER BY payDate ASC";
        } elseif($payName !== "" && $payState !== "" && $payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payState LIKE '%{$payState}%' AND payDate <= '$payDateFrom' 
                AND loginID = '$loginID' ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payState !== "" && $payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' 
                AND payState LIKE '%{$payState}%' AND payDate <= '$payDateFrom' 
                AND loginID = '$loginID' ORDER BY payDate ASC";
        } elseif($payName !== "" && $payCategory !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID' ORDER BY payDate ASC";
        } elseif($payName !== "" && $payState !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payState LIKE '%{$payState}%' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID' ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payState !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' 
                AND payState LIKE '%{$payState}%' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID' ORDER BY payDate ASC";
        } elseif($payName !== "" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID' ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' 
                AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID' ORDER BY payDate ASC";
        } elseif($payState !== "" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payState LIKE '%{$payState}%' 
                AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID' ORDER BY payDate ASC";

        // 2つ入力されている場合
        // 5から2を選択する組み合わせ
        // x = 5! / 2! * (5 - 2)!
        // x = 5 * 4 * 3 * 2 * 1 / 2 * 1 * 3 * 2 * 1
        // x = 120 / 12
        // x = 10
        } elseif($payName !== "" && $payCategory !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payCategory LIKE '%{$payCategory}%' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== "" && $payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payDate >= '$payDateFrom' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' 
                AND payDate <= '$payDateFrom' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payDate >= '$payDateFrom' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== "" && $payState !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' 
                AND payState LIKE '%{$payState}%' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payState !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' 
                AND payState LIKE '%{$payState}%' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payState !== "" && $payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payState LIKE '%{$payState}%' 
                AND payDate <= '$payDateFrom' 
                ORDER BY payDate ASC";
        } elseif($payState !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable WHERE payState LIKE '%{$payState}%' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";

       // 1つ入力されている場合
       // 5から1を選択する組み合わせ
       // x = 5! / 1! * (5 - 1)!
       // x = 5 * 4 * 3 * 2 * 1 / 1 * 4 * 3 * 2 * 1
       // x = 120 / 24
       // x = 5
        } elseif($payName !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                WHERE payName LIKE '%{$payName}%' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payCategory !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                WHERE payCategory LIKE '%{$payCategory}%' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payState !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                WHERE payState LIKE '%{$payState}%' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                WHERE payDate >= '$payDateFrom' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                WHERE payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";

        // ひとつも入力されていない場合
        // 全件検索する
        } else {
            $query_refPay = "SELECT * FROM paymentTable 
                WHERE AND loginID = '$loginID' ORDER BY payDate ASC";
        }
        
        $result_refPay = mysqli_query($link, $query_refPay);
        $result_list = array();
        
        while($row = mysqli_fetch_assoc($result_refPay)) {
            array_push($result_list, $row);
        }
        mysqli_close($link);

        return $result_list;
    }
}
?>