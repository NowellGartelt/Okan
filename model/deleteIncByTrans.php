<?php
/**
 * 収入情報削除クエリ実行クラス
 * 
 * 収入情報を削除するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name deleteIncByTrans
 * @var string $loginID ログインID
 * @var int $id 収入情報ID
 * @var array $result クエリ実行結果
 */
class deleteIncByTrans extends model
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
     * 収入情報削除クエリ実行関数
     * 
     * ログインIDと収入情報IDを受け取り、対象の収入情報を削除するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param int $id 収入情報ID
     * @return array 削除クエリ実行結果
     */
    public function deleteIncByTrans(string $loginID, int $id)
    {
        // 引き渡された値の受け取り
        $this->loginID = $loginID;
        $this->id = $id;
        
        // いずれかの値がnullだった場合、nullを返す
        if ($loginID == null || $id == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'tools/databaseConnect.php';
            
            // 収入情報の削除
            $query = "DELETE FROM incomeTable WHERE incomeID = '$id' AND loginID = '$loginID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_array($queryResult);
            
            // DB切断
            mysqli_close($link);
        
        }
        
        return $this->result;
        
    }
}
