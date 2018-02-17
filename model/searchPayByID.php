<?php
/**
 * 支出情報検索クエリ実行クラス
 * 
 * ログインIDと支出情報IDを受け取り、DBに検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchPayByID
 * @var int $userID ユーザID
 * @var int $id 支出情報ID
 * @var array $result クエリ実行結果
 */
class searchPayByID 
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
     * 支出情報検索クエリ実行関数
     * 
     * ログインIDと支出情報IDを受け取り、DBに検索するクエリを実行する
     * 
     * @access public
     * @param int $userID ユーザID
     * @param int $id 支出情報ID
     * @return array paymentIDに紐付く支出情報
     */
    public function searchPayByID(int $userID, int $id)
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        $this->id = $id;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($userID == "" || $id == "") {
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
                
                // IDで一致する支出情報の取得
                $query = "
                        SELECT * FROM paymentTable 
                        LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                        LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                        AND paymentTable.userID = payCategoryTable.userID 
                        WHERE paymentID = '$id' 
                        AND paymentTable.userID = '$userID'
                        ";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_assoc($queryResult);
                
            }
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;

    }
}
