<?php

session_start();
if(!isset($_SESSION['login'])){//منع دخول صفحة الدليت
    header("location:../login.php");
    exit();
}
if(!isset($_GET['id'])){//تأكيد ان الاي دي اتبعت
    $_SESSION['error']='Invalid Request';
        header("location:../producte.php");
    exit();
}

$conn=new mysqli("localhost","root","","project1");
$id=$_GET['id'];
if(!filter_var($id,FILTER_VALIDATE_INT)){//بتأكد ان الاي دي رقم
     $_SESSION['error']='Invalid Producte ID';
        header("location:../producte.php");
    exit();

}
$select="SELECT img from image_pro where producte_id=?";
$stmt=$conn->prepare($select);
$stmt->bind_param("i",$id);
$stmt->execute();
$result=$stmt->get_result();

if($result->num_rows==0){
     $_SESSION['error']="Product Not Found";
    header("Location: ../producte.php");
    exit();
}
while($row=$result->fetch_assoc()){
    if(file_exists("../imgs/".$row['img'])){
        unlink("../imgs/".$row['img']);//حذف الصور من السيرفر
    }
}



  
$delet="DELETE FROM `product` WHERE id=?";
$stat=$conn->prepare($delet);
$stat->bind_param("i",$id);
if($stat->execute()){

$_SESSION['success']="Product deleted successfully.";

header("location:../producte.php");

}else{
     $_SESSION['error']="Database Error";

header("Location: ../producte.php?name=update&&id=$id");
exit();
}
$stat->close();
$conn->close();


?>