<!-- view/updateModuleForm.php -->
<html>
 <head>
  <title>Okan：更新(つかう機能)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の使う機能変更の入力画面。">
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
   <p>Okan：更新(つかう機能)</p><br>
   <p>つかう機能を変更したいの？？</p>
   <p>使いたい機能を教えなさいよね</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/updateModuleResult.php" method="post">
    <p>【つかったお金】</p>
    <table>
     <tbody>
      <tr>
       <td><input type="checkbox" name="taxCalc" <?php if ($moduleTaxCalcFlg == "1") { ?>checked<?php } ?>></td>
       <td>税率計算</td>
      </tr>
      <tr>
       <td><input type="checkbox" name="payName" <?php if ($modulePayNameFlg == "1") { ?>checked<?php } ?>></td>
       <td>つかったものの名前</td>
      </tr>
      <tr>
       <td><input type="checkbox" name="payCategory" <?php if ($modulePayCateFlg == "1") { ?>checked<?php } ?>></td>
       <td>カテゴリ</td>
      </tr>
      <tr>
       <td><input type="checkbox" name="payment" <?php if ($modulePaymentFlg == "1") { ?>checked<?php } ?>></td>
       <td>支払方法</td>
      </tr>
      <tr>
       <td><input type="checkbox" name="payMemo" <?php if ($modulePayMemoFlg == "1") { ?>checked<?php } ?>></td>
       <td>一言メモ</td>
      </tr>
     </tbody>
    </table>
    <br>
    <p>【もらったお金】</p>
    <table>
     <tbody>
      <tr>
       <td><input type="checkbox" name="incName" <?php if ($moduleIncNameFlg == "1") { ?>checked<?php } ?>></td>
       <td>もらったものの名前</td>
      </tr>
      <tr>
       <td><input type="checkbox" name="incCategory" <?php if ($moduleIncCateFlg == "1") { ?>checked<?php } ?>></td>
       <td>カテゴリ</td>
      </tr>
      <tr>
       <td><input type="checkbox" name="incMemo" <?php if ($moduleIncMemoFlg == "1") { ?>checked<?php } ?>></td>
       <td>一言メモ</td>
      </tr>
     </tbody>
    </table>
    <br>
    <button type="submit">オカンに教え直す</button>
   </form>
   <form action="../../Okan/refUserConfMenu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>