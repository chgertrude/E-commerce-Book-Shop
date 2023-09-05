<?php
    include_once("connection.php");
    include_once "session.php";
?>

<style>
    /* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }
  
  /* Modal Content */
  .modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 35%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s;
  }
  
  /* Add Animation */
  @-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
  }
  
  @keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
  }
  
  /* The Close Button */
  .close {
    color: #F65D4E;
    font-size: 28px;
    font-weight: bold;
  }
  
  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }
  
  .modal-header {
    padding: 0px 20px;
    background-color: transparent;
    color: #F65D4E;
  }
  
  .modal-body {padding: 2px 16px;}
  



</style>

<?php
    $status="";
    if (isset($_POST['action']) && $_POST['action']=="remove"){

        if(!empty($_SESSION["shopping_cart"])) {
            foreach($_SESSION["shopping_cart"] as $key => $value) {
                if($_POST["code"] == $key){
                    unset($_SESSION["shopping_cart"][$key]);
                    $status = "<div class='alert' style='width: 70%;'>
                    <span class='closebtn'>&times;</span>  
                    Product is removed from your cart!
                    </div>";
                }
            if(empty($_SESSION["shopping_cart"]))
            unset($_SESSION["shopping_cart"]);
            }		
        }
    }

    if (isset($_POST['action']) && $_POST['action']=="change"){
        foreach($_SESSION["shopping_cart"] as &$value){
            if($value['code'] === $_POST["code"]){
                $value['quantity'] = $_POST["quantity"];
                break; // Stop the loop after we've found the product
            }
    }
        
}
?>

