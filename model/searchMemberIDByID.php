<?php
/**
 * メンバー情報検索クエリ実行クラス
 * 
 * ログインIDを受け取り、DBにメンバー情報を検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchMemberIDByID
 * @var string $loginID ログインID
 * @var array $result クエリ実行結果
 */
class searchMemberIDByID 
{
    // インスタンス変数の定義
    private $loginID = null;
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
     * ユーザID取得クエリ実行関数
     * 
     * ログインIDを受け取り、ユーザIDを取得するクエリを実行する
     * ユーザIDは各メンバーに割り当てられた一意で変更不可能なID
     * 
     * @param string $loginID
     * @return array
     */
    public function searchMemberIDByID(string $loginID) 
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        
        // 値がnullだった場合、nullを返す
        if ($loginID == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'tools/databaseConnect.php';
            
            // ログインIDと一致するメンバー情報の取得
            $query = "SELECT userID, loginID FROM usertable WHERE loginID = '$loginID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_array($queryResult);
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;
        
    }
}
