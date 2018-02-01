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
 * @var string $loginID ログインID
 * @var string $query_registPayInfo 削除クエリ
 * @var int $id 支出情報ID
 */

class deletePayByTrans {
    // インスタンス変数の定義
    private $loginID = null;
    private $query_registPayInfo = null;
    private $id = null;
    
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * 支出情報削除クエリ実行関数
     * 
     * ログインIDと収入情報IDを受け取り、対象の支出情報を削除するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param int $id 支出情報ID
     * @return array $paymentInfo クエリ実行結果
     */
    public function deletePayByTrans($loginID, $id){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;
        $this->id = $id;

        // 支出情報の削除
        $query_deletePayInfo = "DELETE FROM paymentTable WHERE paymentID = '$id' AND loginID = '$loginID'";
        $result_deletePayInfo = mysqli_query($link, $query_deletePayInfo);
        $paymentInfo = mysqli_fetch_array($result_deletePayInfo);
        
        // DB切断
        mysqli_close($link);
        
        return $paymentInfo;
    }
}
