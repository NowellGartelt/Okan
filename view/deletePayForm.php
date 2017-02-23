<!-- view/deletePayForm.php -->
<html>
 <head>
  <title>Okan：削除</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の削除画面。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <div align="right">
   <form action="../controller/logout.php" method="post">
    <button type="submit">ログアウト</button>
   </form>
  </div>
  <div align="center">
   <p>Okan：削除</p><br>
   <p>前の支払いを取り消したいの？？</p>
   <p>取り消す内容と対象があってるか、確認しなさいよね</p><br>
   <img src="../cosmetics/img/カーチャン.gif">
   <br><br>
   <p></p>
   <form action="../controller/deletePayResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>使ったものは？：</td>
       <td><?php echo $paymentInfo['payName']; ?></td>
      </tr>
      <tr>
       <td>いくら？：</td>
       <td><?php echo $paymentInfo['payment']; ?>円</td>
      </tr>
      <tr>
       <td>カテゴリは？：</td>
       <td><?php echo $paymentInfo['payCategory']; ?></td>
      </tr>
      <tr>
       <td>いつ？：</td>
       <td><?php echo $paymentInfoDateYear; ?>年
        <?php echo $paymentInfoDateMonth; ?>月
        <?php echo $paymentInfoDateDay; ?>日</td>
      </tr>
      <tr>
       <td>一言メモ：</td>
       <td><?php echo $paymentInfo['payState']; ?></td>
      </tr>
     </tbody>
    </table>
    <br>
    <input type="hidden" name="ID" value=<?php echo $id; ?>>
    <input type="hidden" name="payName" value=<?php echo $paymentInfo['payName']; ?>>
    <input type="hidden" name="payment" value=<?php echo $paymentInfo['payment']; ?>>
    <input type="hidden" name="payCategory" value=<?php echo $paymentInfo['payCategory']; ?>>
    <input type="hidden" name="payDateYear" value=<?php echo $paymentInfoDateYear; ?>>
    <input type="hidden" name="payDateMonth" value=<?php echo $paymentInfoDateMonth; ?>>
    <input type="hidden" name="payDateDay" value=<?php echo $paymentInfoDateDay; ?>>
    <input type="hidden" name="payState" value=<?php echo $paymentInfo['payState']; ?>>
    <button type="submit">オカンに取り消してもらう</button>
   </form>
   <form action="../controller/referencePayResult.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>