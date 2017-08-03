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
   <form action="../Okan/logout.php" method="post">
    <button type="submit">ログアウト</button>
   </form>
  </div>
  <div align="center">
   <p>Okan：メニュー</p><br>
   <p>何にお金使ったのか教えなさいよ</p>
   <p>ムダ遣いするんじゃないわよ</p><br>
   <img src="cosmetics/img/okan.gif">
   <br> <br>
   <p>【やれること】</p>
   <table>
    <tbody>
     <tr>
      <td>つかったお金を記録する：</td>
       <td><a href="../../Okan/registPayForm.php">おかんに教える</a></td>
<!--       
      <td>
       <form action="../../Okan/registPayForm.php" method="post">
        <button type="submit">おかんに教える</button>
       </form>
      </td>
 -->
     </tr>
     <tr>
      <td>つかったお金を探す：</td>
      <td><a href="../../Okan/referencePayForm.php">おかんにきく</a></td>
<!--
      <td>
       <form action="../../Okan/referencePayForm.php" method="post">
        <button type="submit">おかんに訊く</button>
       </form>
      </td>
-->
     </tr>
     <tr>
      <td>つかったお金をまとめて探す：</td>
      <td><a href="../../Okan/refPaySortByForm.php">おかんにきく</a></td>
<!--
      <td>
       <form action="../../Okan/refPaySortByForm.php" method="post">
        <button type="submit">おかんに訊く</button>
       </form>
      </td>
-->
     </tr>
     <tr>
      <td>もらったお金を記録する：</td>
      <td><a href="../../Okan/registIncForm.php">おかんに教える</a></td>
<!--
      <td>
       <form action="../../Okan/controller/registIncForm.php" method="post">
        <button type="submit">おかんに教える</button>
       </form>
      </td>
-->
     </tr>
     <tr>
      <td>もらったお金を探す：</td>
      <td><a href="../../Okan/referenceIncForm.php">おかんにきく</a></td>
<!--
      <td>
       <form action="../../Okan/referenceIncForm.php" method="post">
        <button type="submit">おかんに教える</button>
       </form>
      </td>
-->
     </tr>
<!--
     <tr>
      <td>もらったお金をまとめて探す：</td>
      <td><a href="../../Okan/refIncSortByForm.php">オカンに訊く</a></td>
     </tr>
-->
     <tr>
      <td>おこづかいレポート：</td>
      <td><a href="../../Okan/refPayAndIncReportForm.php">おかんにきく</a></td>
<!--
      <td>
       <form action="../../Okan/refPayAndIncReportForm.php" method="post">
        <button type="submit">おかんに訊く</button>
       </form>
      </td>
-->
     </tr>
    </tbody>
   </table>
<!--
     <tr>
      <td></td>
      <td></td>
     </tr>
     <tr>
      <td></td>
      <td></td>
     </tr>
-->
   <br>
   <table>
    <tbody>
     <tr>
      <td>メンバー情報をかえる：</td>
      <td><a href="../../Okan/updateMemberForm.php">おかんにお願いする</a></td>
<!--
      <td>
       <form action="../../Okan/updateMemberForm.php" method="post">
        <button type="submit">おかんにお願いする</button>
       </form>
      </td>
-->
     </tr>
<!--
     <tr>
      <td>ぶんるいをかえる：</td>
      <td><a href="../../Okan/updateCategory.php">おかんにお願いする</a></td>
     </tr>
-->
	</tbody>
   </table>
   <br><br>
   <form action="mailto:fuen.works.999@gmail.com" method="post">
    <button type="submit">おかんに意見する</button>
   </form>
  </div>
 </body>
</html>