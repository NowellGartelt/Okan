<?php
/**
 * 支出カテゴリ初期登録クエリ実行クラス
 *
 * 支出カテゴリをDBに初期値で登録する
 * メンバー登録時に使用
 *
 * @author NowellGartelt
 * @access public
 * @package model
 * @name registPayCategory
 */
class registPayCategory {
    private $loginID = null;
    private $registDate = null;
    
    /**
     * コンストラクタ
     *
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * 支出カテゴリ初期登録クエリ実行クラス
     *
     * 支出カテゴリをDBに初期値で登録する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $registDate 登録日
     * @return array $queryResult クエリ実行結果
     */
    public function registPayCategory(string $loginID, string $registDate) {
        $this->loginID = $loginID;
        $this->registDate = $registDate;
        
        // いずれかの値がnullだった場合、nullを返す
        if ($loginID == null || $registDate == null) {
            $queryResult = null;
            
        } else {
            // DB接続情報取得
            include '../model/tools/databaseConnect.php';
            
            // 入力された情報で支出情報の更新
            $query =
                "INSERT INTO payCategoryTable (
                    personalID, categoryName, loginID, registDate, updateDate
                )
                VALUES 
                    ('1', '食費', '$loginID', '$registDate', ''), 
                    ('2', '生活雑貨', '$loginID', '$registDate', ''), 
                    ('3', '飲料費', '$loginID', '$registDate', ''), 
                    ('4', '本', '$loginID', '$registDate', ''), 
                    ('5', '雑貨', '$loginID', '$registDate', ''), 
                    ('6', '', '$loginID', '$registDate', ''), 
                    ('7', '', '$loginID', '$registDate', ''), 
                    ('8', '', '$loginID', '$registDate', ''), 
                    ('9', '', '$loginID', '$registDate', ''), 
                    ('10', '', '$loginID', '$registDate', ''), 
                    ('11', '', '$loginID', '$registDate', ''), 
                    ('12', '', '$loginID', '$registDate', ''), 
                    ('13', '', '$loginID', '$registDate', ''), 
                    ('14', '', '$loginID', '$registDate', ''), 
                    ('15', '', '$loginID', '$registDate', '')
                ";
            $queryResult = mysqli_query($link, $query);
            
            // DB切断
            mysqli_close($link);
        }
        
        return $queryResult;
        
    }
}
