<?php
/**
 * 収入総額検索クエリ実行クラス
 * 
 * ログインID、収入日(開始)、収入日(終了)を受け取り、DBに指定期間の収入総額を検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchIncSum
 * @var object $model モデルクラス共通処理オブジェクト
 * @var int $userID ユーザID
 * @var DateTime $incDateFrom 収入日(開始)
 * @var DateTime $incDateTo 収入日(終了)
 * @var array $result クエリ実行結果
 */
class searchIncSum 
{
    // インスタンス変数の定義
    private $model = "";
    private $userID = "";
    private $incDateFrom = "";
    private $incDateTo = "";
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
     * 収入総額検索クエリ実行関数
     * 
     * ログインID、収入日(開始)、収入日(終了)を受け取り、DBに指定期間の収入総額を検索するクエリを実行する
     * 
     * @access public
     * @param int $userID
     * @param string $incDateFrom 収入日(開始)
     * @param string $incDateTo 収入日(終了)
     * @return array 指定期間の収入総額
     */
    public function searchIncSum(int $userID, string $incDateFrom, string $incDateTo) 
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
            
            // DB接続に失敗した場合
            if ($link == false) {
                $DBConnect = "failed";
                $this->model -> setDBConnectResult($DBConnect);
                $this->result = null;
                
            } else {
                $DBConnect = "success";
                $this->model -> setDBConnectResult($DBConnect);
                
                // 指定された期間の総収入を取得する
                $query = 
                    "SELECT SUM(income) FROM incomeTable 
                    WHERE incDate >= '$incDateFrom' AND incDate <= '$incDateTo' 
                    AND userID = '$userID'";
                    
                $queryResult = mysqli_query ($link, $query);
                $result = array ();
		        
                while ($row = mysqli_fetch_assoc($queryResult)) {
                    array_push ($this->result, $row);
                    
                }
                if ($this->result == null) {
                    $this->result[0]['SUM(income)'] = 0;
                    
                }
            }
        }
        // DB切断
        mysqli_close($link);

        return $this->result;
    }
}
