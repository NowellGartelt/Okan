<?php 
/**
 * 登録済みカテゴリ(支出)取得クラス
 * 
 * ログインIDに紐付く登録済みの支出カテゴリを取得するクラス。
 * 
 * @access publc
 * @category model
 * @name searchPayCategory
 * @method searchPayCategory
 * @var int $userID ユーザID
 * @var array $result クエリ実行結果
 */
class searchPayCategoryCount 
{
    // インスタンス変数の定義
    private $userID = "";
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
     * カテゴリ数取得クエリ実行関数
     * 
     * ログインIDを受け取り、カテゴリ数を取得するクエリを実行する
     * 
     * @access public
     * @param int $userID ユーザID
     * @return array IDに紐付く支出カテゴリ数
     */
    public function searchPayCategoryCount(int $userID) 
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($userID == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // IDで一致するカテゴリ情報の取得
            $query = "
                SELECT COUNT(*) FROM payCategoryTable
                WHERE userID = '$userID'";
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
