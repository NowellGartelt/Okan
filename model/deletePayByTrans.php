<?php
/**
 * 支出情報削除クエリ実行クラス
 * 
 * 支出情報を削除するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name deletePayByTrans
 * @var int $userID ユーザID
 * @var int $id 支出情報ID
 * @var array $result クエリ実行結果
 */
class deletePayByTrans 
{
    // インスタンス変数の定義
    private $userID = "";
    private $id = "";
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
     * 支出情報削除クエリ実行関数
     * 
     * ログインIDと収入情報IDを受け取り、対象の支出情報を削除するクエリを実行する
     * 
     * @access public
     * @param string $userID ユーザID
     * @param int $id 支出情報ID
     * @return array 削除クエリ実行結果
     */
    public function deletePayByTrans(int $userID, int $id)
    {
        // 引き渡された値の受け取り
        $this->userID = $userID;
        $this->id = $id;
        
        // いずれかの値がnullだった場合、nullを返す
        if ($userID == null || $id == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // 支出情報の削除
            $query = "DELETE FROM paymentTable WHERE paymentID = '$id' AND userID = '$userID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_assoc($queryResult);
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;
        
    }
}
