<!-- view/updateIncForm.php -->
<html>
 <head>
  <title>Okan：更新(もらったお金)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の収入の更新入力画面。">
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
   <p>Okan：更新(もらったお金)</p><br>
<?php if($errorInputInc == false) { ?>
   <p>前の収入を直したいの？？</p>
   <p>もう、ちゃんと教えなさいよ</p><br>
<?php } elseif ($errorInputInc == true) { ?>
   <p>ちょっと、項目が間違ってるわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } ?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/updateIncResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>使ったものは？：</td>
       <td><input type="text" name="incName" value=<?php echo $incInfo['incName']; ?>></td>
      </tr>
      <tr>
       <td>いくら？：</td>
       <td><input type="text" name="income" value=<?php echo $incInfo['income']; ?>></td>
      </tr>
      <tr>
       <td>カテゴリは？：</td>
       <td><input type="text" name="incCategory" value=<?php echo $incInfo['incCategory']; ?>></td>
      </tr>
      <tr>
       <td>いつ？：</td>
       <td><input type="date" name="incDate" value=<?php echo $incInfo['incDate']; ?>></td>
      </tr>
      <tr>
       <td>どこで？：</td>
       <td><input type="text" name="incState" value=<?php echo $incInfo['incState']; ?>></td>
      </tr>
     </tbody>
    </table>
    <br>
    <input type="hidden" name="ID" value=<?php echo $id; ?>>
    <button type="submit">オカンに教え直す</button>
   </form>
   <form action="../../Okan/referenceIncResult.php" method="post">
    <input type="hidden" name="page" value="update">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>