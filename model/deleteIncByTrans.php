<?php
/**
 * 収入情報削除クエリ実行クラス
 * 
 * 収入情報を削除するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name deleteIncByTrans
 * @var string $loginID ログインID
 * @var string $query_registIncInfo 削除クエリ
 * @var int $id 収入情報ID
 */

class deleteIncByTrans {
    // インスタンス変数の定義
    private $loginID = null;
    private $query_registIncInfo = null;
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
     * 収入情報削除クエリ実行関数
     * 
     * ログインIDと収入情報IDを受け取り、対象の収入情報を削除するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param int $id 収入情報ID
     * @return array $incomeInfo クエリ実行結果
     */
    public function deleteIncByTrans($loginID, $id){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;
        $this->id = $id;

        // 収入情報の削除
        $query_deleteIncInfo = "DELETE FROM incomeTable WHERE incomeID = '$id' AND loginID = '$loginID'";
        $result_deleteIncInfo = mysqli_query($link, $query_deleteIncInfo);
        $incomeInfo = mysqli_fetch_array($result_deleteIncInfo);
        
        // DB切断
        mysqli_close($link);
        
        return $incomeInfo;
    }
}
