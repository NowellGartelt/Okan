<?php
/**
 * メンバー情報検索クエリ実行クラス
 * 
 * ログインIDを受け取り、DBにメンバー情報を検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchMemberByID
 * @var string $loginID ログインID
 */

class searchMemberByID {
    // インスタンス変数の定義
    private $loginID = null;
    private $result = null;
 
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * メンバー情報検索クエリ実行関数
     * 
     * ログインIDを受け取り、DBにメンバー情報を検索するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @return array $result メンバー情報
     */
    public function searchMemberByID($loginID){
        // 引き渡された値の取得
        $this->loginID = $loginID;
        
        // 値がnullだった場合、nullを返す
        if ($loginID == null) {
            $this->result = null;
            
        } else {
            // DB接続情報
            include '../model/tools/databaseConnect.php';
            
            // ログインIDと一致するメンバー情報の取得
            $query = "SELECT * FROM usertable WHERE loginID = '$loginID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_array($queryResult);
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;
        
    }
    
    public function searchMemberIDByID($loginID) {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        
        // 値がnullだった場合、nullを返す
        if ($loginID == null) {
            $this->result = null;
            
        } else {
            // DB接続情報
            include '../model/tools/databaseConnect.php';
            
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
