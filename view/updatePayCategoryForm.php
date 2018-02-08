<!-- view/updatePayCategoryForm.php -->
<html>
 <head>
  <title>Okan：更新(つかったお金のカテゴリ)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」のカテゴリ(支出)の更新入力画面。">
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
   <p>Okan：更新(つかったお金のカテゴリ)</p><br>
<?php if($errorInput == "nullInfo") { ?>
   <p>ちょっと、項目が間違ってるわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } else { ?>
   <p>カテゴリ名を直したいの？？</p>
   <p>新しいカテゴリ名を教えなさいよね</p><br>
<?php } ?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/updatePayCategoryResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>今のカテゴリ名：</td>
       <td><?php echo $result[0]['categoryName']; ?></td>
      </tr>
      <tr>
       <td>新しいカテゴリ名：</td>
       <td><input type="text" name="categoryName" style="width: 150px"></td>
      </tr>
     </tbody>
    </table>
    <br>
    <input type="hidden" name="personalID" value=<?php echo $personalID; ?>>
    <input type="hidden" name="categoryNameBefore" value=<?php echo $result[0]['categoryName'];?>>
    <button type="submit">オカンに教え直す</button>
   </form>
   <form action="../../Okan/refPayCategoryForm.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>