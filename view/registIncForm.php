<!-- view/registIncForm.php -->
<html>
 <head>
  <title>Okan：登録(もらったお金)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の収入の登録画面。">
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
   <p>Okan：登録(もらったお金)</p><br>
<?php if($errorInputInc == "lackInput") { ?>
   <p>ちょっと、項目が足りてないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } elseif ($errorInputInc == "minusInput") { ?>
   <p>ちょっと、金額がマイナスになってるわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php } else { ?>
   <p>いくら稼いだの？？</p>
   <p>まっとうにちゃんと働きなさいよね</p><br>
<?php } ?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/registIncResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>何で稼いだの？※：</td>
       <td><input type="text" name="incName" style="width: 150px"></td>
      </tr>
      <tr>
       <td>いくら？※：</td>
       <td><input type="number" name="income" style="width: 150px"></td>
      </tr>
      <tr>
       <td>カテゴリは？※：</td>
<!-- 
       <td><input type="text" name="incCategory" style="width: 150px"></td>
-->
       <td>
        <select name="incCategory" style="width: 150px">
<?php 
foreach ($getCategory as &$categoryName) {
?>
         <option value=<?php echo $categoryName['personalID'] ?>><?php echo $categoryName['categoryName'] ?></option>
<?php 
}
?>
        </select>
       </td>
      </tr>
      <tr>
       <td>いつ？※：</td>
       <td><input type="date" name="incDate" style="width: 150px" value=<?php echo date("Y-m-d"); ?>></td>
      </tr>
      <tr>
       <td>一言メモ：</td>
       <td><input type="text" name="incState" style="width: 150px"></td>
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