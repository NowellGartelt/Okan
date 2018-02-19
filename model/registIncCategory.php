<?php
/**
 * 収入カテゴリ初期登録クエリ実行クラス
 * 
 * 収入カテゴリをDBに初期値で登録する
 * メンバー登録時に使用
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name registIncCategory
 * @var object $model モデルクラス共通処理オブジェクト
 * @var int $userID ユーザID
 * @var string $registDate 登録日
 * @var array $result クエリ実行結果
 */
class registIncCategory 
{
    // インスタンス変数の定義
    private $model = "";
    private $userID = "";
    private $registDate = "";
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
     * 収入カテゴリ初期登録クエリ実行クラス
     * 
     * 収入カテゴリをDBに初期値で登録する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $registDate 登録日
     * @return array 挿入クエリ実行結果
     */
    public function registIncCategory(int $userID, string $registDate) 
    {
        // 引き渡された値の取得
        $this->userID = $userID;
        $this->registDate = $registDate;
        
        // いずれかの値がnullだった場合、nullを返す
        if ($userID == null || $registDate == null) {
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
                
                // 事前確認
                $query = "
                    SELECT COUNT(*)
                    FROM incCategoryTable 
                    WHERE userID = '$userID'
                    ";
                $queryResult = mysqli_query($link, $query);
                $result = mysqli_fetch_assoc($queryResult);
                $countBefore = (int) $result['COUNT(*)'];
                
                // 入力された情報で支出情報の更新
                $query = "
                    INSERT INTO incCategoryTable (
                        personalID, categoryName, userID, registDate, updateDate
                    )
                    VALUES 
                        ('1', '給与', '$userID', '$registDate', '$registDate'), 
                        ('2', '借り入れ', '$userID', '$registDate', '$registDate'), 
                        ('3', '投資', '$userID', '$registDate', '$registDate'), 
                        ('4', 'ギフト券', '$userID', '$registDate', '$registDate'), 
                        ('5', '懸賞', '$userID', '$registDate', '$registDate'), 
                        ('6', '', '$userID', '$registDate', '$registDate'), 
                        ('7', '', '$userID', '$registDate', '$registDate'), 
                        ('8', '', '$userID', '$registDate', '$registDate'), 
                        ('9', '', '$userID', '$registDate', '$registDate'), 
                        ('10', '', '$userID', '$registDate', '$registDate')
                    ";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_assoc($queryResult);
                
                // 事後確認
                $query = "
                    SELECT COUNT(*)
                    FROM incCategoryTable 
                    WHERE userID = '$userID'
                    ";
                $queryResult = mysqli_query($link, $query);
                $result = mysqli_fetch_assoc($queryResult);
                $countAfter = (int) $result['COUNT(*)'];
                
                $countDiff = $countAfter - $countBefore;
                
                if ($countDiff == 10) {
                    $this->result = true;
                    
                } else {
                    $this->result = false;
                    
                }
            }
            // DB切断
            mysqli_close($link);
            
        }
        return $this->result;
        
    }
}
