<?php
/**
 * 消費税計算処理クラス
 * 
 * 消費税込の金額を計算する
 * 
 * @author NowellGartelt
 * @access public
 * @package controller/tools
 * @name taxCalc
 * @var int $payment 消費税抜きの支払い金額
 * @var int $tax 消費税率
 */
class taxCalc {
    // インスタンス変数の定義
    private $payment = null;
    private $tax = null;
    
    /**
     * コンストラクタ
     * 何もしない
     * 
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * 消費税計算関数
     * 
     * 支払い金額と税率を受け取り、消費税込の金額の計算処理、結果を返す
     * 
     * @access public
     * @param int $payment 消費税抜きの支払い金額
     * @param int $tax 消費税率
     * @return int 消費税計算後の消費税込みの支払い金額
     */
    public function taxCalc($payment, $tax) {
        $this->payment = $payment;
        $this->tax = $tax;
        
        $tax = $tax / 100;
        $payment = (int) floor($payment + ($payment * $tax));

        return $payment;
        
    }
}
