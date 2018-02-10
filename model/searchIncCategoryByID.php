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
 * @var int $userID ユーザID
 * @var int $personalID 個人用カテゴリID
 * @var array $result クエリ実行結果
 */
class searchIncCategoryByID 
{
    // インスタンス変数の定義
    private $userID = "";
    private $personalID = "";
    private $result = array();
    
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
        if ($userID == null || $personalID == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // IDで一致する収入情報の取得
            $query = "
                SELECT * FROM incCategoryTable 
                WHERE userID = '$userID' AND personalID = '$personalID'";
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
