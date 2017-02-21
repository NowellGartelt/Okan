<!-- view/updatePayForm.php -->
<html>
 <head>
  <title>Okan：更新</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の更新画面。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
　<div align="right">
   <form action="../controller/logout.php" method="post">
    <input type="submit" value="ログアウト">
   </form>
  </div>
  <div align="center">
  <p>Okan：更新</p><br>
<?php if($errorInputPay == false) { ?>
  <p>前の支払いを直したいの？？</p>
  <p>もう、ちゃんと教えなさいよ</p><br>
<?php } elseif ($errorInputPay == true) { ?>
  <p>ちょっと、項目が間違ってるわよ？</p>
  <p>もういっかい確認しなさいよね</p><br>
<?php } ?>
  <img src="../cosmetics/img/カーチャン.gif">
  <br><br>
  <p></p>
  <form action="../controller/updatePayResult.php" method="post">
   <table>
    <tbody>
     <tr>
      <td>使ったものは？：</td>
      <td><input type="text" name="payName" value=<?php echo $paymentInfo['payName']; ?>></td>
     </tr>
     <tr>
      <td>いくら？：</td>
      <td><input type="text" name="payment" value=<?php echo $paymentInfo['payment']; ?>></td>
     </tr>
     <tr>
      <td>カテゴリは？：</td>
      <td><input type="text" name="payCategory" value=<?php echo $paymentInfo['payCategory']; ?>></td>
     </tr>
     <tr>
      <td>いつ？：</td>
      <td><input type="date" name="payDate" value=<?php echo $paymentInfo['payDate']; ?>></td>
     </tr>
     <tr>
      <td>どこで？：</td>
      <td><input type="text" name="payState" value=<?php echo $paymentInfo['payState']; ?>></td>
     </tr>
    </tbody>
   </table>
   <br>
   <input type="hidden" name="ID" value=<?php echo $id; ?>>
   <input type="submit" value="オカンに教え直す">
  </form>
  <form action="../controller/referencePayResult.php" method="post">
   <input type="hidden" name="page" value="update">
   <input type="submit" value="戻る">
  </form>
  </div>
　</body>
</html>