<?php
session_start();
print_r($_POST);
if($_SERVER['REQUEST_METHOD']=='POST'){
$product_id=$_POST['product_id'];
$quantity=$_POST['quantity'];

}else{
    header("Refresh:2;url=index.php");
        echo"<div class=alert alert-danger> you should b chooes at last one prodcute</div>";
exit();
}
$conn=new mysqli("localhost","root","","project1");
$select="SELECT * FROM product where id='$product_id'";
$result=$conn->query($select);
$row=$result->fetch_assoc();
if($quantity>$row['count']){
     echo "<div class='alert alert-danger'>
            The requested quantity is not available.
          </div>";

    exit();
}
if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=[];
}
if(isset($_SESSION['cart'][$product_id])){
$_SESSION['cart'][$product_id]+=$quantity;

}else{
   $_SESSION['cart'][$product_id]=$quantity; 

}
header("Location:../cart.php");
exit();
?>
