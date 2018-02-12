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
 * @var int $userID ユーザID
 * @var string $payName 支出名
 * @var string $payCategory 支出カテゴリ
 * @var string $payState 支出一言メモStateなのはもともと場所情報を保持するためだったことに由来する)
 * @var string $payDateFrom 支出日(開始)
 * @var string $payDateTo 支出日(終了)
 * @var string $methodOfPayment 支払方法
 * @var array $result クエリ実行結果
 */
class searchPayByTrans 
{
    // インスタンス変数の定義
    private $userID = "";
    private $payName = "";
    private $payCategory = "";
    private $payState = "";
    private $payDateFrom = "";
    private $payDateTo = "";
    private $methodOfPayment = "";
    private $result = array();
  
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
     * @param int $userID ユーザID
     * @param string $payName 支出名
     * @param string $payCategory 支出カテゴリ
     * @param string $payState 支出一言メモStateなのはもともと場所情報を保持するためだったことに由来する)
     * @param string $payDateFrom 支出日(開始)
     * @param string $payDateTo 支出日(終了)
     * @param string $methodOfPayment 支払方法
     * @return array 条件に合致する支出情報
     */
    public function searchPayByTrans(int $userID, string $payName, string $payCategory, 
            string $payState, string $payDateFrom, string $payDateTo, string $methodOfPayment)
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        $this->payName = $payName;
        $this->payCategory = $payCategory;
        $this->payState = $payState;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        $this->methodOfPayment = $methodOfPayment;
        
        if (($payName == "" && $payCategory == "" && $payState == ""
                && $payDateFrom == "" && $payDateTo == "" && $methodOfPayment == "") 
                || $userID == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // SQL文初期設定
            $query = "";
            
            $querySelect = "SELECT * FROM paymentTable ";
            $queryLeftOuterJoin = "LEFT OUTER JOIN methodOfPayment 
                    ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable 
                    ON paymentTable.payCategory = payCategoryTable.categoryID 
                    AND paymentTable.userID = payCategoryTable.userID ";
            $queryWhere = "WHERE paymentTable.userID = '$userID' ";
            $queryOrderBy = "ORDER BY payDate, paymentID ASC";
            
            // 名前が記入されていた場合、名前を条件に追加
            if ($payName !== "") {
                $queryWhere .= "AND payName LIKE '%{$payName}%' ";
            }
            // カテゴリが記入されていた場合、カテゴリを条件に追加
            if ($payCategory !== "") {
                $queryWhere .= "AND payCategory = '$payCategory' ";
            }
            // 一言メモが記入されていた場合、一言メモを条件に追加
            if ($payState !== "") {
                $queryWhere .= "AND payState LIKE '%{$payState}%' ";
            }
            // 開始日が記入されていた場合、開始日を条件に追加
            if ($payDateFrom !== "") {
                $queryWhere .= "AND payDate >= '$payDateFrom' ";
            }
            // 終了日が記入されていた場合、終了日を条件に追加
            if ($payDateTo !== "") {
                $queryWhere .= "AND payDate <= '$payDateTo' ";
            }
            // 支払方法が選択されていた場合、支払方法を条件に追記
            if ($methodOfPayment !== "") {
                $queryWhere .= "AND paymentTable.mopID = '$methodOfPayment' ";
            }
            
            // SQL文連結作成
            $query = $querySelect.$queryLeftOuterJoin.$queryWhere.$queryOrderBy;
            $queryResult = mysqli_query($link, $query);
            
            while ($row = mysqli_fetch_assoc($queryResult)) {
                array_push($this->result, $row);
            }
            
            // DB切断
            mysqli_close($link);
                    
        }

        return $this->result;
        
    }
}
