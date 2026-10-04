<?php

session_start();
$conn=new mysqli("localhost","root","","project1");
echo "<pre>";
//print_r($_POST);
echo "</pre>";
if($_SERVER['REQUEST_METHOD']=='POST'){
$email=trim($_POST['email']);
$password=trim($_POST['password']);

if(empty($email)||empty($password)){
 $_SESSION['error']="Email Or Password Is Incorrect";
             header("location:login.php");
    exit();

}else{
    $selct="SELECT * FROM user where email=?";
    $stat=$conn->prepare($selct);
    $stat->bind_param("s",$email);
    $stat->execute();
    $result=$stat->get_result();
if($result->num_rows>0){
    $row=$result->fetch_assoc();
    if(password_verify($password,$row['password'])){
    session_regenerate_id(true);

    $_SESSION['login']=$row['name'];
        $_SESSION['user_id']=$row['id'];

    if(isset($_POST['remmber_my'])){
     $token=uniqid();
    //echo$token;
$update="UPDATE `user` SET `token`=? WHERE id=?";
$stat=$conn->prepare($update);
$stat->bind_param("si",$token,$row['id']);
$stat->execute();
setcookie("remmber_my",$token,time()+(3600*24*4),"/");
 $_SESSION['user_id']=$row['id'];

    }
    header("location:dashboard.php");
    exit();

}else{    

    $_SESSION['error'] = "Invalid Email or Password.";

            header("Location: login.php");
            exit();
}

}else{   

     $_SESSION['error'] = "Invalid Email or Password.";

        header("Location: login.php");
        exit();
}



}
}else{
    exit();

header("Location: login.php");
    exit();

}

?>