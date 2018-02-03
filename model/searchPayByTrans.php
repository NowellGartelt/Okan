<?php
/**
 * 支出情報検索クエリ実行クラス
 * 
 * 支出情報を受け取り、DBに検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchPayByTrans
 * @var string $loginID ログインID
 * @var string $query_refPay 支出情報検索クエリ
 * @var string $payName 支出名
 * @var string $payCategory 支出カテゴリ
 * @var string $payState 支出一言メモStateなのはもともと場所情報を保持するためだったことに由来する)
 * @var DateTime $payDateFrom 支出日(開始)
 * @var DateTime $payDateTo 支出日(終了)
 */

class searchPayByTrans {
    // インスタンス変数の初期化
    private $loginID = null;
    private $query_refPay = null;
    private $payName = null;
    private $payCategory = null;
    private $payState = null;
    private $payDateFrom = null;
    private $payDateTo = null;
  
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * 支出情報検索クエリ実行関数
     * 
     * 支出情報を受け取り、DBに検索するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $payName 支出名
     * @param string $payCategory 支出カテゴリ
     * @param string $payState 支出一言メモStateなのはもともと場所情報を保持するためだったことに由来する)
     * @param DateTime $payDateFrom 支出日(開始)
     * @param DateTime $payDateTo 支出日(終了)
     * @return array $result_list 支出情報
     */
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

        // 入力された条件に合致する支出情報をすべて取得
        
        // 5つすべて入力されている場合
        // 5から5を選択する組み合わせ
        // x = 5! / 5! * (5 - 5)!
        // x = 5 * 4 * 3 * 2 * 1 / 5 * 4 * 3 * 2 * 1 * 1
        // x = 120 /120
        // x = 1
        if($payName !== ""  && $payCategory !== "" && $payState !=="" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' 
                AND payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";

        // 4つ入力されている場合
        // 5から4を選択する組み合わせ
        // x = 5! / 4! * (5 - 4)!
        // x = 5 * 4 * 3 * 2 * 1 / 4 * 3 * 2 * 1 * 1
        // x = 120 / 24
        // x = 5
        } elseif($payName !== ""  && $payCategory !== "" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' 
                AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== ""  && $payState !== "" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' 
                AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payState !== "" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' 
                AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== ""  && $payCategory !== "" && $payState !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' 
                AND payState LIKE '%{$payState}%' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== ""  && $payCategory !== "" && $payDateFrom !== "" && $payState !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' 
                AND payDate >= '$payDateFrom' AND payState LIKE '%{$payState}%' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";

        // 3つ入力されている場合
        // 5から3を選択する組み合わせ
        // x = 5! / 3! * (5 - 3)!
        // x = 5 * 4 * 3 * 2 * 1 / 3 * 2 * 1 * 2 * 1
        // x = 120 / 12
        // x = 10
        } elseif($payName !== "" && $payCategory !== "" && $payState !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' 
                AND payState LIKE '%{$payState}%' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== "" && $payCategory !== "" && $payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' 
                AND payDate <= '$payDateFrom' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== "" && $payState !== "" && $payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' 
                AND payDate <= '$payDateFrom' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payState !== "" && $payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' 
                AND payDate <= '$payDateFrom' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== "" && $payCategory !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== "" && $payState !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payState !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== "" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payState !== "" && $payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payState LIKE '%{$payState}%' AND payDate >= '$payDateFrom' 
                AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";

        // 2つ入力されている場合
        // 5から2を選択する組み合わせ
        // x = 5! / 2! * (5 - 2)!
        // x = 5 * 4 * 3 * 2 * 1 / 2 * 1 * 3 * 2 * 1
        // x = 120 / 12
        // x = 10
        } elseif($payName !== "" && $payCategory !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== "" && $payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payDate <= '$payDateTo' AND 
                loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateFrom' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payDateFrom !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payName !== "" && $payState !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payCategory !== "" && $payState !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payState !== "" && $payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payState LIKE '%{$payState}%' AND payDate <= '$payDateFrom' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payState !== "" && $payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payState LIKE '%{$payState}%' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID' 
                ORDER BY payDate ASC";

       // 1つ入力されている場合
       // 5から1を選択する組み合わせ
       // x = 5! / 1! * (5 - 1)!
       // x = 5 * 4 * 3 * 2 * 1 / 1 * 4 * 3 * 2 * 1
       // x = 120 / 24
       // x = 5
        } elseif($payName !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payName LIKE '%{$payName}%' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payCategory !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payCategory LIKE '%{$payCategory}%' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payState !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payState LIKE '%{$payState}%' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payDateFrom !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payDate >= '$payDateFrom' AND loginID = '$loginID' 
                ORDER BY payDate ASC";
        } elseif($payDateTo !== ""){
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE payDate <= '$payDateTo' AND loginID = '$loginID' 
                ORDER BY payDate ASC";

        // ひとつも入力されていない場合
        // 全件検索する
        } else {
            $query_refPay = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE loginID = '$loginID' 
                ORDER BY payDate ASC";
        }
        
        $result_refPay = mysqli_query($link, $query_refPay);
        $result_list = array();
        
        while($row = mysqli_fetch_assoc($result_refPay)) {
            array_push($result_list, $row);
        }
        
        // DB切断
        mysqli_close($link);

        return $result_list;
    }
}
