<?php
/**
 * メンバー情報登録クエリ実行クラス
 * 
 * メンバー情報を受け取り、DBに登録するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name registMember
 * @var string $loginID ログインID
 * @var string $passward パスワード
 * @var string $name ユーザ名
 * @var string $registDate 登録日
 * @var boolean $isAdmin 管理者判定
 * @var string $question 秘密の質問
 * @var string $answer 秘密の質問の答え
 * @var int $defTax デフォルト税率
 * @var array $result クエリ実行結果
 */
class registMember 
{
    // インスタンス変数の定義
    private $loginID = null;
    private $password = null;
    private $name = null;
    private $registDate = null;
    private $isAdmin = null;
    private $question = null;
    private $answer = null;
    private $defTax = null;
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
     * メンバー情報登録クエリ実行関数
     * 
     * メンバー情報を受け取り、DBに登録するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $passward パスワード
     * @param string $name ユーザー名
     * @param string $registDate 登録日
     * @param boolean $isAdmin 管理者判定
     * @param string $question 秘密の質問
     * @param string $answer 秘密の質問の答え
     * @param int $defTax デフォルト税率
     * @return array 挿入クエリ実行結果
     */
    public function registMember(string $loginID, string $password, string $name, string $registDate, 
            bool $isAdmin, string $question, string $answer, int $defTax) 
    {
        // 引き渡された値の受け取り
        $this->loginID = $loginID;
        $this->password = $password;
        $this->name = $name;
        $this->registDate = $registDate;
        $this->isAdmin = $isAdmin;
        $this->question = $question;
        $this->answer = $answer;
        $this->defTax = $defTax;
        
        // いずれかの値がnullだった場合、nullを返す
        if ($loginID == null || $password == null || $name == null 
                || $registDate == null || $question == null || $answer == null
                || $defTax == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'model.php';
            $model = new model();
            $link = $model -> getDatabaseCon();
            
            // メンバー情報の登録
            $query =
                "INSERT INTO usertable (
                loginID, loginPassword, name, addDate, updateDate, isAdmin, question, answer, defTax)
                VALUES (
                '$loginID', '$password', '$name', '$registDate', null, '$isAdmin', '$question', '$answer', '$defTax')";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_array($queryResult);

            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;
        
    }
}
