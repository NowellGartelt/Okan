<!-- view/updatePayForm.php -->
<html>
 <head>
  <title>Okan：更新(つかったお金)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の支出の更新入力画面。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <div align="right">
   <p>LoginID：<?php echo $loginID; ?></p>
   <form action="../../Okan/logout.php" method="post">
    <button type="submit">ログアウト</button>
   </form>
  </div>
  <div align="center">
   <p>Okan：更新(つかったお金)</p><br>
<?php if($errorInputPay == "lackInput") { ?>
   <p>ちょっと、項目が間違ってるわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } elseif ($errorInputPay == "minusInput") { ?>
   <p>ちょっと、金額がマイナスになってるわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } else { ?>
   <p>前の支払いを直したいの？？</p>
   <p>もう、ちゃんと教えなさいよ</p><br>
<?php } ?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/updatePayResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>いつ？※：</td>
       <td></td>
       <td><input type="date" name="payDate" style="width: 150px" value=<?php echo $payList['payDate']; ?>></td>
      </tr>
      <tr>
       <td>いくら？※：</td>
       <td></td>
       <td><input type="number" name="payment"  style="width: 150px"value=<?php echo $payList['payment']; ?>></td>
      </tr>
      <tr>
       <td>税別？：</td>
       <td><input type="checkbox" name="taxFlg" value=1 <?php if ($payList['taxFlg'] == 1) { ?> checked <?php } ?>></td>
       <td><input type="number" name="tax" style="width: 150px" value="<?php echo $payList['tax']; ?>"> %</td>
      </tr>
      <tr>
       <td>使ったものは？※：</td>
       <td></td>
       <td><input type="text" name="payName" style="width: 150px" value=<?php echo $payList['payName']; ?>></td>
      </tr>
      <tr>
       <td>カテゴリは？※：</td>
       <td></td>
       <td>
        <select name="payCategory" style="width: 150px">
<?php 
foreach ($cateList as &$categoryName) {
?>
         <option value=<?php 
            echo $categoryName['personalID'];
            if ($payList['categoryName'] == $categoryName['categoryName']) {
                ?> selected <?php
}
            ?>><?php echo $categoryName['categoryName'] ?></option>
<?php 
}
?>
        </select>
       </td>
      </tr>
      <tr>
       <td>支払い方法は？</td>
       <td></td>
       <td>
        <select name="methodOfPayment" style="width: 150px">
<?php
foreach ($mopList as &$methodOfPayment) {
?>
         <option value=<?php 
            echo $methodOfPayment['mopID']; 
            if ($payList['paymentName'] == $methodOfPayment['paymentName']) {
                ?> selected <?php
            }
            ?>><?php echo $methodOfPayment['paymentName']; ?></option>
<?php
}
?>
        </select>
       </td>
      </tr>
      <tr>
       <td>一言メモ：</td>
       <td></td>
       <td><input type="text" name="payState" style="width: 150px" value=<?php echo $payList['payState']; ?>></td>
      </tr>
     </tbody>
    </table>
    <br>
    <input type="hidden" name="ID" value=<?php echo $id; ?>>
    <button type="submit">オカンに教え直す</button>
   </form>
   <form action="../../Okan/referencePayResult.php" method="post">
    <input type="hidden" name="page" value="update">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>