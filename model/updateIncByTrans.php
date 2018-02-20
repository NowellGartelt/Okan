<?php
/**
 * 収入情報更新クエリ実行クラス
 * 
 * 収入情報を受け取り、DBに収入情報を更新するクエリを実行する
 * 
 * @author Nowellgartelt
 * @access public
 * @package model
 * @name updateIncByTrans
 * @var object $model モデルクラス共通処理オブジェクト
 * @var int $userID ユーザID
 * @var string $incName 収入名
 * @var int $income 収入額
 * @var string $incCategory 収入カテゴリ
 * @var string $incDate 収入日
 * @var string $incState 収入一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
 * @var int $id 収入ID
 * @var string $updateDate 更新日時
 * @var array $result クエリ実行結果
 */
class updateIncByTrans 
{
    // インスタンス変数の定義
    private $model = "";
    private $userID = "";
    private $incName = "";
    private $income = "";
    private $incCategory = "";
    private $incDate = "";
    private $incState = "";
    private $id = "";
    private $updateDate = "";
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
     * 収入情報更新クエリ実行関数
     * 
     * 収入情報を受け取り、DBに収入情報を更新するクエリを実行する
     * 
     * @access public
     * @param int $userID ユーザID
     * @param string $incName 収入名
     * @param int $income 収入額
     * @param string $incCategory 収入カテゴリ
     * @param string $incDate 収入日
     * @param string $incState 収入一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
     * @param int $id 収入ID
     * @param DateTime $updateDate 更新日時
     * @return array 更新クエリ実行結果
     */
    public function updateIncByTrans(int $userID, string $incName, int $income, 
            int $incCategory, string $incDate, string $incState, int $id, 
            string $updateDate)
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        $this->incName = $incName;
        $this->income = $income;
        $this->incCategory = $incCategory;
        $this->incDate = $incDate;
        $this->incState = $incState;
        $this->id = $id;
        $this->updateDate = $updateDate;
        
        // 必須の値が空だった場合、nullを返す
        if ($userID == null || $income == null || $incDate == null || $id == null || $updateDate == null) {
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
                
                // 入力された情報で収入情報の更新
                $query = "
                    UPDATE incomeTable 
                    SET incName = '$incName', income = '$income', incCategory = '$incCategory',
                    incDate = '$incDate', incState = '$incState', updateDate = '$updateDate' 
                    WHERE incomeID = '$id' AND userID = '$userID'
                    ";
                $queryResult = mysqli_query($link, $query);
                
            }
            // DB切断
            mysqli_close($link);
        
        }
        return $this->result;
        
    }
}
