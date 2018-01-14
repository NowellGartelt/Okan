<?php
/**
 * 消費税計算処理クラス
 * 
 * 入力された支払い金額を元に、消費税の計算処理の実施する
 * その結果を戻り値として返す
 * 消費税はユーザーごとに設定変更可能
 * 
 * @access public
 * @package controller/tools
 * @name taxCalc
 * @var int $payment
 * @param int $payment
 * @return int $payment
 */

class taxCalc {
    private $payment;
    
    public function taxCalc($payment) {
        $this->payment = $payment;
        $tax = 0.08;
        $payment = (int) floor($payment + ($payment * $tax));
        return $payment;
        
    }
}