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
     * 登録済みカテゴリ(収入)取得関数
     * 
     * ログインIDに紐付く登録済みの収入カテゴリを取得するクラス。
     * 
     * @access public
     * @param string $loginID ログインID
     * @param int $maxRegist 取得最大数
     * @return array IDに紐付く収入カテゴリ情報一覧
     */
    public function searchIncCategory(string $loginID) 
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($loginID == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'tools/databaseConnect.php';
            
            // 戻り値の初期化
            $this->result = array();
            
            // IDで一致するカテゴリ情報の取得
            $query = "
                SELECT * FROM incCategoryTable 
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
