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
 * @var int $id 収入情報ID
 * @var array $result クエリ実行結果
 */
class searchIncByID 
{
    // インスタンス変数の定義
    private $loginID = null;
    private $id = null;
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
     * ログインIDと収入情報IDを受け取り、DBに検索するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param int $id 収入情報ID
     * @return array incomeIDに紐付く収入情報
     */
    public function searchIncByID(string $loginID, int $id)
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        $this->id = $id;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($loginID == null || $id == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'model.php';
            $model = new model();
            $link = $model -> getDatabaseCon();
            
            // IDで一致する収入情報の取得
            $query = "SELECT * FROM incomeTable 
                    LEFT OUTER JOIN incCategoryTable ON incomeTable.incCategory = incCategoryTable.personalID 
                    AND incomeTable.loginID = incCategoryTable.loginID 
                    WHERE incomeID = '$id' 
                    AND incomeTable.loginID = '$loginID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_array($queryResult);
            
            // DB切断
            mysqli_close($link);
        }
        
        return $this->result;

    }
}
