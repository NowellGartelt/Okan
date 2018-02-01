<?php
/**
 * 秘密の質問・回答取得クエリ実行クラス
 * 
 * ログインIDを受け取り、DBに検索するクエリを実行し、秘密の質問と回答を検索する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchQuestionAndAnswerByID
 * @var string $loginID ログインID
 */

class searchQuestionAndAnswerByID {
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
     * 秘密の質問・回答取得クエリ実行関数
     * 
     * ログインIDを受け取り、DBに検索するクエリを実行し、秘密の質問と回答を検索する
     * 
     * @access public
     * @param string $loginID ログインID
     * @return array $result 秘密の質問、回答
     */
    public function searchQuestionAndAnswerByID($loginID){
        // DB接続情報
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;
        
        // メンバー情報に設定された秘密の質問と答えの取得
        $query = "SELECT question, answer FROM usertable WHERE loginID = '$loginID'";
        $result = mysqli_query($link, $query);
        $result = mysqli_fetch_array($result);
        
        // DB切断
        mysqli_close($link);
        
        return $result;
    }
}