<aside>
    <div class="pad-layout">
    <div class="title">
        <h1><i class="fas fa-shopping-cart"></i> Cart</h1>
    </div>
        <div class="scrollDiv">
            <div class="scrollContent">
            <center>
                <div class="cart">
                    <?php
                    if(isset($_SESSION["shopping_cart"])){
                        $total_price = 0;
                        $sf = 50;
                        $total_sf = 0;
                    ?>	
                    
                    <table class="tb-cart">
                        <tbody>
                            <?php		
                            foreach ($_SESSION["shopping_cart"] as $product){
                            ?>

                            <tr>
                                <td rowspan="3"><img src='photos/<?php echo $product["productImage"];?>' width="100px"  style="border-radius: 10px;" /> <!-- db col inside--></td>
                                <td colspan="2"><h3><?php echo $product["productName"]; ?></h3></td>
                            </tr>
                            <tr>
                                <td colspan="2"><h2 style="color: #F65D4E;"><?php echo "₱".$product["productPrice"]*$product["quantity"]; ?></h2></td>
                            </tr>
                            <tr>
                                <td>
                                    <form method='post' action=''>
                                        <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                        <input type='hidden' name='action' value="change" />
                                        <select name='quantity' class='quantity' onChange="this.form.submit()" style="border: none; border-radius:5px;">
                                        <option <?php if($product["quantity"]==1) echo "selected";?>
                                        value="1">1</option>
                                        <option <?php if($product["quantity"]==2) echo "selected";?>
                                        value="2">2</option>
                                        <option <?php if($product["quantity"]==3) echo "selected";?>
                                        value="3">3</option>
                                        <option <?php if($product["quantity"]==4) echo "selected";?>
                                        value="4">4</option>
                                        <option <?php if($product["quantity"]==5) echo "selected";?>
                                        value="5">5</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <form method='post' action=''>
                                        <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                        <input type='hidden' name='action' value="remove" />
                                        <button type='submit' class='remove'  style="text-decoration: none ; font-size: 15px; font-weight: normal; background:none; border: none; cursor: pointer;">Remove <i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                                </form>
                            </tr>
                                <?php
                                $total_price += ($product["productPrice"]*$product["quantity"]);
                                }
                                ?>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="right"><strong>TOTAL: 
                                    <?php 
                                        $total_sf = $total_price+$sf;
                                        echo "₱".$total_sf.".00"; ?></strong>
                                <p>Shipping Fee: <?php echo "₱".$sf.".00"; ?></p> 
                                <br> <br>
                                <button id="myBtn" class="butt" style="float:right; text-decoration: none ; background:#F65D4E; color: white; border: none; padding: 10px; border-radius: 10px; cursor: pointer; font-weight:bold">CHECKOUT <i class="fas fa-shopping-bag"></i></button>
                                    <!-- The Modal -->
                                    <div id="myModal" class="modal">

                                    <!-- Modal content -->
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <table style="width: 100%;">
                                            <span class="close">&times;</span>
                                            <?php 
                                                $query = $pdo->prepare("SELECT * FROM accounts WHERE accountID = '$aid'");
                                                $query->execute();
                                            
                                                    while($rows = $query->fetch()){
                                                        $fname = $rows['fullName']; //new variable naming , inside is the coloumn name in DB
                                                        $e_mail = $rows['accEmail'];
                                                        $homeAdd = $rows['accAddress'];
                                                    
                                                    } //end selecting
                                            ?>
                                            <thead>
                                                <tr>
                                                    <td colspan="3">
                                                        <h1 style="font-size: 31px;"> __ I N V O I C E</h1>
                                                        <h4><?php $date =date("F j, Y, g:i a");echo  strtoupper($date);?></h4>
                                                        <p>CASH ON DELIVERY</p>
                                                    </td>
                                                    <td colspan="2" rowspan="2" style="text-align: right;"><img src="images/logo.png" alt="" width="120px" style="padding: 25px; background:#F65D4E"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="3"><h3>Billing To:</h3></td>
                                                    <td colspan="2"  rowspan="4" style="text-align: right;">Total Due<br><h1 style="font-size:35px"><?php echo "₱".$total_sf.".00";?></h1></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><?php echo $fname?></td>
                                                </tr>
                                                <tr>
                                                    <td class="tg-0lax" colspan="3"><?php echo $e_mail ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><?php echo $homeAdd ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        <hr style="border-top: #F0F0F0;">
                                    </div>
                                    <div class="modal-body">
                                        <center>
                                            <?php 
                                                $query = $pdo->prepare("SELECT * FROM accounts WHERE accountID = '$aid'");
                                                $query->execute();
                                            
                                                    while($rows = $query->fetch()){
                                                        $fname = $rows['fullName']; //new variable naming , inside is the coloumn name in DB
                                                        $e_mail = $rows['accEmail'];
                                                        $homeAdd = $rows['accAddress'];
                                                    
                                                    } //end selecting
                                            ?>
                                            
                                            <br>
                                                <form method ="post" action="checkout.php">
                                                    <button name= 'check' type='submit' style="text-decoration: none ; background:#F65D4E; color: white; border: none; padding: 10px; border-radius: 10px; cursor: pointer; font-weight:bold">PROCEED</button>
                                                </form>
                                            <br>
                                        </center>
                                    </div>
                                    </div>

                                    </div>

                                    <script>
                                    // Get the modal
                                    var modal = document.getElementById("myModal");

                                    // Get the button that opens the modal
                                    var btn = document.getElementById("myBtn");

                                    // Get the <span> element that closes the modal
                                    var span = document.getElementsByClassName("close")[0];

                                    // When the user clicks the button, open the modal 
                                    btn.onclick = function() {
                                    modal.style.display = "block";
                                    }

                                    // When the user clicks on <span> (x), close the modal
                                    span.onclick = function() {
                                    modal.style.display = "none";
                                    }

                                    // When the user clicks anywhere outside of the modal, close it
                                    window.onclick = function(event) {
                                    if (event.target == modal) {
                                    modal.style.display = "none";
                                    }
                                    }
                                    </script>
                                </td>
                            </tr>
                        </tbody>
                    </table>	
                    
                    <?php
                    }else{
                        echo "<h3>Your cart is empty!</h3>";
                        }
                    ?>
                </div>

                <div style="clear:both;"></div>

                <div class="message_box" style="margin:10px 0px;">
                    <?php echo $status; 
                    ?>
                </div>
                </center>
            </div>
        </div>
    </div>
</aside>

<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>