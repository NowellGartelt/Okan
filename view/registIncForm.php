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
<?php if($errFlg == true) { ?>
<?php   if($errGetInfo == "emptyList" || $errGetInfo == "emptyProperties") { ?>
   <p>悪いわねぇ、画面の表示に失敗しちゃったわ</p>
   <p>再読み込みして、もういっかい画面を開き直してくれる？</p><br>
<?php   } elseif($errInput == "lackInput") { ?>
   <p>ちょっと、項目が足りてないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php   } elseif ($errInput == "minusInput") { ?>
   <p>ちょっと、金額がマイナスになってるわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php   } else { ?>
   <p>いくら稼いだの？？</p>
   <p>まっとうにちゃんと働きなさいよね</p><br>
<?php   } ?>
<?php } ?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/registIncResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>いつ？※：</td>
       <td><input type="date" name="incDate" style="width: 150px" value=<?php echo date("Y-m-d"); ?>></td>
      </tr>
      <tr>
       <td>いくら？※：</td>
       <td><input type="number" name="income" style="width: 150px"></td>
      </tr>
<?php 
if ($moduleIncNameFlg == "1") {
?>
      <tr>
       <td>何で稼いだの？：</td>
       <td><input type="text" name="incName" style="width: 150px"></td>
      </tr>
<?php 
}
if ($moduleIncCateFlg == "1") {
?>      
      <tr>
       <td>カテゴリは？：</td>
       <td>
        <select name="incCategory" style="width: 150px">
<?php 
foreach ($cateList as &$categoryName) {
?>
         <option value=<?php echo $categoryName['personalID'] ?>><?php echo $categoryName['categoryName'] ?></option>
<?php 
}
?>
        </select>
       </td>
      </tr>
<?php 
}
if ($moduleIncMemoFlg == "1") {
?>
      <tr>
       <td>一言メモ：</td>
       <td><input type="text" name="incState" style="width: 150px"></td>
      </tr>
<?php 
}
?>
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