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
   <p>前の収入を取り消したいの？？</p>
   <p>取り消す内容と対象があってるか、確認しなさいよね</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/deleteIncResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>いつ？：</td>
       <td><?php echo $incInfoDateYear; ?>年
        <?php echo $incInfoDateMonth; ?>月
        <?php echo $incInfoDateDay; ?>日</td>
      </tr>
      <tr>
       <td>いくら？：</td>
       <td><?php echo $incList['income']; ?>円</td>
      </tr>
      <tr>
       <td>何でもらったの？：</td>
       <td><?php echo $incList['incName']; ?></td>
      </tr>
      <tr>
       <td>カテゴリは？：</td>
       <td><?php echo $incList['categoryName']; ?></td>
      </tr>
      <tr>
       <td>一言メモ：</td>
       <td><?php echo $incList['incState']; ?></td>
      </tr>
     </tbody>
    </table>
    <br>
    <input type="hidden" name="ID" value=<?php echo $id; ?>>
    <input type="hidden" name="incName" value=<?php echo $incList['incName']; ?>>
    <input type="hidden" name="income" value=<?php echo $incList['income']; ?>>
    <input type="hidden" name="incCategory" value=<?php echo $incList['incCategory']; ?>>
    <input type="hidden" name="incDate" value=<?php echo $incList['incDate']; ?>>
    <input type="hidden" name="incDateYear" value=<?php echo $incInfoDateYear; ?>>
    <input type="hidden" name="incDateMonth" value=<?php echo $incInfoDateMonth; ?>>
    <input type="hidden" name="incDateDay" value=<?php echo $incInfoDateDay; ?>>
    <input type="hidden" name="incState" value=<?php echo $incList['incState']; ?>>
    <button type="submit">オカンに取り消してもらう</button>
   </form>
   <form action="../../Okan/referenceIncResult.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>