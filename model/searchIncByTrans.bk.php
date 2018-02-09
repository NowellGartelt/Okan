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
            
            // 入力された条件に合致する収入情報をすべて取得
            
            // 5つすべて入力されている場合
            // 5から5を選択する組み合わせ
            // x = 5! / 5! * (5 - 5)!
            // x = 5 * 4 * 3 * 2 * 1 / 5 * 4 * 3 * 2 * 1 * 1
            // x = 120 /120
            // x = 1
            if ($incName !== ""  && $incCategory !== "" && $incState !=="" 
                    && $incDateFrom !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incState LIKE '%{$incState}%' 
                    AND incCategory LIKE '%{$incCategory}%' 
                    AND incDate >= '$incDateFrom' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
                
            // 4つ入力されている場合
            // 5から4を選択する組み合わせ
            // x = 5! / 4! * (5 - 4)!
            // x = 5 * 4 * 3 * 2 * 1 / 4 * 3 * 2 * 1 * 1
            // x = 120 / 24
            // x = 5
            } elseif ($incName !== ""  && $incCategory !== "" && $incDateFrom !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incCategory LIKE '%{$incCategory}%' 
                    AND incDate >= '$incDateFrom' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incName !== ""  && $incState !== "" && $incDateFrom !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incState LIKE '%{$incState}%' 
                    AND incDate >= '$incDateFrom' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incCategory !== "" && $incState !== "" && $incDateFrom !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incCategory LIKE '%{$incCategory}%' 
                    AND incState LIKE '%{$incState}%' 
                    AND incDate >= '$incDateFrom' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incName !== ""  && $incCategory !== "" && $incState !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incCategory LIKE '%{$incCategory}%' 
                    AND incState LIKE '%{$incState}%' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incName !== ""  && $incCategory !== "" && $incDateFrom !== "" && $incState !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incCategory LIKE '%{$incCategory}%' 
                    AND incDate >= '$incDateFrom' 
                    AND incState LIKE '%{$incState}%' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
                
            // 3つ入力されている場合
            // 5から3を選択する組み合わせ
            // x = 5! / 3! * (5 - 3)!
            // x = 5 * 4 * 3 * 2 * 1 / 3 * 2 * 1 * 2 * 1
            // x = 120 / 12
            // x = 10
            } elseif ($incName !== "" && $incCategory !== "" && $incState !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incCategory LIKE '%{$incCategory}%' 
                    AND incState LIKE '%{$incState}%' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incName !== "" && $incCategory !== "" && $incDateFrom !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incCategory LIKE '%{$incCategory}%' 
                    AND incDate <= '$incDateFrom' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incName !== "" && $incState !== "" && $incDateFrom !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incState LIKE '%{$incState}%' 
                    AND incDate <= '$incDateFrom' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incCategory !== "" && $incState !== "" && $incDateFrom !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incCategory LIKE '%{$incCategory}%' 
                    AND incState LIKE '%{$incState}%' 
                    AND incDate <= '$incDateFrom' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incName !== "" && $incCategory !== "" && $incDateTo !== "") {
                    $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incCategory LIKE '%{$incCategory}%' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incName !== "" && $incState !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incState LIKE '%{$incState}%' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incCategory !== "" && $incState !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incCategory LIKE '%{$incCategory}%' 
                    AND incState LIKE '%{$incState}%' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incName !== "" && $incDateFrom !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incDate >= '$incDateFrom' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incCategory !== "" && $incDateFrom !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incCategory LIKE '%{$incCategory}%' 
                    AND incDate >= '$incDateFrom' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incState !== "" && $incDateFrom !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incState LIKE '%{$incState}%' 
                    AND incDate >= '$incDateFrom' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
                
            // 2つ入力されている場合
            // 5から2を選択する組み合わせ
            // x = 5! / 2! * (5 - 2)!
            // x = 5 * 4 * 3 * 2 * 1 / 2 * 1 * 3 * 2 * 1
            // x = 120 / 12
            // x = 10
            } elseif ($incName !== "" && $incCategory !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incCategory LIKE '%{$incCategory}%' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incName !== "" && $incDateFrom !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incDate >= '$incDateFrom' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incName !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incCategory !== "" && $incDateFrom !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incCategory LIKE '%{$incCategory}%' 
                    AND incDate <= '$incDateFrom' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incCategory !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incCategory LIKE '%{$incCategory}%' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incDateFrom !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incDate >= '$incDateFrom' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = '$loginID' 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incName !== "" && $incState !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incState LIKE '%{$incState}%' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incCategory !== "" && $incState !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incCategory LIKE '%{$incCategory}%' 
                    AND incState LIKE '%{$incState}%' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incState !== "" && $incDateFrom !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incState LIKE '%{$incState}%' 
                    AND incDate <= '$incDateFrom' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incState !== "" && $incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incState LIKE '%{$incState}%' 
                    AND incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
                
            // 1つ入力されている場合
            // 5から1を選択する組み合わせ
            // x = 5! / 1! * (5 - 1)!
            // x = 5 * 4 * 3 * 2 * 1 / 1 * 4 * 3 * 2 * 1
            // x = 120 / 24
            // x = 5
            } elseif ($incName !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incName LIKE '%{$incName}%' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incCategory !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incCategory LIKE '%{$incCategory}%' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incState !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incState LIKE '%{$incState}%' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incDateFrom !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incDate >= '$incDateFrom' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";
            } elseif ($incDateTo !== "") {
                $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incDate <= '$incDateTo' 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    ORDER BY incDate, incomeID ASC";

            }
            
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
