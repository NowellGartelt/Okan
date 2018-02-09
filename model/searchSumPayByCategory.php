<?php
/**
 * カテゴリ別支出総額検索クエリ実行クラス
 * 
 * ログインID、支出日(開始)、支出日(終了)を受け取り、DBにカテゴリ別の支出総額を検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchSumPayByCategory
 * @var string $loginID ログインID
 * @var string $payDateFrom 支出日(開始)
 * @var string $payDateTo 支出日(終了)
 * @var array $result クエリ実行結果
 */
class searchSumPayByCategory 
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
     * カテゴリ別支出総額検索クエリ実行関数
     * 
     * ログインID、支出日(開始)、支出日(終了)を受け取り、DBにカテゴリ別の支出総額を検索するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $payDateFrom 支出日(開始)
     * @param string $payDateTo 支出日(終了)
     * @return array カテゴリ別支出総額
     */
    public function searchSumPayByCategory(string $loginID, string $payDateFrom, string $payDateTo)
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        
        // いずれかの値が空だった場合、nullを返す
        if ($loginID == "" || $payDateFrom == "" || $payDateTo == "") {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'tools/databaseConnect.php';
            
            // IDで対象のデータを引き当て
            // 指定された期間のカテゴリごとの支出額の取得、支出の多い順に並べる
            $query = 
                "SELECT payCategory, SUM(payment) 
                FROM paymentTable 
                WHERE loginID = '$loginID' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
                GROUP BY payCategory 
                ORDER BY SUM(payment) DESC";
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
