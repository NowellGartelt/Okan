<!-- view/login.php -->
<div align="center">
 <p>ログイン</p><br>
 <form action="../controller/loginAction.php" method="post">
  <table>
   <tbody>
    <tr>
     <td>ログインID：</td>
     <td><input type="text" name="loginID"></td>
    </tr>
    <tr>
     <td>パスワード：</td>
     <td><input type="password" name="loginPassword"></td>
    </tr>
   </tbody>
  </table>
  <br>
  <button type="submit">ログインする</button>
 </form>
 <table>
  <tr>
   <td>
    <form action="../controller/registMemberForm.php" method="post">
     <button type="submit">新規登録</button>
    </form>
   </td>
<!--
   <td>
    <form action="../controller/forgotMemberForm.php" method="post">
     <button type="submit">ID・パスワード忘れ</button>
    </form> 
   </td>
-->
  </tr>
 </table>
</div>