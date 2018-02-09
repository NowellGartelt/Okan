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
 * @var string $loginID ログインID
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
    private $loginID = null;
    private $incName = null;
    private $income = null;
    private $incCategory = null;
    private $incState = null;
    private $incDate = null;
    private $registDate = null;
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
     * 収入情報登録クエリ実行関数
     * 
     * 収入情報を受け取り、DBに登録するクエリを実行する
     * 
     * @param string $loginID ログインID
     * @param string $incName 収入情報名
     * @param int $income 収入金額
     * @param string $incCategory 収入カテゴリ
     * @param string $incState 収入情報一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
     * @param string $incDate 収入日
     * @param string $registDate 収入情報登録日
     * @return array 挿入クエリ実行結果
     */
    public function registIncByTrans(string $loginID, string $incName, int $income, string $incCategory, 
            string $incState, string $incDate, string $registDate)
    {
        // 引き渡された値の受け取り
        $this->loginID = $loginID;
        $this->incName = $incName;
        $this->income = $income;
        $this->incCategory = $incCategory;
        $this->incState = $incState;
        $this->incDate = $incDate;
        $this->registDate = $registDate;
        
        // 必須の値がnullだった場合、nullを返す
        if ($loginID == null || $income == null || $incDate == null || $registDate == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'model.php';
            $model = new model();
            $link = $model -> getDatabaseCon();
            
            // 収入情報の登録
            $query =
                "INSERT INTO incomeTable (
                incName, income, incCategory, incState, incDate, registDate, updateDate, loginID)
                VALUES (
                '$incName', '$income', '$incCategory', '$incState', '$incDate', '$registDate', null, '$loginID')";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_array($queryResult);
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;
        
    }
}
