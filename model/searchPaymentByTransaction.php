<!-- model/searchPaymentByTransaction.php -->
<?php
// session_start();

class searchPaymentByTransaction {
 private $query_referencePay = '';
 private $payName = '';
 private $payCategory = '';
 private $payState = '';
 private $payDateFrom = '';
 private $payDateTo = '';

 public function searchPaymentByTransaction($payName, $payCategory, $payState, $payDateFrom, $payDateTo){
	// DB接続情報取得
  include '../model/tools/databaseConnect.php';  
 
  $this->payName = $payName;
  $this->payCategory = $payCategory;
  $this->payState = $payState;
  $this->payDateFrom = $payDateFrom;
  $this->payDateTo = $payDateTo;

  /*
  if ($sortBy == "none") {
  // まとめ方で「まとめない」を選択した場合
  */
 
  // 5つすべて入力されている場合
  // 5から5を選択する組み合わせ
  // x = 5! / 5! * (5 - 5)!
  // x = 5 * 4 * 3 * 2 * 1 / 5 * 4 * 3 * 2 * 1 * 1
  // x = 120 /120
  // x = 1
  if($payName !== ""  && $payCategory !== "" && $payState !=="" && $payDateFrom !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' AND payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  
  // 4つ入力されている場合
  // 5から4を選択する組み合わせ
  // x = 5! / 4! * (5 - 4)!
  // x = 5 * 4 * 3 * 2 * 1 / 4 * 3 * 2 * 1 * 1
  // x = 120 / 24
  // x = 5
  } elseif($payName !== ""  && $payCategory !== "" && $payDateFrom !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  } elseif($payName !== ""  && $payState !== "" && $payDateFrom !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  } elseif($payCategory !== "" && $payState !== "" && $payDateFrom !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  } elseif($payName !== ""  && $payCategory !== "" && $payState !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  } elseif($payName !== ""  && $payCategory !== "" && $payDateFrom !== "" && $payState !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payState LIKE '%{$payState}%' ORDER BY payDate ASC";
 
  // 3つ入力されている場合
  // 5から3を選択する組み合わせ
  // x = 5! / 3! * (5 - 3)!
  // x = 5 * 4 * 3 * 2 * 1 / 3 * 2 * 1 * 2 * 1
  // x = 120 / 12
  // x = 10
  } elseif($payName !== "" && $payCategory !== "" && $payState !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' ORDER BY payDate ASC";
  } elseif($payName !== "" && $payCategory !== "" && $payDateFrom !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateFrom' ORDER BY payDate ASC";
  } elseif($payName !== "" && $payState !== "" && $payDateFrom !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateFrom' ORDER BY payDate ASC";
  } elseif($payCategory !== "" && $payState !== "" && $payDateFrom !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateFrom' ORDER BY payDate ASC";
  } elseif($payName !== "" && $payCategory !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  } elseif($payName !== "" && $payState !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  } elseif($payCategory !== "" && $payState !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  } elseif($payName !== "" && $payDateFrom !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  } elseif($payCategory !== "" && $payDateFrom !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  } elseif($payState !== "" && $payDateFrom !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payState LIKE '%{$payState}%' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
 
  // 2つ入力されている場合
  // 5から2を選択する組み合わせ
  // x = 5! / 2! * (5 - 2)!
  // x = 5 * 4 * 3 * 2 * 1 / 2 * 1 * 3 * 2 * 1
  // x = 120 / 12
  // x = 10
  } elseif($payName !== "" && $payCategory !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payCategory LIKE '%{$payCategory}%' ORDER BY payDate ASC";
  } elseif($payName !== "" && $payDateFrom !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom' ORDER BY payDate ASC";
  } elseif($payName !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  } elseif($payCategory !== "" && $payDateFrom !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateFrom' ORDER BY payDate ASC";
  } elseif($payCategory !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  } elseif($payDateFrom !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payDate >= '$payDateFrom' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  } elseif($payName !== "" && $payState !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' AND payState LIKE '%{$payState}%' ORDER BY payDate ASC";
  } elseif($payCategory !== "" && $payState !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' AND payState LIKE '%{$payState}%' ORDER BY payDate ASC";
  } elseif($payState !== "" && $payDateFrom !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payState LIKE '%{$payState}%' AND payDate <= '$payDateFrom' ORDER BY payDate ASC";
  } elseif($payState !== "" && $payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payState LIKE '%{$payState}%' AND payDate <= '$payDateTo' ORDER BY payDate ASC";
  
  // 1つ入力されている場合
  // 5から1を選択する組み合わせ
  // x = 5! / 1! * (5 - 1)!
  // x = 5 * 4 * 3 * 2 * 1 / 1 * 4 * 3 * 2 * 1
  // x = 120 / 24
  // x = 5
  } elseif($payName !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payName LIKE '%{$payName}%' ORDER BY payDate ASC";
  } elseif($payCategory !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payCategory LIKE '%{$payCategory}%' ORDER BY payDate ASC";
  } elseif($payState !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payState LIKE '%{$payState}%' ORDER BY payDate ASC";
  } elseif($payDateFrom !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payDate >= '$payDateFrom' ORDER BY payDate ASC";
  } elseif($payDateTo !== ""){
   $query_referencePay = "SELECT * FROM paymentTable WHERE payDate <= '$payDateTo' ORDER BY payDate ASC";
  }

  $result_referencePay = mysqli_query($link, $query_referencePay);

  $result_list = array();
  while($row = mysqli_fetch_assoc($result_referencePay)) {
    array_push($result_list, $row);
  }

  return $result_list;

 }
}
?>