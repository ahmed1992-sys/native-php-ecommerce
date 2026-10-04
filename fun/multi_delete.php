<?php
session_start();

echo"<pre>";
print_r($_POST['selectall']);
echo"</pre>";
if(!isset($_POST['selectall'])){
    $_SESSION['error']="Please Select At Least One Product";
    header("location:../producte.php");
    exit();
}
$conn=new mysqli("localhost","root","","project1");

foreach($_POST['selectall'] as $sel){
$select="SELECT img from image_pro where producte_id=?";
$stat=$conn->prepare($select);
$stat->bind_param("i",$sel);
$stat->execute();
$result=$stat->get_result();
while($row_img=$result->fetch_assoc()){
    if(file_exists("../imgs/".$row_img['img'])){
        unlink("../imgs/".$row_img['img']);//حذف الصور من السيرفر
    }
}
$delet="DELETE FROM `product` WHERE id=?";
$stat_pro=$conn->prepare($delet);
$stat_pro->bind_param("i",$sel);
$stat_pro->execute();
}
$_SESSION['success']="Product deleted successfully.";

header("location:../producte.php");

?>