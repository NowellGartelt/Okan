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
 * @var object $model モデルクラス共通処理オブジェクト
 * @var int $userID ユーザID
 * @var int $id 支出情報ID
 * @var array $result クエリ実行結果
 */
class deletePayByTrans 
{
    // インスタンス変数の定義
    private $model = "";
    private $userID = "";
    private $id = "";
    private $result = array();
    
    /**
     * コンストラクタ
     *
     * @access public
     */
    public function __construct() 
    {
        // モデルの共通処理取得
        require_once 'model.php';
        $this->model = new model();
        
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
            
            // DB接続に失敗した場合
            if ($link == false) {
                $DBConnect = "failed";
                $this->model -> setDBConnectResult($DBConnect);
                $this->result = null;
                
            } else {
                $DBConnect = "success";
                $this->model -> setDBConnectResult($DBConnect);
                
                // 事前確認
                $query = "
                    SELECT COUNT(*)
                    FROM paymentTable
                    WHERE userID = '$userID'
                    ";
                $queryResult = mysqli_query($link, $query);
                $result = mysqli_fetch_assoc($queryResult);
                $countBefore = (int) $result['COUNT(*)'];
                
                // 支出情報の削除
                $query = "
                    DELETE FROM paymentTable 
                    WHERE paymentID = '$id' AND userID = '$userID'
                    ";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_assoc($queryResult);
                
                // 事後確認
                $query = "
                    SELECT COUNT(*)
                    FROM paymentTable
                    WHERE userID = '$userID'
                    ";
                $queryResult = mysqli_query($link, $query);
                $result = mysqli_fetch_assoc($queryResult);
                $countAfter = (int) $result['COUNT(*)'];
                
                $countDiff = $countAfter - $countBefore;
                
                if ($countDiff == -1) {
                    $this->result = true;
                    
                } else {
                    $this->result = false;
                    
                }
            }
            // DB切断
            mysqli_close($link);
            
        }
        return $this->result;
        
    }
}
