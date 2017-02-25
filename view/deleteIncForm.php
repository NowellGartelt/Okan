<!-- view/deleteIncForm.php -->
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
   <form action="../controller/deleteIncResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>使ったものは？：</td>
       <td><?php echo $incInfo['incName']; ?></td>
      </tr>
      <tr>
       <td>いくら？：</td>
       <td><?php echo $incInfo['income']; ?>円</td>
      </tr>
      <tr>
       <td>カテゴリは？：</td>
       <td><?php echo $incInfo['incCategory']; ?></td>
      </tr>
      <tr>
       <td>いつ？：</td>
       <td><?php echo $incInfoDateYear; ?>年
        <?php echo $incInfoDateMonth; ?>月
        <?php echo $incInfoDateDay; ?>日</td>
      </tr>
      <tr>
       <td>一言メモ：</td>
       <td><?php echo $incomeInfo['incState']; ?></td>
      </tr>
     </tbody>
    </table>
    <br>
    <input type="hidden" name="ID" value=<?php echo $id; ?>>
    <input type="hidden" name="incName" value=<?php echo $incInfo['incName']; ?>>
    <input type="hidden" name="income" value=<?php echo $incInfo['income']; ?>>
    <input type="hidden" name="incCategory" value=<?php echo $incInfo['incCategory']; ?>>
    <input type="hidden" name="incDateYear" value=<?php echo $incInfoDateYear; ?>>
    <input type="hidden" name="incDateMonth" value=<?php echo $incInfoDateMonth; ?>>
    <input type="hidden" name="incDateDay" value=<?php echo $incInfoDateDay; ?>>
    <input type="hidden" name="incState" value=<?php echo $incInfo['incState']; ?>>
    <button type="submit">オカンに取り消してもらう</button>
   </form>
   <form action="../controller/referenceIncResult.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>