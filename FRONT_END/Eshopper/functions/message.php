<?php
//print_r($_POST);
$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$message=$_POST['message'];
$conn=new mysqli("localhost","root","","project1");
$insert="INSERT INTO messages (name,email,phone, message)
 VALUES (?,?,?,?) ";

$qurey=$conn->prepare($insert);
$stat=$qurey->bind_param('ssss',$name,$email,$phone,$message);

if($qurey->execute()){
echo "
<div class='alert alert-success text-center'>message sand successfully</div>
";
}else{
    echo $conn->error;
}
?>