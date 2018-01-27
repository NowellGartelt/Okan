<?php
/**
 * 消費税計算処理クラス
 * 
 * 入力された支払い金額を元に、消費税の計算処理の実施する
 * その結果を戻り値として返す
 * 消費税はユーザーごとに設定変更可能
 * 
 * @author NowellGartelt
 * @access public
 * @package controller/tools
 * @name taxCalc

 * @var int $payment 消費税抜きの支払い金額
 * @var int $tax 消費税率
 * 
 * @param int $payment 消費税抜きの支払い金額
 * @param int $tax 消費税率
 * 
 * @return int $payment 計算後の消費税込みの支払い金額
 * 
 */

class taxCalc {
    private $payment = null;
    private $tax = null;
    
    public function taxCalc($payment, $tax) {
        $this->payment = $payment;
        $this->tax = $tax;
        
        $tax = $tax / 100;
        $payment = (int) floor($payment + ($payment * $tax));

        return $payment;
        
    }
}