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
        // DB接続情報
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;

        if ($loginID == null) {
            $result = null;
            
        } else {
            // ログインIDと一致するメンバー情報の取得
            $query = "SELECT * FROM usertable WHERE loginID = '$loginID'";
            $result = mysqli_query($link, $query);
            $result = mysqli_fetch_array($result);
            
        }
        
        // DB切断
        mysqli_close($link);
        
        return $result;
    }
}
