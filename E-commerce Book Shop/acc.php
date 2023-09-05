<?php
    include_once "connection.php";
    include "includes/head.php";
    include "includes/nav-customer.php";

    include_once "session.php";

    // start selecting id first before updating.
    $query = $pdo->prepare("SELECT * FROM accounts WHERE accountID = '$aid'");
    $query->execute();

        while($rows = $query->fetch()){
            $fname = $rows['fullName']; //new variable naming , inside is the coloumn name in DB
            $e_mail = $rows['accEmail'];
            $homeAdd = $rows['accAddress'];
        } //end selecting

        //start of updating
        if(isset($_POST['editCustomer'])){ //inside the parenthesis is the name of submit button
            $accFname = $_POST['fname']; //inside is the name of the input
            $accEmail = $_POST['email'];
            $accAdd = $_POST['address'];

            $query = $pdo->prepare("UPDATE accounts SET fullName = :fname, accEmail = :e_mail, accAddress = :homeAdd
            WHERE accountID = '$aid'");
            $query->bindParam(':fname',$accFname);
            $query->bindParam(':e_mail',$accEmail);
            $query->bindParam(':homeAdd',$accAdd);

            $query->execute();

            echo "<script>alert('Successfully Updated!')</script>";
            echo "<script>window.open('acc.php','_self')</script>";
        }//end of updating

?>
    
<article class="pad-layout">
<div class="title">
  <h1>Update Information</h1>
</div>
<div class="scrollDiv">
        <div class="scrollContent">
          <center>
          <form action="" method ="post" enctype="multipart/form-data"> <!--if uploading is included include enctype, process in the same page - no action --> 
            <table class="tb-index">
                <tr>
                  <td>Fullname</td>
                  <td><input type="text" name="fname" value="<?php echo $fname;?>" ></td>
                </tr>
                <tr>
                  <td>Email Address</td>
                  <td><input type="email" name="email" value="<?php echo $e_mail;?>"  style="width: 100%;"></td>
                </tr>
                <tr>
                  <td>Home Address</td>
                  <td><input type="text" name="address" value="<?php echo $homeAdd;?>" ></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>  
                  <td>&nbsp;</td>
                  <th><input  type="submit" name="editCustomer" value="Update" class="bttn"></th>
                </tr>
            </table> 
          </form>
          </center>
        </div>
    </div>
</article>

<?php
  include "includes/aside-customer.php";
?>

</body>
</html>