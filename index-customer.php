<?php
    include_once "connection.php";
    include "includes/head.php";
    include "includes/nav-customer.php";

    include_once "session.php";
?>

<?php
    $status="";


    if (isset($_POST['code']) && $_POST['code']!=""){
        $code = $_POST['code'];

        $query = $pdo->prepare("SELECT * FROM product_info WHERE code ='$code'"); // can add additonal filtering use WHERE
        $query->execute();

        $row = $query->fetch();

        $name = $row['productName'];
        $code = $row['code'];
        $price = $row['productPrice'];
        $image = $row['productImage'];

        $cartArray = array(
            $code=>array(
            'productName'=>$name,
            'code'=>$code,
            'productPrice'=>$price,
            'quantity'=>1,
            'productImage'=>$image)
    );

    if(empty($_SESSION["shopping_cart"])) {
        $_SESSION["shopping_cart"] = $cartArray;
        $status = "<div class='alert success'>
                    <span class='closebtn'>&times;</span>  
                    Product is added to your cart
                    </div>";
    }else{
      if (isset($_POST['action']) && $_POST['action']=="remove"){

        if(!empty($_SESSION["shopping_cart"])) {
            foreach($_SESSION["shopping_cart"] as $key => $value) {
              if($_POST["code"] == $key){
              unset($_SESSION["shopping_cart"][$key]);
              $status = "<div class='alert' style='width: 70%;'>
              <span class='closebtn'>&times;</span>  
              Product is removed from your cart!
              </div>";}

              if(empty($_SESSION["shopping_cart"]))
            unset($_SESSION["shopping_cart"]);
            } 	
        }
      }else{
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if(in_array($code,$array_keys)) {
        $status = "<div class='alert success'>
                  <span class='closebtn'>&times;</span>  
                  Product is already added to your cart!
                  </div>";	
        } else {
        $_SESSION["shopping_cart"] = array_merge(
        $_SESSION["shopping_cart"],
        $cartArray
        );
        $status = "<div class='alert success'>
                <span class='closebtn'>&times;</span>  
                Product is added added to your cart!
                </div>";
        }
      }

        }
    }
?>
    
<article class="pad-layout">
<div class="title">
  <h1>Browse Products</h1>
</div>
<div class="scrollDiv">
    <div class="scrollContent">
        <center>
            <table class="tb-browse">
               <tbody>
                 <!--
                <?php
                  //if(!empty($_SESSION["shopping_cart"])) {
                      //$cart_count = count(array_keys($_SESSION["shopping_cart"]));
                      ?>
                      <div class="cart_div">
                      <a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart<span>
                      <?php //echo $cart_count; ?></span></a>
                      </div>
                      <?php
                  //}
                ?>-->

                <?php
                  $query = $pdo->prepare("SELECT * FROM product_info"); // can add additonal filtering use WHERE
                  $query->execute();

                  while($rows = $query->fetch()){
                      $image = $rows['productImage']; //new variable naming , inside is the coloumn name in DB
                      $name = $rows['productName'];
                      $prc = $rows['productPrice'];
                      $dscp = $rows['productDescription'];
                ?>
              
              <form method="post" action="">
                    <tr>
                        <?php echo "<input type='hidden' name='code' value=".$rows['code']." />" ?>
                        <th class = "image" rowspan="4"><img src="photos/<?php echo $image;?>" alt="Product Image" width="200px" style="border-radius: 10px; object-fit:scale-down;"></th>
                        <td class = "ttl"><h2 style="color:#F65D4E ;"><?php echo $name?></h2></td>
                      </tr>
                      <tr>
                        <td class = "price"><h2><?php echo "₱".$prc.".00"?></h2></td>
                      </tr>
                      <tr>
                        <td class = "descrp"><?php echo $dscp?></td>
                      </tr>
                      <tr>
                      <td><button type='submit' class='buy' style="text-decoration: none ; background:#F65D4E; color: white; border: none; padding: 10px; border-radius: 10px; cursor: pointer;">Add to Cart +</button></td>
                      </tr>
                   </form>
                        <?php } ?> <!-- for cont.. looping-->
                  

                <div style="clear:both;"></div>

                <div class="message_box" style="margin:10px 0px;">
                    <?php echo $status; ?>
                </div>
              </tbody>
            </table>
        </center>
    </div>
</div>
</article>

<?php
  include "includes/aside-customer.php";
?>

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

</body>
</html>