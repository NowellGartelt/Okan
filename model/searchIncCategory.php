<?php 
/**
 * 登録済みカテゴリ(収入)取得クラス
 * 
 * ログインIDに紐付く登録済みの収入カテゴリを取得するクラス。
 * 
 * @access publc
 * @category model
 * @name searchIncCategory
 * @method searchIncCategory
 * @var int $userID ユーザID
 * @var array $result クエリ実行結果
 */
class searchIncCategory 
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
     * 登録済みカテゴリ(収入)取得関数
     * 
     * ログインIDに紐付く登録済みの収入カテゴリを取得するクラス。
     * 
     * @access public
     * @param int $userID ユーザID
     * @param int $maxRegist 取得最大数
     * @return array IDに紐付く収入カテゴリ情報一覧
     */
    public function searchIncCategory(int $userID) 
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($userID == "") {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // DB接続に失敗したとき
            if ($link == false) {
                $DBConnect = "failed";
                $this->model -> setDBConnectResult($DBConnect);
                $this->result = null;
                
                
            } else {
                $DBConnect = "success";
                $this->model -> setDBConnectResult($DBConnect);
                
                // IDで一致するカテゴリ情報の取得
                $query = "
                    SELECT * FROM incCategoryTable 
                    WHERE userID = '$userID' ORDER BY personalID
                    ";
                $queryResult = mysqli_query($link, $query);
            
                // 連想配列として取得した値を配列変数に格納する
                while ($row = mysqli_fetch_assoc($queryResult)) {
                    array_push($this->result, $row);
                    
                }
            }
            // DB切断
            mysqli_close($link);
            
        }

        return $this->result;

    }
}
