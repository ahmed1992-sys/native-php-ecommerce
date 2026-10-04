<?php
session_start();
$conn=new mysqli("localhost","root","","project1");
if(isset($_SESSION['login'])){

}elseif(isset($_COOKIE['remmber_my'])){
$token=$_COOKIE['remmber_my'];
$select="SELECT * FROM user where token =?";
$stat=$conn->prepare($select);
$stat->bind_param("s",$token);
$stat->execute();
$result=$stat->get_result();
if($user=$result->fetch_assoc()){
session_regenerate_id(true);
$_SESSION['login']=$user['name'];
}else{
     header("location:login.php");
exit();
}

}else{

    header("location:login.php");
    exit();

}
$usr_name=$_SESSION['login'];

$user_id=$_SESSION['user_id'];
$select_pre="SELECT*FROM pre where user_id=?";
$stat_pre=$conn->prepare($select_pre);
$stat_pre->bind_param("i",$user_id);
$stat_pre->execute();
$result_pre=$stat_pre->get_result();
$pre=$result_pre->fetch_assoc();
//echo $pre['prv_name'];
define("role",$pre['prv_name']);
//echo role;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"> WellCome <?= htmlspecialchars($usr_name,ENT_QUOTES,'UTF-8')  ?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="producte.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Producte</span></a>
            </li>
<li class="nav-item active">
                <a class="nav-link" href="image.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span> IMAGES</span></a>
            </li>
<li class="nav-item active">
                <a class="nav-link" href="messages.php">
                    <i class="fas fa-comments"></i>
                    <span> Messages</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>

        </ul>
        <!-- End of Sidebar -->