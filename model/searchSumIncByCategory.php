<?php
/**
 * カテゴリ別収入総額検索クエリ実行クラス
 * 
 * ログインID、収入日(開始)、収入日(終了)を受け取り、DBにカテゴリ別の収入総額を検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchSumIncByCategory
 * @var int $userID ユーザID
 * @var string $incDateFrom 収入日(開始)
 * @var string $incDateTo 収入日(終了)
 * @var array $result クエリ実行結果
 */
class searchSumIncByCategory 
{
    // インスタンス変数の定義
    private $userID = "";
    private $incDateFrom = "";
    private $incDateTo = "";
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
     * カテゴリ別収入総額検索クエリ実行関数
     * 
     * ログインID、収入日(開始)、収入日(終了)を受け取り、DBにカテゴリ別の収入総額を検索するクエリを実行する
     * 
     * @access public
     * @param int $userID ユーザID
     * @param string $incDateFrom 支出日(開始)
     * @param string $incDateTo 支出日(終了)
     * @return array カテゴリ別支出総額
     */
    public function searchSumIncByCategory(int $userID, string $incDateFrom, string $incDateTo)
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        $this->incDateFrom = $incDateFrom;
        $this->incDateTo = $incDateTo;
        
        // いずれかの値が空だった場合、nullを返す
        if ($userID == "" || $incDateFrom == "" || $incDateTo == "") {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // IDで対象のデータを引き当て
            // 指定された期間のカテゴリごとの支出額の取得、支出の多い順に並べる
            $query = 
                "SELECT categoryName, SUM(income) 
                FROM incomeTable 
                LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.categoryID 
                WHERE incomeTable.userID = '$userID' AND incDate >= '$incDateFrom' AND incDate <= '$incDateTo' 
                GROUP BY categoryName 
                ORDER BY SUM(income) DESC";
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
