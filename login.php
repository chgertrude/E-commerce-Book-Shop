<?php
  include "includes/head.php";
  include_once("connection.php");

  if(isset($_POST['login'])){//submit button name
    $username = $_POST['uname']; //input field name
    $password = sha1($_POST['pword']);

    session_start();

    $query = $pdo->prepare("SELECT * FROM accounts WHERE accUsername = :uname AND accPassword = :pword");
    $query->bindParam(':uname',$username);
    $query->bindParam(':pword',$password);
    $query->execute();

    $count = $query->rowCount();

    if($count >0){ //if true
      while($rows = $query->fetch()){
          $accountID = $rows['accountID'];
          $_SESSION['accountID'] = $accountID ;

          if ($rows['accStatus']== "admin") { 
            header("location:index.php");
          }  
             else {
              header("location:index-customer.php");
             }
      }
    }else{
      echo "<script>alert('Sorry, Wrong Username or Password')</script>";
      echo "<script>window.open('login.php','_self')</script>";
    }
  }

?>

<div class="container">
  <div class="title">
    <img src="images/logo1.png" alt="" width="125px">
    <br>
  </div>
  <div class="form">
    <center>
    <form action="" method ="post" > 
      <table class="tb-login">
        <tr>
          <th>
            <a  href="login.php">&nbsp;Login&nbsp;</a>&nbsp;&nbsp;
            <a  href="signup.php">Signup</a>
          </th>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
          <tr>
            <td><i class="fa fa-user icon"></i><input type="text" name="uname" placeholder="Username" ></td>
          </tr>
          <tr>
            <td><i class="fa fa-key icon"></i><input type="password" name="pword" placeholder="Password" id="myInput" ></td>
          </tr>
          <tr>
            <td style="text-align: right;"><input type="checkbox" onclick="myFunction()"> Show Password</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>  
            <th><input  type="submit" name="login" value="Login" class="bttn"></th>
          </tr>
      </table> 
    </form>
    <br>
    <p>Don't have an account?<a href="signup.php" style="text-decoration: none; color:#f37064"><strong> Signup now</strong></a></p>
    </center>
  </div>

</div>

<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

</body>
</html>