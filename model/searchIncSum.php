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
 * @var string $loginID ログインID
 * @var DateTime $incDateFrom 収入日(開始)
 * @var DateTime $incDateTo 収入日(終了)
 * @var array $result クエリ実行結果
 */
class searchIncSum 
{
    // インスタンス変数の定義
    private $loginID = null;
    private $incDateFrom = null;
    private $incDateTo = null;
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
     * 収入総額検索クエリ実行関数
     * 
     * ログインID、収入日(開始)、収入日(終了)を受け取り、DBに指定期間の収入総額を検索するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $incDateFrom 収入日(開始)
     * @param string $incDateTo 収入日(終了)
     * @return array 指定期間の収入総額
     */
    public function searchIncSum(string $loginID, string $incDateFrom, string $incDateTo) 
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        $this->incDateFrom = $incDateFrom;
        $this->incDateTo = $incDateTo;
        
        // いずれかの値が空だった場合、nullを返す
        if ($loginID == "" || $incDateFrom == "" || $incDateTo == "") {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'tools/databaseConnect.php';
            
            // 指定された期間の総収入を取得する
            $query = 
                "SELECT SUM(income) FROM incomeTable 
                WHERE incDate >= '$incDateFrom' AND incDate <= '$incDateTo' 
                AND loginID = '$loginID'";
        
            $queryResult = mysqli_query ($link, $query);
            $result = array ();
		
            while ($row = mysqli_fetch_assoc ($queryResult)) {
                array_push ($this->result, $row);
            }
            if ($this->result == null) {
                $this->result[0]['SUM(income)'] = 0;
            }
        }
        
        // DB切断
        mysqli_close($link);

        return $this->result;
    }
}
