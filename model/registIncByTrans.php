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
 * @var string $query_registIncInfo 収入情報登録クエリ
 * @var string $incName 収入情報名
 * @var int $income 収入金額
 * @var string $incCategory 収入カテゴリ
 * @var string $incState 収入情報一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
 * @var DateTime $incDate 収入日
 * @var DateTime $registDate 収入情報登録日
 */

class registIncByTrans {
    // インスタンス変数の定義
    private $loginID = null;
    private $query_registIncInfo = null;
    private $incName = null;
    private $income = null;
    private $incCategory = null;
    private $incState = null;
    private $incDate = null;
    private $registDate = null;
    
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
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
     * @param DateTime $incDate 収入日
     * @param DateTime $registDate 収入情報登録日
     * @return array incomeInfo クエリ実行結果
     */
    public function registIncByTrans($loginID, $incName, $income, $incCategory, 
            $incState, $incDate, $registDate){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->incName = $incName;
        $this->income = $Income;
        $this->incCategory = $incCategory;
        $this->incDate = $incDate;
        $this->incState = $incState;
        $this->id = $id;
        
        // 収入情報の登録
        $query_registInc =
            "INSERT INTO incomeTable (
            incName, income, incCategory, incState, incDate, registDate, updateDate, loginID)
            VALUES (
            '$incName', '$income', '$incCategory', '$incState', '$incDate', '$registDate', null, '$loginID')";
        $result_registIncInfo = mysqli_query($link, $query_registInc);
        $incomeInfo = mysqli_fetch_array($result_registIncInfo);
        
        // DB切断
        mysqli_close($link);
        
        return $incomeInfo;
    }
}
