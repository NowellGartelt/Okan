<!-- model/searchPaymentByDay.php -->
<?php
// session_start();

class searchPaymentByDay {
 private $query_referencePay = '';
 private $payName = '';
 private $payCategory = '';
 private $payDateFrom = '';
 private $payDateTo = '';
 private $choiceKey = '';
 
 private $query_refPay = '';
 
 public function searchPaymentByDay($payName, $payCategory, $payDateFrom, $payDateTo, $choiceKey){
  // DB接続情報取得
  include '../model/tools/databaseConnect.php';
  
  $this->payName = $payName;
  $this->payCategory = $payCategory;
  $this->payDateFrom = $payDateFrom;
  $this->payDateTo = $payDateTo;
  $this->choiceKey = $choiceKey;
  
  if ($choiceKey == "payName") {
   $query_refPay = "SELECT payDate, SUM(payment) FROM paymenttable 
   WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom' 
   AND payDate <= '$payDateTo' GROUP BY payDate";
   
  } elseif ($choiceKey == "payCategory") {
   $query_refPay = "SELECT payDate, SUM(payment) FROM paymenttable 
   WHERE payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' 
   AND payDate <= '$payDateTo' GROUP BY payDate";
   
  } else {
   $query_refPay = "SELECT payDate, SUM(payment) FROM paymenttable
   WHERE payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
   GROUP BY payDate";
  	
  }

  $result_refPay = mysqli_query($link, $query_refPay);
  $result_list = array();

  while ($row = mysqli_fetch_assoc($result_refPay)) {
  	array_push($result_list, $row);
  }
  
  return $result_list;
 }
}
?>