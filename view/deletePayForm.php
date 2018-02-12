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
   <p>LoginID：<?php echo $loginID; ?></p>
   <form action="../../Okan/logout.php" method="post">
    <button type="submit">ログアウト</button>
   </form>
  </div>
  <div align="center">
   <p>Okan：削除</p><br>
   <p>前の支払いを取り消したいの？？</p>
   <p>取り消す内容と対象があってるか、確認しなさいよね</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/deletePayResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>いつ？：</td>
       <td><?php echo $payInfoDateYear; ?>年
        <?php echo $payInfoDateMonth; ?>月
        <?php echo $payInfoDateDay; ?>日</td>
      </tr>
      <tr>
       <td>いくら？：</td>
       <td><?php echo $payList['payment']; ?> 円</td>
      </tr>
      <tr>
       <td>税率は？：</td>
       <td><?php echo $payList['tax']; ?> %</td>
      </tr>
      <tr>
       <td>使ったものは？：</td>
       <td><?php echo $payList['payName']; ?></td>
      </tr>
      <tr>
       <td>カテゴリは？：</td>
       <td><?php echo $payList['categoryName']; ?></td>
      </tr>
      <tr>
       <td>支払方法は？：</td>
       <td><?php echo $payList['paymentName']; ?></td>
      </tr>
      <tr>
       <td>一言メモ：</td>
       <td><?php echo $payList['payState']; ?></td>
      </tr>
     </tbody>
    </table>
    <br>
    <input type="hidden" name="ID" value=<?php echo $id; ?>>
    <input type="hidden" name="payName" value=<?php echo $payList['payName']; ?>>
    <input type="hidden" name="payment" value=<?php echo $payList['payment']; ?>>
    <input type="hidden" name="payCategory" value=<?php echo $payList['payCategory']; ?>>
    <input type="hidden" name="payDate" value=<?php echo $payList['payDate']; ?>>
    <input type="hidden" name="payDateYear" value=<?php echo $payInfoDateYear; ?>>
    <input type="hidden" name="payDateMonth" value=<?php echo $payInfoDateMonth; ?>>
    <input type="hidden" name="payDateDay" value=<?php echo $payInfoDateDay; ?>>
    <input type="hidden" name="payState" value=<?php echo $payList['payState']; ?>>
    <button type="submit">オカンに取り消してもらう</button>
   </form>
   <form action="../../Okan/referencePayResult.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>