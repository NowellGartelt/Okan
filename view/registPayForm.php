<!-- view/registPayForm.php -->
<html>
 <head>
  <title>Okan：登録(つかったお金)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の支出の登録画面。">
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
   <p>Okan：登録(つかったお金)</p><br>
<?php if($errorInputPay == "lackInput") { ?>
   <p>ちょっと、項目が足りてないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } elseif ($errorInputPay == "minusInput") { ?>
   <p>ちょっと、金額がマイナスになってるわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } else { ?>
   <p>いったい、何に使ったの？？</p>
   <p>まーた変なものに使ったんじゃないでしょうね</p><br>
<?php } ?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/registPayResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>いつ？※：</td>
       <td></td>
       <td><input type="date" name="payDate" value=<?php echo date("Y-m-d"); ?>></td>
      </tr>
      <tr>
       <td>いくら？※：</td>
       <td></td>
       <td><input type="number" name="payment"></td>
      </tr>
      <tr>
       <td>税率？：</td>
       <td><input type="checkbox" name="taxFlg" value=1></td>
       <td><input type="number" name="tax" value="<?php echo $tax; ?>"> %</td>
      </tr>
      <tr>
       <td>使ったものは？※：</td>
       <td></td>
       <td><input type="text" name="payName"></td>
      </tr>
      <tr>
       <td>カテゴリは？※：</td>
       <td></td>
       <td><input type="text" name="payCategory"></td>
      </tr>
      <tr>
       <td>支払い方法は？</td>
       <td></td>
       <td>
        <select name="mop">
<?php
foreach ($mopList as &$mop) {
?>
         <option value="<?php echo $mop['mopID']; ?>"><?php echo $mop['paymentName']; ?></option>
<?php
}
?>
        </select>
       </td>
      </tr>
      <tr>
       <td>一言メモ：</td>
       <td></td>
       <td><input type="text" name="payState"></td>
      </tr>
     </tbody>
    </table>
    <br>
    <a>※は必須項目よ。</a>
    <br>
    <br>
    <button type="submit">オカンに教える</button>
   </form>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>