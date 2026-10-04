<?php

session_start();
// echo "<pre>";
// print_r($_FILES['images']['name']);
// echo "</pre>";

// var_dump(empty($_FILES['images']['name']));
// var_dump(empty($_FILES['images']['name'][0]));
// exit();
       $conn = new mysqli("localhost","root","","project1");
echo "<pre>";
//print_r($_FILES);
echo "<pre>";
echo "<pre>";
//print_r($_POST);
echo "<pre>";
echo "<br>";
//print_r($_GET);

echo "<br>";
$id=$_GET['id'];
$name=$_POST['name'];
$price=$_POST['price'];
$brand=$_POST['brand'];
$cat=$_POST['cat'];
$desc=$_POST['desc'];
$count=$_POST['count'];
$view=$_POST['view'];
if($_SERVER['REQUEST_METHOD']!='POST'){
     $_SESSION['error'] = "you shoud by enter data.";

header("Location: ../producte.php?name=update&&id=$id");
exit();
}
if(empty($name)||empty($price)||empty($brand)||empty($cat)||empty($desc)||empty($count)||empty($view)){
    $_SESSION['error'] = "All fields are required.";

header("Location: ../producte.php?name=update&&id=$id");
exit();

}
//=========================================//
//data image//

$imagesName=[];
if(!empty($_FILES['images']['name'][0])){

$finfo=finfo_open(FILEINFO_MIME_TYPE);

foreach($_FILES['images']['tmp_name'] as $key=>$tmp){

$img_tmp=$tmp;
$img_name=$_FILES['images']['name'][$key];
$img_error=$_FILES['images']['error'][$key];
$img_size=$_FILES['images']['size'][$key];
$extion=strtolower(pathinfo($img_name,PATHINFO_EXTENSION));

    $allowed=["jpg","jpeg","png","gif"];
    
    if(!in_array($extion,$allowed)){
       $_SESSION['error'] = "Only JPG, PNG, JPEG and GIF images are allowed.";

header("Location: ../producte.php?name=update&&id=$id");
exit();
    

    }
if($img_size>3*1024*1024){
    $_SESSION['error'] = "Image size must be less than 3 MB.";

header("Location: ../producte.php?name=update&&id=$id");
exit();
   
}
$type=finfo_file($finfo,$img_tmp);
$allowed_type=["image/jpg","image/jpeg","image/png","image/webp","image/gif",];

if(!in_array($type,$allowed_type)){
   $_SESSION['error'] = "Only JPG, PNG,webp, JPEG and GIF images are allowed.";

header("Location: ../producte.php?name=update&&id=$id");

exit();
      
}
if(getimagesize($img_tmp)===false){
    $_SESSION['error'] = "The File Is Not Image.";

header("Location: ../producte.php?name=update&&id=$id");
exit();
}
$new_name=time().rand(1,10000000).".".$extion;


if(!move_uploaded_file($img_tmp,"../imgs/$new_name")){
 $_SESSION['error']="Upload Failed";

header("Location: ../producte.php?name=update&&id=$id");
exit();

}
$imagesName[]=$new_name;
}//end for each
//imploud//
//$images=implode(",",$imagesName);
$update="UPDATE `product` SET `name`=?,
`price`=?,`brand`=?,`cat`=?,
`count`=?,`desc`=?,`view`=? 
WHERE id=?";
 $stat=$conn->prepare($update);
 $stat->bind_param("siiiisii",$name,$price,$brand,$cat,$count,$desc,$view,$id) ;  
if($stat->execute()){
    
$delete_img="DELETE FROM image_pro where producte_id=?";
$stat_del=$conn->prepare($delete_img);
$stat_del->bind_param("i",$id);
$stat_del->execute();
$insert_img="INSERT INTO image_pro(img,producte_id) VALUES (?,?) ";
$stat_img=$conn->prepare($insert_img);
foreach($imagesName as $image){
$stat_img->bind_param("si",$image,$id);
$stat_img->execute();

}
$stat_img->close();
$_SESSION['success']="Product updated successfully.";
$stat->close();
$conn->close();
header("location:../producte.php");
}


exit();

}

else{
$update="UPDATE `product` SET `name`=?,
`price`=?,`brand`=?,`cat`=?,
`count`=?,`desc`=?,`view`=? 
WHERE id=?";
$stat=$conn->prepare($update);
 $stat->bind_param("siiiisii",$name,$price,$brand,$cat,$count,$desc,$view,$id) ;  
if($stat->execute()){
$_SESSION['success']="Product updated successfully.";
$stat->close();
$conn->close();
header("location:../producte.php");
exit();

}
else{
     $_SESSION['error']="Database Error";

header("Location: ../producte.php?name=update&&id=$id");
exit();
}

}


















    

    




 


?>