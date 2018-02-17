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
 * @var int $userID ユーザID
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
    private $model = "";
    private $userID = "";
    private $incName = "";
    private $incCategory = "";
    private $incState = "";
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
     * 収入情報検索クエリ実行関数
     * 
     * 各種収入情報を受け取り、DBに検索するクエリを実行する
     * 
     * @access public
     * @param int $userID ユーザID
     * @param string $incName 収入名
     * @param string $incCategory 収入カテゴリ
     * @param string $incState 収入一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
     * @param string $incDateFrom 収入日(開始)
     * @param string $incDateTo 収入日(終了)
     * @return array 条件に合致した収入情報
     */
    public function searchIncByTrans(int $userID, string $incName, string $incCategory, 
            string $incState, string $incDateFrom, string $incDateTo)
    {
        $this->userID = $userID;
        $this->incName = $incName;
        $this->incCategory = $incCategory;
        $this->incState = $incState;
        $this->incDateFrom = $incDateFrom;
        $this->incDateTo = $incDateTo;
        
        // ずべて空だった場合
        if (($incName == ""  && $incCategory == "" && $incState =="" 
                && $incDateFrom == "" && $incDateTo == "") || $userID == "") {
            $this->result;
            
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
                
                // SQL文初期設定
                $query = "";
                
                $querySelect = "SELECT * FROM incomeTable ";
                $queryLeftOuterJoin = "LEFT OUTER JOIN incCategoryTable 
                        ON incomeTable.incCategory = incCategoryTable.categoryID
                        AND incomeTable.userID = incCategoryTable.userID ";
                $queryWhere = "WHERE incomeTable.userID = '$userID' ";
                $queryOrderBy = "ORDER BY incDate, incomeID ASC";
                
                // 名前が記入されていた場合、名前を条件に追加
                if ($incName !== "") {
                    $queryWhere .= "AND incName LIKE '%{$incName}%' ";
                }
                // カテゴリが記入されていた場合、カテゴリを条件に追加
                if ($incCategory !== "") {
                    $queryWhere .= "AND incCategory = '$incCategory' ";
                }
                // 一言メモが記入されていた場合、一言メモを条件に追加
                if ($incState !== "") {
                    $queryWhere .= "AND incState LIKE '%{$incState}%' ";
                }
                // 開始日が記入されていた場合、開始日を条件に追加
                if ($incDateFrom !== "") {
                    $queryWhere .= "AND incDate >= '$incDateFrom' ";
                }
                // 終了日が記入されていた場合、終了日を条件に追加
                if ($incDateTo !== "") {
                    $queryWhere .= "AND incDate <= '$incDateTo' ";
                }
            
                // SQL文連結作成
                $query = $querySelect.$queryLeftOuterJoin.$queryWhere.$queryOrderBy;
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
