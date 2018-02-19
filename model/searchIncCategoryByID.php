<?php 
/**
 * 登録済みカテゴリ(収入)取得クラス
 * 
 * 個人カテゴリIDに紐付く登録済みの収入カテゴリを取得する。
 * 
 * @access publc
 * @category model
 * @name searchIncCategoryByID
 * @method searchIncCategoryByID
 * @var object $model モデルクラス共通処理オブジェクト
 * @var int $userID ユーザID
 * @var int $personalID 個人用カテゴリID
 * @var array $result クエリ実行結果
 */
class searchIncCategoryByID 
{
    // インスタンス変数の定義
    private $model = "";
    private $userID = "";
    private $personalID = "";
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
     * 登録済みカテゴリ(収入)取得関数
     * 
     * ログインIDと個人カテゴリIDを受け取り、DBに登録済みの収入カテゴリを取得するクエリを実行する。
     * 
     * @access public
     * @param int $userID ユーザID
     * @param int $personalID 個人用カテゴリID
     * @return array IDと個人カテゴリIDに紐付くカテゴリ情報
     */
    public function searchIncCategoryByID(int $userID, int $personalID) 
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        $this->personalID = $personalID;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($userID == "" || $personalID == "") {
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
                
                // IDで一致する収入情報の取得
                $query = "
                    SELECT * FROM incCategoryTable 
                    WHERE userID = '$userID' AND personalID = '$personalID'
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
