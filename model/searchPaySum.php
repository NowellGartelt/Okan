<?php
/**
 * 支出総額検索クエリ実行クラス
 * 
 * ログインID、支出日(開始)、支出日(終了)を受け取り、DBに支出総額を検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchPaySum
 * @var string loginID ログインID
 * @var string $payDateFrom 支出日(開始)
 * @var string $payDateTo 支出日(終了)
 * @var array $result クエリ実行結果
 */
class searchPaySum 
{
    // インスタンス変数の定義
    private $loginID = null;
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
     * 支出総額検索クエリ実行関数
     * 
     * ログインID、支出日(開始)、支出日(終了)を受け取り、DBに支出総額を検索するクエリを実行する
     * 
     * @access public
     * @param string loginID ログインID
     * @param string $payDateFrom 支出日(開始)
     * @param string $payDateTo 支出日(終了)
     * @return array 指定期間の支出総額
     */
    public function searchPaySum(string $loginID, string $payDateFrom, string $payDateTo) 
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        
        if ($loginID == null || $payDateFrom == null || $payDateTo == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'model.php';
            $model = new model();
            $link = $model -> getDatabaseCon();
            
            // 指定された期間の総支出の取得
            $query = "SELECT SUM(payment) FROM paymentTable 
                WHERE payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
                AND loginID = '$loginID'";
            
            $queryResult = mysqli_query($link, $query);
            $this->result = array ();
            
            while ($row = mysqli_fetch_assoc ($queryResult)) {
                array_push ($this->result, $row);
            }
            
            // DB切断
            mysqli_close($link);
        
        }

        return $this->result;
        
    }
}
