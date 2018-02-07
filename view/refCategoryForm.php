<!-- 
@category view
@name refCategoryForm.php
-->
<html>
 <head>
  <title>Okan：カテゴリ収支選択画面</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」のカテゴリ収支選択画面。">
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
   <p>Okan：カテゴリ収支選択画面</p><br>
   <p>どっちのカテゴリにするの？？</p>
   <p>見たいのと、変更したいカテゴリの方を選びなさいよね</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <table>
    <tbody>
     <tr>
      <td>
       <form action="../../Okan/refPayCategoryForm.php" method="post">
        <button type="submit">支出のカテゴリ</button>
       </form>
      </td>
      <td>
       <form action="../../Okan/refIncCategoryForm.php" method="post">
        <button type="submit">収入のカテゴリ</button>
       </form>
      </td>
     </tr>
    </tbody>
   </table>
   <br>
   <form action="../../Okan/refUserConfMenu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>