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
 * @var string $query_getPayInfo 支出情報検索クエリ
 * @var int $id 支出情報ID
 */

class searchPayByID {
    // インスタンス変数の定義
    private $loginID = null;
    private $query_getPayInfo = null;
    private $id = null;
    private $paymentInfo = array();
  
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * 支出情報検索クエリ実行関数
     * 
     * ログインIDと支出情報IDを受け取り、DBに検索するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param int $id 支出情報ID
     * @return array $paymentInfo 支出情報
     */
    public function searchPayByID($loginID, $id){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $this->loginID = $loginID;
        $this->id = $id;

        // IDで一致する支出情報の取得
        $query_getPayInfo = "SELECT * FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE paymentID = '$id' AND loginID = '$loginID'";
        $result_getPayInfo = mysqli_query($link, $query_getPayInfo);
        $this->paymentInfo = mysqli_fetch_array($result_getPayInfo);
        
        // DB切断
        mysqli_close($link);
        
        return $this->paymentInfo;
    }
}
