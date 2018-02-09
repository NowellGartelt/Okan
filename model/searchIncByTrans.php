<?php
/**
 * 収入情報検索クエリ実行クラス
 * 
 * 各種収入情報を受け取り、DBに検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchIncByTrans
 * @var string $loginID ログインID
 * @var string $query 収入情報検索クエリ
 * @var string $incName 収入名
 * @var string $incCategory 収入カテゴリ
 * @var string $incState 収入一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
 * @var DateTime $incDateFrom 収入日(開始)
 * @var DateTime $incDateTo 収入日(終了)
 * @var array $result クエリ実行結果
 */
class searchIncByTrans 
{
    // インスタンス変数の定義
    private $loginID = null;
    private $incName = null;
    private $incCategory = null;
    private $incState = null;
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
     * 収入情報検索クエリ実行関数
     * 
     * 各種収入情報を受け取り、DBに検索するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $incName 収入名
     * @param string $incCategory 収入カテゴリ
     * @param string $incState 収入一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
     * @param string $incDateFrom 収入日(開始)
     * @param string $incDateTo 収入日(終了)
     * @return array 条件に合致した収入情報
     */
    public function searchIncByTrans(string $loginID, string $incName, string $incCategory, 
            string $incState, string $incDateFrom, string $incDateTo)
    {
        $this->loginID = $loginID;
        $this->incName = $incName;
        $this->incCategory = $incCategory;
        $this->incState = $incState;
        $this->incDateFrom = $incDateFrom;
        $this->incDateTo = $incDateTo;
        
        // ずべて空だった場合
        if (($incName == ""  && $incCategory == "" && $incState =="" 
                && $incDateFrom == "" && $incDateTo == "") || $loginID == null) {
            $this->result;
            
        } else {
            // DB接続情報取得
            require_once 'tools/databaseConnect.php';
            
            $query = "";
            
            $querySelect = "SELECT * FROM incomeTable ";
            $queryLeftOuterJoin = "LEFT OUTER JOIN incCategoryTable 
                ON incomeTable.incCategory = incCategoryTable.personalID
                AND incomeTable.loginID = incCategoryTable.loginID ";
            $queryWhere = "WHERE incomeTable.loginID = '$loginID' ";
            $queryOrderBy = "ORDER BY incDate, incomeID ASC";
            
            if ($incName !== "") {
                $queryWhere .= "AND incName LIKE '%{$incName}%' ";
            }
            if ($incCategory !== "") {
                $queryWhere .= "AND incCategory LIKE '%{$incCategory}%' ";
            }
            if ($incState !== "") {
                $queryWhere .= "AND incState LIKE '%{$incState}%' ";
            }
            if ($incDateFrom !== "") {
                $queryWhere .= "AND incDate >= '$incDateFrom' ";
            }
            if ($incDateTo !== "") {
                $queryWhere .= "AND incDate <= '$incDateTo' ";
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
