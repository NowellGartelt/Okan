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
 * @var string $loginID ログインID
 * @var array $result クエリ実行結果
 */
class searchIncCategory 
{
    // インスタンス変数の定義
    private $loginID = null;
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
     * カテゴリ名一覧取得クエリ実行関数
     *
     * ログインIDを受け取り、カテゴリ名一覧を取得するクエリを実行する
     *
     * @param string $loginID ログインID
     * @return array IDに紐付く収入カテゴリ名一覧
     */
    public function searchIncCategoryName(string $loginID) 
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($loginID == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'model.php';
            $model = new model();
            $link = $model -> getDatabaseCon();
            
            // 戻り値の初期化
            $this->result = array();
            
            // IDで一致するカテゴリ情報の取得
            $query = "
                SELECT personalID, categoryName FROM incCategoryTable
                WHERE loginID = '$loginID' ORDER BY personalID";
            $queryResult = mysqli_query($link, $query);
            
            //連想配列として取得した値を配列変数に格納する
            while ($row = mysqli_fetch_assoc($queryResult)) {
                array_push($this->result, $row);
            }
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;
        
    }    
}
