<?php 
/**
 * 登録済みカテゴリ名(収入)取得クラス
 * 
 * ログインIDに紐付く登録済みの収入カテゴリ名一覧を取得するクラス。
 * 
 * @access publc
 * @category model
 * @name searchIncCategory
 * @method searchIncCategoryName
 * @var int $userID ユーザID
 * @var array $result クエリ実行結果
 */
class searchIncCategoryCount 
{
    // インスタンス変数の定義
    private $model = "";
    private $userID = "";
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
     * カテゴリ数取得クエリ実行関数
     *
     * ログインIDを受け取り、カテゴリ数を取得するクエリを実行する
     *
     * @param int $userID ユーザID
     * @return array IDに紐付く収入カテゴリ数
     */
    public function searchIncCategoryCount(int $userID) 
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($userID == null) {
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
                
                // IDで一致するカテゴリ情報の取得
                $query = "
                    SELECT COUNT(*) FROM incCategoryTable
                    WHERE userID = '$userID'
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
