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
 * @var string $loginID ログインID
 * @var string $registDate 登録日
 * @var array $result クエリ実行結果
 */
class registIncCategory 
{
    // インスタンス変数の定義
    private $loginID = null;
    private $registDate = null;
    private $result = null;
    
    /**
     * コンストラクタ
     * 
     * 何もしない
     * 
     * @access public
     */
    public function __construct() 
    {
        
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
    public function registIncCategory(string $loginID, string $registDate) 
    {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        $this->registDate = $registDate;
        
        // いずれかの値がnullだった場合、nullを返す
        if ($loginID == null || $registDate == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'tools/databaseConnect.php';
            
            // 入力された情報で支出情報の更新
            $query =
                "INSERT INTO incCategoryTable (
                    personalID, categoryName, loginID, registDate, updateDate
                )
                VALUES 
                    ('1', '給与', '$loginID', '$registDate', ''), 
                    ('2', '借り入れ', '$loginID', '$registDate', ''), 
                    ('3', '投資', '$loginID', '$registDate', ''), 
                    ('4', 'ギフト券', '$loginID', '$registDate', ''), 
                    ('5', '懸賞', '$loginID', '$registDate', ''), 
                    ('6', '', '$loginID', '$registDate', ''), 
                    ('7', '', '$loginID', '$registDate', ''), 
                    ('8', '', '$loginID', '$registDate', ''), 
                    ('9', '', '$loginID', '$registDate', ''), 
                    ('10', '', '$loginID', '$registDate', '')
                ";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_array($queryResult);
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;
        
    }
}
