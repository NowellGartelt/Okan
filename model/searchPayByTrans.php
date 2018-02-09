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
            
            $query = "";
            
            $querySelect = "SELECT * FROM paymentTable ";
            $queryLeftOuterJoin = "LEFT OUTER JOIN methodOfPayment 
                    ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable 
                    ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID ";
            $queryWhere = "WHERE paymentTable.loginID = '$loginID' ";
            $queryOrderBy = "ORDER BY payDate, paymentID ASC";
            
            if ($payName !== "") {
                $queryWhere .= "AND payName LIKE '%{$payName}%' ";
            }
            if ($payCategory !== "") {
                $queryWhere .= "AND payCategory LIKE '%{$payCategory}%' ";
            }
            if ($payState !== "") {
                $queryWhere .= "AND payState LIKE '%{$payState}%' ";
            }
            if ($payDateFrom !== "") {
                $queryWhere .= "AND payDate >= '$payDateFrom' ";
            }
            if ($payDateTo !== "") {
                $queryWhere .= "AND payDate <= '$payDateTo' ";
            }
            
            $query = $querySelect.$queryLeftOuterJoin.$queryWhere.$queryOrderBy;
            
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
