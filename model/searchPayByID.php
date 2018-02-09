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
 * @var string $loginID ログインID
 * @var int $id 支出情報ID
 * @var array $result クエリ実行結果
 */
class searchPayByID 
{
    // インスタンス変数の定義
    private $loginID = null;
    private $id = null;
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
     * 支出情報検索クエリ実行関数
     * 
     * ログインIDと支出情報IDを受け取り、DBに検索するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param int $id 支出情報ID
     * @return array paymentIDに紐付く支出情報
     */
    public function searchPayByID(string $loginID, int $id)
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        $this->id = $id;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($loginID == null || $id == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'model.php';
            $model = new model();
            $link = $model -> getDatabaseCon();
            
            // IDで一致する支出情報の取得
            $query = "SELECT * FROM paymentTable 
                    LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                    LEFT OUTER JOIN payCategoryTable ON paymentTable.payCategory = payCategoryTable.personalID 
                    AND paymentTable.loginID = payCategoryTable.loginID 
                    WHERE paymentID = '$id' 
                    AND paymentTable.loginID = '$loginID'";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_array($queryResult);
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;

    }
}
