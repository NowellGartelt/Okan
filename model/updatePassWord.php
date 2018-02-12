<?php
/**
 * パスワード更新クエリ実行クラス
 * 
 * ログインIDと更新後パスワードを受け取り、DBにパスワード更新のクエリを実行する
 * 
 * @author user
 * @access public
 * @package model
 * @name updatePassWord
 * @var string $loginID ログインID
 * @var string $password パスワード
 * @var string $updateDate 更新日時
 * @var array $result クエリ実行結果
 */
class updatePassWord 
{
    // インスタンス変数の定義
    private $loginID = "";
    private $password = "";
    private $updateDate = "";
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
     * パスワード更新クエリ実行関数
     * 
     * ログインIDと更新後パスワードを受け取り、DBにパスワード更新のクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $password パスワード
     * @param string $updateDate 更新日時
     * @return array 更新クエリ実行結果
     */
    public function updatePassWord(string $loginID, string $password, string $updateDate)
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        $this->password = $password;
        $this->updateDate = $updateDate;
        
        // すべてnullだった場合はnullを返して何もしない
        if ($loginID == null && $password == null || $updateDate == null) {
            return $this->result;
                    
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // IDを元にパスワードの更新
            $query = 
                "UPDATE usertable
                SET loginPassword = '$password', 
                updateDate = '$updateDate'
                WHERE loginID = '$loginID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_assoc($queryResult);
            
            // DB切断
            mysqli_close($link);
            
        }

        return $this->result;
        
    }
}
