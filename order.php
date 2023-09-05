<?php
  include "includes/head.php";
  include "includes/nav.php";

  include_once("connection.php");
  include_once "session.php";
?>
    
<article class="pad-layout">
<div class="title">
  <h1>List of Orders</h1>
</div>
<div class="scrollDiv">
        <div class="scrollContent">
          <center>
          <table class="tb-view" style="text-align: center;">
               <thead>
                    <tr>
                        <th>Name</th> 
                        <th>Email</th>
                        <th>Address</th>
                        <th>Order Total</th>
                    </tr>
               </thead> 
               <tbody>
                   <?php
                        $query = $pdo->prepare("SELECT a.userName, b.accEmail, b.accAddress, a.userTotal, a.userID FROM total a
                        INNER JOIN accounts b ON b.accountID = a.userID");
                        $query->execute();

                        while($rows = $query->fetch()){
                            $_name = $rows['userName'];
                            $mail = $rows['accEmail'];
                            $homeadd = $rows['accAddress'];
                            $total = $rows['userTotal'];
                            $userID = $rows['userID'];

                   ?>
                    <tr>
                        <td><?php echo ucfirst($_name);?></td>
                        <td><?php echo ucfirst($mail);?></td>
                        <td><?php echo ucfirst($homeadd);?></td>
                        <td><a href="list-admin.php?uid=<?php echo $userID;?>" style="text-decoration: none ; color:#F65D4E" class="tooltip" title="View Details"><?php echo "₱".$total.".00"?></a></td>
                    </tr>

                        <?php }?> <!-- for cont.. looping-->
               </tbody>
            </table>
          </center>
        </div>
    </div>
</article>

<?php
  include "includes/aside.php";
?>

</body>
</html>

