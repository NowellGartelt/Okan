<?php
/**
 * メンバー情報検索クエリ実行クラス
 * 
 * ログインIDを受け取り、DBにメンバー情報を検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchMemberByMemberID
 * @var int $userID ユーザID
 * @var array $result クエリ実行結果
 */
class searchMemberByMemberID 
{
    // インスタンス変数の定義
    private $userID = "";
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
     * メンバー情報検索クエリ実行関数
     * 
     * ログインIDを受け取り、DBにメンバー情報を検索するクエリを実行する
     * 
     * @access public
     * @param int $userID ユーザID
     * @return array IDに紐付くメンバー情報
     */
    public function searchMemberByMemberID(int $userID)
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        
        // 値がnullだった場合、nullを返す
        if ($userID == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // ログインIDと一致するメンバー情報の取得
            $query = "SELECT * FROM usertable WHERE userID = '$userID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_assoc($queryResult);
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;
        
    }
}
