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
<?php if($errorInputPay == false) { ?>
   <p>前の支払いを直したいの？？</p>
   <p>もう、ちゃんと教えなさいよ</p><br>
<?php } elseif ($errorInputPay == true) { ?>
   <p>ちょっと、項目が間違ってるわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } ?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/updatePayResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>いつ？※：</td>
       <td><input type="date" name="payDate" value=<?php echo $payInfo['payDate']; ?>></td>
      </tr>
      <tr>
       <td>いくら？※：</td>
       <td><input type="number" name="payment" value=<?php echo $payInfo['payment']; ?>></td>
      </tr>
      <tr>
       <td>税別？：</td>
       <td><input type="checkbox" name="tax" value="noTax"></td>
      </tr>
      <tr>
       <td>使ったものは？※：</td>
       <td><input type="text" name="payName" value=<?php echo $payInfo['payName']; ?>></td>
      </tr>
      <tr>
       <td>カテゴリは？※：</td>
       <td><input type="text" name="payCategory" value=<?php echo $payInfo['payCategory']; ?>></td>
      </tr>
      <tr>
       <td>一言メモ：</td>
       <td><input type="text" name="payState" value=<?php echo $payInfo['payState']; ?>></td>
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