<?php
session_start();
if($_SERVER['REQUEST_METHOD']!='POST'){
    header('location:../producte.php');
    exit();
 }



$name=trim($_POST['name']);
$price=trim($_POST['price']);
$brand=trim($_POST['brand']);
$cat=trim($_POST['cat']);
$desc=trim($_POST['desc']);
$count=trim($_POST['count']);
$view=trim($_POST['view']);
    
if(empty($name)||empty($price)||empty($brand)||empty($cat)||empty($desc)||
empty($count)||empty($view)){
    $_SESSION['error'] = "All fields are required.";

header("Location: ../producte.php?name=add");
exit();

}
if(!preg_match('/^[a-zA-Z0-9\s\-_]{3,100}$/',$name)){//>>> ادخال اسم غير متوافق  غريب مثل 
      $_SESSION['error'] = "Invalid Product Name.";

header("Location: ../producte.php?name=add");
exit(); 
}
if(!is_numeric($price)||$price<=0){//التحقيق من السعر رقم
      $_SESSION['error'] = "Invalid Product Price.";

header("Location: ../producte.php?name=add");
exit(); 

}
if(!filter_var($count,FILTER_VALIDATE_INT)||$count<0){//التحقيق من الكميه عدد
    $_SESSION['error'] = "Invalid Product Count.";

header("Location: ../producte.php?name=add");
exit();  
}


// $name_img=$_FILES['img']['name'];
// // echo$name_img;
// $tmp_img=$_FILES['img']['tmp_name'];
// $size_img=$_FILES['img']['size'];

// $exp=explode(".",$name_img);
$imagesName=[];
$finfo=finfo_open(FILEINFO_MIME_TYPE);
if(empty($_FILES['imgs']['name'][0])){
    $_SESSION['error']='you shoud by add image';
  header("Location: ../producte.php?name=add");
exit();   
}
foreach($_FILES['imgs']['tmp_name'] as $kay=>$tmp){
$img_tmp =$tmp;

$img_name=$_FILES['imgs']['name'][$kay];
$img_size=$_FILES['imgs']['size'][$kay];
$img_error=$_FILES['imgs']['error'][$kay];
$extension=strtolower(pathinfo($img_name,PATHINFO_EXTENSION));
$allowed=["jpg","jpeg","webp","gif","png"];
//echo $new_name;
if($img_error!==UPLOAD_ERR_OK){
   $_SESSION['error'] = "Please choose an image.";

header("Location: ../producte.php?name=add");
exit(); 
}
if ($img_size>3*1024*1024) {
$_SESSION['error'] = " image size is too large.";

header("Location: ../producte.php?name=add");
exit();
}
if(!in_array($extension,$allowed)){
    $_SESSION['error']=' Inveld Image Extenstion';
    header("location:../producte.php?name=add");
    exit();

}

$type=finfo_file($finfo,$img_tmp);
$allowed_type=['image/jpeg','image/png','image/webp','image/gif'];
if(!in_array($type,$allowed_type)){
    $_SESSION['error']=' Inveld Image Extenstion type';
    header("location:../producte.php?name=add");
exit();

}
if(getimagesize($img_tmp)==false){
      $_SESSION['error']=' The File Is Not Image.';
    header("location:../producte.php?name=add");
exit();  
}
$new_name=time().rand(1,100000).".".$extension;
if(!move_uploaded_file($img_tmp,"../imgs/$new_name")){
    $_SESSION['error']=' Upload Failed.';
    header("location:../producte.php?name=add");
exit(); 
};


$imagesName[]=$new_name;

}//end for each

//$images=implode(",",$imagesName);
     
// // echo "</pre>";
// // print_r($exp);
// $end_name=strtolower(end($exp)) ;//تحويل اخر الامتداد لحروف صغيره
// // echo "</pre>";
// // echo$end_name;
// //$extension = strtolower( pathinfo($name_img, PATHINFO_EXTENSION));//داله مصصمه لنفس غرض الاكسبلود و الاند معا

// $extention=['jpg','jpeg','png','gif','webp'];

// if(!in_array($end_name,$extention)){
//     $_SESSION['error'] = "Only JPG, PNG, JPEG and GIF images are allowed.";

// header("Location: ../producte.php?name=add");
// exit();
   
// }

// if($_FILES['img']['error']!=UPLOAD_ERR_OK){//0داله للتحقق هل تم رفع الصوره اصلا مثل 
// $_SESSION['error'] = "Please choose an image.";

// header("Location: ../producte.php?name=add");
// exit();
// }
// if($size_img>3000000){//شرط بحيث حجم الصور لا يتعدى ال 3 ميجا بايت (3*1024*1024)
// $_SESSION['error'] = "Image size must be less than 3 MB.";

// header("Location: ../producte.php?name=add");
// exit();
   
// }


// $finfo=finfo_open(FILEINFO_MIME_TYPE);//متغير لحفظ داله فحص وقراءة الملف الحقيقي من الداخل
// $type=finfo_file($finfo,$tmp_img);//متغير لبدء عملية الفحص مع الامتداد المؤقت
// $allowed=['image/jpg','image/jpg','image/jpeg','image/png','image/webp','image/gif',];//اراي لعمل الفايلات المسموح بها

// if(!in_array($type,$allowed)){//شرط  لمعرفة اذ كان نوع الملف المفحوص متوافق مع الفايلات المسموح بها
// $_SESSION['error'] = "Only JPG, PNG,webp, JPEG and GIF images are allowed.";

// header("Location: ../producte.php?name=add");
// exit();
   

// }
// if(getimagesize($tmp_img)==false){
// $_SESSION['error'] = "The File Is Not Image.";

// header("Location: ../producte.php?name=add");
// exit();
   


// }
// $new_name=time().rand(1,100000).$name_img;
// move_uploaded_file($tmp_img,"../imgs/$new_name");


$conn=new mysqli("localhost","root","","project1");

$insert="INSERT INTO `product`(`name`, `price`, `brand`, `cat`, `count`, `desc`, `view`) 
VALUES (?,?,?,?,?,?,?)";
$stat=$conn->prepare($insert);//تجهيز الاستعلام
$stat->bind_param("siiiisi",$name,$price,$brand,$cat,$count,$desc,$view);//ربط المتغيرات بعلامات الاستفهام
if($stat->execute()){//تنفيذ الاستعلام
 $producte_id=$conn->insert_id;
 $insert_img="INSERT INTO image_pro ( img, producte_id)
 VALUES ( ?,? )"; 
 $stat_img=$conn->prepare($insert_img);
foreach($imagesName as $images){
   $stat_img->bind_param("si",$images,$producte_id);
$stat_img->execute();
}
$stat_img->close();
$_SESSION['success']="Product added successfully.";
 header('location:../producte.php');

}else{
     $_SESSION['error'] = "Database Error.";


}


$stat->close();//غلق الاستعلام
$conn->close();//غلق الاتصال بقاعة البيانات

//
exit();

?>