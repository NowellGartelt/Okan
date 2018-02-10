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
 * @var int $userID ユーザID
 * @var int $id 収入情報ID
 * @var array $result クエリ実行結果
 */
class searchIncByID 
{
    // インスタンス変数の定義
    private $userID = "";
    private $id = "";
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
     * ログインIDと収入情報IDを受け取り、DBに検索するクエリを実行する
     * 
     * @access public
     * @param string $userID ログインID
     * @param int $id 収入情報ID
     * @return array incomeIDに紐付く収入情報
     */
    public function searchIncByID(int $userID, int $id)
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        $this->id = $id;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($userID == null || $id == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // IDで一致する収入情報の取得
            $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.userID = incCategoryTable.userID 
                    WHERE incomeID = '$id' 
                    AND incomeTable.userID = '$userID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_assoc($queryResult);
            
            // DB切断
            mysqli_close($link);
        }
        
        return $this->result;

    }
}
