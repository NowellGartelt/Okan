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
 * @var string $loginID ログインID
 * @var string $query_updateIncInfo 収入情報更新クエリ
 * @var string $incName 収入名
 * @var int $income 収入額
 * @var string $incCategory 収入カテゴリ
 * @var DateTime $incDate 収入日
 * @var string $incState 収入一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
 * @var int $id 収入ID
 */

class updateIncByTrans {
    // インスタンス変数の定義
    private $loginID = null;
    private $query_updateIncInfo = null;
    private $incName = null;
    private $income = null;
    private $incCategory = null;
    private $incDate = null;
    private $incState = null;
    private $id = null;
    
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * 収入情報更新クエリ実行関数
     * 
     * 収入情報を受け取り、DBに収入情報を更新するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $incName 収入名
     * @param int $income 収入額
     * @param string $incCategory 収入カテゴリ
     * @param DateTime $incDate 収入日
     * @param string $incState 収入一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
     * @param int $id 収入ID
     * @return array $incomeInfo クエリ実行結果
     */
    public function updateIncByTrans($loginID, $incName, $income, $incCategory, 
            $incDate, $incState, $id){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->incName = $incName;
        $this->income = $income;
        $this->incCategory = $incCategory;
        $this->incDate = $incDate;
        $this->incState = $incState;
        $this->id = $id;

        // 入力された情報で収入情報の更新
        $query_updateIncInfo =
            "UPDATE incomeTable 
            SET incName = '$incName', income = '$income', incCategory = '$incCategory',
            incDate = '$incDate', incState = '$incState' WHERE incomeID = '$id' AND loginID = '$loginID'";
        $result_updateIncInfo = mysqli_query($link, $query_updateIncInfo);
        $incomeInfo = mysqli_fetch_array($result_updateIncInfo);
        
        // DB切断
        mysqli_close($link);
        
        return $incomeInfo;
    }
}
