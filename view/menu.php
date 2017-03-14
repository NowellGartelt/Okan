<!-- view/menu.php -->
<html>
 <head>
  <title>Okan：メニュー</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」のメニューを表示。">
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
   <p>Okan：メニュー</p><br>
   <p>何にお金使ったのか教えなさいよ</p>
   <p>ムダ遣いするんじゃないわよ</p><br>
   <img src="../cosmetics/img/カーチャン.gif">
   <br> <br>
   <p>やれること：</p>
   <table>
    <tbody>
     <tr>
      <td>使ったお金を記録する：</td>
      <td><a href="../controller/registPayForm.php">オカンに教える</a></td>
     </tr>
     <tr>
      <td>使ったお金を探す：</td>
      <td><a href="../controller/referencePayForm.php">オカンに訊く</a></td>
     </tr>
     <tr>
      <td>使ったお金をまとめて探す：</td>
      <td><a href="../controller/refPaySortByForm.php">オカンに訊く</a></td>
     </tr>
     <tr>
      <td>もらったお金を記録する：</td>
      <td><a href="../controller/registIncForm.php">オカンに教える</a></td>
     </tr>
     <tr>
      <td>もらったお金を探す：</td>
      <td><a href="../controller/referenceIncForm.php">オカンに教える</a></td>
     </tr>
<!--
     <tr>
      <td>もらったお金をまとめて探す：</td>
      <td><a href="../controller/refIncSortByForm.php">オカンに訊く</a></td>
     </tr>
-->
     <tr>
      <td>おこづかいとむだづかいをまとめる：</td>
      <td><a href="../controller/refPayAndIncReportForm.php">オカンに訊く</a></td>
     </tr>
     <tr>
      <td></td>
      <td></td>
     </tr>
     <tr>
      <td></td>
      <td></td>
     </tr>
     <tr>
      <td>メンバー情報をかえる：</td>
      <td><a href="../controller/updateMemberForm.php">オカンにお願いする</a></td>
     </tr>
<!-- 
     <tr>
      <td>ぶんるいをかえる：</td>
      <td><a href="../controller/">オカンに訊く</a></td>
     </tr>
-->
    </tbody>
   </table>
   <br><br>
  </div>
 </body>
</html>