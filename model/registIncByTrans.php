<?php
/**
 * 収入情報登録クエリ実行クラス
 * 
 * 収入情報を受け取り、DBに登録するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name registIncByTrans
 * @var int $userID ユーザID
 * @var string $incName 収入情報名
 * @var int $income 収入金額
 * @var string $incCategory 収入カテゴリ
 * @var string $incState 収入情報一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
 * @var string $incDate 収入日
 * @var string $registDate 収入情報登録日
 * @var array $result クエリ実行結果
 */
class registIncByTrans 
{
    // インスタンス変数の定義
    private $model = "";
    private $userID = "";
    private $incName = "";
    private $income = "";
    private $incCategory = "";
    private $incState = "";
    private $incDate = "";
    private $registDate = "";
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
     * 収入情報登録クエリ実行関数
     * 
     * 収入情報を受け取り、DBに登録するクエリを実行する
     * 
     * @param int $userID ユーザID
     * @param string $incName 収入情報名
     * @param int $income 収入金額
     * @param string $incCategory 収入カテゴリ
     * @param string $incState 収入情報一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
     * @param string $incDate 収入日
     * @param string $registDate 収入情報登録日
     * @return array 挿入クエリ実行結果
     */
    public function registIncByTrans(int $userID, string $incName, int $income, string $incCategory, 
            string $incState, string $incDate, string $registDate)
    {
        // 引き渡された値の受け取り
        $this->userID = $userID;
        $this->incName = $incName;
        $this->income = $income;
        $this->incCategory = $incCategory;
        $this->incState = $incState;
        $this->incDate = $incDate;
        $this->registDate = $registDate;
        
        // 必須の値がnullだった場合、nullを返す
        if ($userID == "" || $income == "" || $incDate == "" || $registDate == "") {
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
                
                // 事前確認
                $query = "
                    SELECT COUNT(*) 
                    FROM incomeTable
                    WHERE userID = '$userID'
                    ";
                $queryResult = mysqli_query($link, $query);
                $result = mysqli_fetch_assoc($queryResult);
                $countBefore = (int) $result['COUNT(*)'];
                
                // 収入情報の登録
                $query =
                    "INSERT INTO incomeTable (
                    incName, income, incCategory, incState, incDate, registDate, updateDate, userID)
                    VALUES (
                    '$incName', '$income', '$incCategory', '$incState', '$incDate', '$registDate', '$registDate', '$userID')";
                $queryResult = mysqli_query($link, $query);
                $result = mysqli_fetch_assoc($queryResult);
                
                // 事後確認
                $query = "
                    SELECT COUNT(*)
                    FROM incomeTable
                    WHERE userID = '$userID'
                    ";
                $queryResult = mysqli_query($link, $query);
                $result = mysqli_fetch_assoc($queryResult);
                $countAfter = (int) $result['COUNT(*)'];
                
                $countDiff = $countAfter - $countBefore;
                
                if ($countDiff == 1) {
                    $this->result = true;
                    
                } else {
                    $this->result = false;
                    
                }
            }
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;
        
    }
}
