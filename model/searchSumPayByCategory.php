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
 * @var object $model モデルクラス共通処理オブジェクト
 * @var int $userID ユーザID
 * @var string $payDateFrom 支出日(開始)
 * @var string $payDateTo 支出日(終了)
 * @var array $result クエリ実行結果
 */
class searchSumPayByCategory 
{
    // インスタンス変数の定義
    private $model = "";
    private $userID = "";
    private $payDateFrom = "";
    private $payDateTo = "";
    private $result = array();
  
    /**
     * コンストラクタ
     *
     * @access public
     */
    public function __construct() 
    {
        // モデルの共通処理取得
        require_once 'model.php';
        $this->model = new model();
        
    }
    
    /**
     * カテゴリ別支出総額検索クエリ実行関数
     * 
     * ログインID、支出日(開始)、支出日(終了)を受け取り、DBにカテゴリ別の支出総額を検索するクエリを実行する
     * 
     * @access public
     * @param int $userID ユーザID
     * @param string $payDateFrom 支出日(開始)
     * @param string $payDateTo 支出日(終了)
     * @return array カテゴリ別支出総額
     */
    public function searchSumPayByCategory(int $userID, string $payDateFrom, string $payDateTo)
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        
        // いずれかの値が空だった場合、nullを返す
        if ($userID == "" || $payDateFrom == "" || $payDateTo == "") {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // DB接続に失敗した場合
            if ($link == false) {
                $DBConnect = "failed";
                $this->model -> setDBConnectResult($DBConnect);
                $this->result = null;
                
            } else {
                $DBConnect = "success";
                $this->model -> setDBConnectResult($DBConnect);
                
                // IDで対象のデータを引き当て
                // 指定された期間のカテゴリごとの支出額の取得、支出の多い順に並べる
                $query = 
                    "SELECT categoryName, SUM(payment) 
                    FROM paymentTable 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.categoryID 
                    WHERE paymentTable.userID = '$userID' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
                    GROUP BY categoryName 
                    ORDER BY SUM(payment) DESC";
                $queryResult = mysqli_query($link, $query);
                
                while ($row = mysqli_fetch_assoc($queryResult)) {
                    array_push($this->result, $row);
                    
                }
            }
            // DB切断
            mysqli_close($link);
            
        }
        return $this->result;
        
    }
}
