<?php
/**
 * 収入情報検索クエリ実行クラス
 * 
 * ログインIDと収入情報IDを受け取り、DBに検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchIncByID
 * @var string $loginID ログインID
 * @var string $query_getIncInfo 収入情報検索クエリ
 * @var int $id 収入情報ID
 */

class searchIncByID {
    // インスタンス変数の定義
    private $loginID = null;
    private $query_getIncInfo = null;
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
     * 収入情報検索クエリ実行関数
     * 
     * ログインIDと収入情報IDを受け取り、DBに検索するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param int $id 収入情報ID
     * @return array $incomeInfo 収入情報
     */
    public function searchIncByID($loginID, $id){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->id = $id;

        // IDで一致する収入情報の取得
        $query_getIncInfo = "SELECT * FROM incomeTable WHERE incomeID = '$id' AND loginID = '$loginID'";
        $result_getIncInfo = mysqli_query($link, $query_getIncInfo);
        $incomeInfo = mysqli_fetch_array($result_getIncInfo);
        
        // DB切断
        mysqli_close($link);
        
        return $incomeInfo;
    }
}
