<?php
session_start();
$conn=new mysqli("localhost","root","","project1");
//print_r($_POST);
$name=trim($_POST['name']);
$email=trim($_POST['email']);
$password=trim($_POST['password']);
$re_password=trim($_POST['repeat_password']);
if(empty($name)){
$_SESSION['error']="Name is required.";
header("location:register.php");
exit();
}
if(strlen($name)<3){
  $_SESSION['error']="Name must be at least 3 characters.";
header("location:register.php");
exit();  
}
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
   $_SESSION['error']="Name must be at least 3 characters.";
header("location:register.php");
exit();   
}
$select="SELECT id FROM user where email=?";
$stat=$conn->prepare($select);
$stat->bind_param("s",$email);
$stat->execute();
$result=$stat->get_result();
if($result->num_rows>0){

    $_SESSION['error']="Email already exists.";

    header("Location: register.php");

    exit();
}
if(strlen($password<8)){
  $_SESSION['error']="Password must be at least 8 characters.";

    header("Location: register.php");

    exit();  
}
if($password!==$re_password){
   $_SESSION['error']="Passwords do not match.";

    header("Location: register.php");

    exit(); 
}


$pass_hash=password_hash($password,PASSWORD_DEFAULT);


$insert="INSERT INTO `user`( `name`, `email`, `password`)
 VALUES (?,?,?)";
 $stmt=$conn->prepare($insert);
$stmt->bind_param("sss",$name,$email,$pass_hash);
$stmt->execute();
header("location:login.php");

 



?>