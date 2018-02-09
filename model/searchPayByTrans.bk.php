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
 * @var string $payName 支出名
 * @var string $payCategory 支出カテゴリ
 * @var string $payState 支出一言メモStateなのはもともと場所情報を保持するためだったことに由来する)
 * @var string $payDateFrom 支出日(開始)
 * @var string $payDateTo 支出日(終了)
 * @var array $result クエリ実行結果
 */
class searchPayByTrans 
{
    // インスタンス変数の定義
    private $loginID = null;
    private $payName = null;
    private $payCategory = null;
    private $payState = null;
    private $payDateFrom = null;
    private $payDateTo = null;
    private $result = null;
  
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() 
    {
        
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
     * @param string $payDateFrom 支出日(開始)
     * @param string $payDateTo 支出日(終了)
     * @return array 条件に合致する支出情報
     */
    public function searchPayByTrans(string $loginID, string $payName, string $payCategory, 
            string $payState, string $payDateFrom, string $payDateTo)
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        $this->payName = $payName;
        $this->payCategory = $payCategory;
        $this->payState = $payState;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        
        if (($payName == "" && $payCategory == "" && $payState == ""
                && $payDateFrom == "" && $payDateTo == "") || $loginID == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'tools/databaseConnect.php';
            
            // 入力された条件に合致する支出情報をすべて取得
            
            // 5つすべて入力されている場合
            // 5から5を選択する組み合わせ
            // x = 5! / 5! * (5 - 5)!
            // x = 5 * 4 * 3 * 2 * 1 / 5 * 4 * 3 * 2 * 1 * 1
            // x = 120 /120
            // x = 1
            if ($payName !== ""  && $payCategory !== "" && $payState !=="" && $payDateFrom !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payState LIKE '%{$payState}%' 
                    AND payCategory LIKE '%{$payCategory}%' 
                    AND payDate >= '$payDateFrom' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
                
            // 4つ入力されている場合
            // 5から4を選択する組み合わせ
            // x = 5! / 4! * (5 - 4)!
            // x = 5 * 4 * 3 * 2 * 1 / 4 * 3 * 2 * 1 * 1
            // x = 120 / 24
            // x = 5
            } elseif ($payName !== ""  && $payCategory !== "" && $payDateFrom !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' 
                    AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payName !== ""  && $payState !== "" && $payDateFrom !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payState LIKE '%{$payState}%' 
                    AND payDate >= '$payDateFrom' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payCategory !== "" && $payState !== "" && $payDateFrom !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payCategory LIKE '%{$payCategory}%' 
                    AND payState LIKE '%{$payState}%' 
                    AND payDate >= '$payDateFrom' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payName !== ""  && $payCategory !== "" && $payState !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payCategory LIKE '%{$payCategory}%' 
                    AND payState LIKE '%{$payState}%' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payName !== ""  && $payCategory !== "" && $payDateFrom !== "" && $payState !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payCategory LIKE '%{$payCategory}%' 
                    AND payDate >= '$payDateFrom' 
                    AND payState LIKE '%{$payState}%' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
                
            // 3つ入力されている場合
            // 5から3を選択する組み合わせ
            // x = 5! / 3! * (5 - 3)!
            // x = 5 * 4 * 3 * 2 * 1 / 3 * 2 * 1 * 2 * 1
            // x = 120 / 12
            // x = 10
            } elseif ($payName !== "" && $payCategory !== "" && $payState !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payCategory LIKE '%{$payCategory}%' 
                    AND payState LIKE '%{$payState}%' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payName !== "" && $payCategory !== "" && $payDateFrom !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payCategory LIKE '%{$payCategory}%' 
                    AND payDate <= '$payDateFrom' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payName !== "" && $payState !== "" && $payDateFrom !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payState LIKE '%{$payState}%' 
                    AND payDate <= '$payDateFrom' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payCategory !== "" && $payState !== "" && $payDateFrom !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payCategory LIKE '%{$payCategory}%' 
                    AND payState LIKE '%{$payState}%' 
                    AND payDate <= '$payDateFrom' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payName !== "" && $payCategory !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payCategory LIKE '%{$payCategory}%' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payName !== "" && $payState !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payState LIKE '%{$payState}%' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payCategory !== "" && $payState !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payCategory LIKE '%{$payCategory}%' 
                    AND payState LIKE '%{$payState}%' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payName !== "" && $payDateFrom !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payDate >= '$payDateFrom' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payCategory !== "" && $payDateFrom !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payCategory LIKE '%{$payCategory}%' 
                    AND payDate >= '$payDateFrom' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payState !== "" && $payDateFrom !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payState LIKE '%{$payState}%' 
                    AND payDate >= '$payDateFrom' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
                
            // 2つ入力されている場合
            // 5から2を選択する組み合わせ
            // x = 5! / 2! * (5 - 2)!
            // x = 5 * 4 * 3 * 2 * 1 / 2 * 1 * 3 * 2 * 1
            // x = 120 / 12
            // x = 10
            } elseif ($payName !== "" && $payCategory !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payCategory LIKE '%{$payCategory}%' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payName !== "" && $payDateFrom !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payDate >= '$payDateFrom' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payName !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payCategory !== "" && $payDateFrom !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payCategory LIKE '%{$payCategory}%' 
                    AND payDate <= '$payDateFrom' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payCategory !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payCategory LIKE '%{$payCategory}%' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payDateFrom !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payDate >= '$payDateFrom' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payName !== "" && $payState !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND payState LIKE '%{$payState}%' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payCategory !== "" && $payState !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payCategory LIKE '%{$payCategory}%' 
                    AND payState LIKE '%{$payState}%' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payState !== "" && $payDateFrom !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payState LIKE '%{$payState}%' 
                    AND payDate <= '$payDateFrom' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payState !== "" && $payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payState LIKE '%{$payState}%' 
                    AND payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
                
           // 1つ入力されている場合
           // 5から1を選択する組み合わせ
           // x = 5! / 1! * (5 - 1)!
           // x = 5 * 4 * 3 * 2 * 1 / 1 * 4 * 3 * 2 * 1
           // x = 120 / 24
           // x = 5
            } elseif ($payName !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payName LIKE '%{$payName}%' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payCategory !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payCategory LIKE '%{$payCategory}%' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payState !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payState LIKE '%{$payState}%' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payDateFrom !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payDate >= '$payDateFrom' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
            } elseif ($payDateTo !== "") {
                $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE payDate <= '$payDateTo' 
                    AND paymentTable.loginID = '$loginID' 
                    ORDER BY payDate, paymentID ASC";
                
            }
            
            $queryResult = mysqli_query($link, $query);
            $this->result = array();
            
            while ($row = mysqli_fetch_assoc($queryResult)) {
                array_push($this->result, $row);
            }
            
            // DB切断
            mysqli_close($link);
                    
        }

        return $this->result;
        
    }
}
