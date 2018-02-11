<!-- view/updateModuleResult.php -->
<html>
 <head>
  <title>Okan：更新完了(つかう機能)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の使う機能変更完了の入力画面。">
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
   <p>Okan：更新完了(つかう機能)</p><br>
   <p>つかう機能を変更したわよ</p>
   <p>これからもちゃんと報告しなさいよね</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
    <p>【つかったお金】</p>
    <table>
     <tbody>
      <tr>
       <td>税率計算：</td>
       <td><?php echo $taxCalcFlg; ?></td>
      </tr>
      <tr>
       <td>名前：</td>
       <td><?php echo $payNameFlg; ?></td>
      </tr>
      <tr>
       <td>カテゴリ：</td>
       <td><?php echo $payCateFlg; ?></td>
      </tr>
      <tr>
       <td>支払方法：</td>
       <td><?php echo $paymentFlg; ?></td>
      </tr>
      <tr>
       <td>一言メモ：</td>
       <td><?php echo $payMemoFlg; ?></td>
      </tr>
     </tbody>
    </table>
    <br>
    <p>【もらったお金】</p>
    <table>
     <tbody>
      <tr>
       <td>名前：</td>
       <td><?php echo $incNameFlg; ?></td>
      </tr>
      <tr>
       <td>カテゴリ：</td>
       <td><?php echo $incCateFlg; ?></td>
      </tr>
      <tr>
       <td>一言メモ：</td>
       <td><?php echo $incMemoFlg; ?></td>
      </tr>
     </tbody>
    </table>
    <br>   <form action="../../Okan/refUserConfMenu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>