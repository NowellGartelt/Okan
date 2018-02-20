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
<?php if ($errFlg == true) { ?>
<?php   if ($errGetInfo == "emptyList") { ?>
   <p>悪いわねぇ、画面の表示に失敗しちゃったわ</p>
   <p>再読み込みして、もういっかい画面を開き直してくれる？</p><br>
<?php   } elseif($errInput == "lackInput") { ?>
   <p>ちょっと、項目が足りてないわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php   } elseif ($errInput == "minusInput") { ?>
   <p>ちょっと、金額がマイナスになってるわよ？</p>
   <p>もういっかい確認しなさいよね</p><br>
<?php   } ?>
<?php } else { ?>
   <p>前の収入を直したいの？？</p>
   <p>もう、ちゃんと教えなさいよ</p><br>
<?php } ?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/updateIncResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>使ったものは？：</td>
       <td><input type="text" name="incName" style="width: 150px" value="<?php echo $incList['incName']; ?>"></td>
      </tr>
      <tr>
       <td>いくら？：</td>
       <td><input type="number" name="income" style="width: 150px" value=<?php echo $incList['income']; ?>></td>
      </tr>
      <tr>
       <td>カテゴリは？：</td>
       <td>
        <select name="incCategory" style="width: 150px">
<?php 
foreach ($cateList as &$categoryName) {
?>
         <option value=<?php 
            echo $categoryName['personalID'];
            if ($incList['incCategory'] == $categoryName['categoryID']) {
                ?> selected <?php
}
            ?>><?php echo $categoryName['categoryName'] ?></option>
<?php 
}
?>
        </select>
       </td>
      </tr>
      <tr>
       <td>いつ？：</td>
       <td><input type="date" name="incDate" style="width: 150px" value="<?php echo $incList['incDate']; ?>"></td>
      </tr>
      <tr>
       <td>どこで？：</td>
       <td><input type="text" name="incState" style="width: 150px" value="<?php echo $incList['incState']; ?>"></td>
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