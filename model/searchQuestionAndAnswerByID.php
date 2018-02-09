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
 * @var array $result クエリ実行結果
 */
class searchQuestionAndAnswerByID 
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
     * 秘密の質問・回答取得クエリ実行関数
     * 
     * ログインIDを受け取り、DBに検索するクエリを実行し、秘密の質問と回答を検索する
     * 
     * @access public
     * @param string $loginID ログインID
     * @return array ログインIDに紐付く秘密の質問、回答
     */
    public function searchQuestionAndAnswerByID(string $loginID)
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        
        if ($loginID == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'tools/databaseConnect.php';
            
            // メンバー情報に設定された秘密の質問と答えの取得
            $query = "SELECT question, answer FROM usertable WHERE loginID = '$loginID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_array($queryResult);
            
            // DB切断
            mysqli_close($link);
        
        }
        
        return $this->result;
        
    }
}
