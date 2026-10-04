       <?php
$conn=new mysqli("localhost","root","","project1");
$id=$_GET['id'];
$select="SELECT * FROM product where id='$id'";
$reslt=$conn->query($select);
$row=$reslt->fetch_assoc();
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";
       include('include/masseg.php');

?>
<form action="fun/do_update.php?id=<?= htmlspecialchars($row['id']) ?>" method="post" enctype="multipart/form-data">
   <div class="form-group">
        <label for="name" style="font-weight:bold;" >Product Name</label>
        <input type="text" class="form-control" name="name" value="<?=htmlspecialchars($row['name'])  ?>">
   </div>

<div class="form-group">
        <label for="name" style="font-weight:bold;" >Product price</label>
        <input type="number" class="form-control" name="price" value="<?=htmlspecialchars($row['price'])  ?>">
   </div>
   
  

   <div class="form-group">
        <label for="name" style="font-weight:bold;" >brand</label>
    <select name="brand" id="" class="form-control">
 <?php 
    $select_brand="SELECT * FROM brand";
    $reslt_brand=$conn->query($select_brand);
    while($row_brand=$reslt_brand->fetch_assoc()){?>

    <option value="<?= htmlspecialchars($row_brand['id'])  ?>"
      <?php 
        if($row['brand']===$row_brand['id']){
            echo "selected";
        }
        
        ?>
        >
       
        <?=htmlspecialchars($row_brand['name'])  ?></option>

    <?php

    }
    
    
    ?>
    </select>  
 </div>

    <div class="form-group">

        <label for="name" style="font-weight:bold;" >catogry</label>

 <select name="cat" id="" class="form-control">
    <?php 
    $select_cat="SELECT * FROM cat";
    $reslt_cat=$conn->query($select_cat);
    while($row_cat=$reslt_cat->fetch_assoc()){?>

    <option value="<?=htmlspecialchars($row_cat['id'])  ?>"
    <?php 
        if($row['cat']===$row_cat['id']){
            echo "selected";
        }
        
        ?>
    
    ><?=htmlspecialchars($row_cat['name'])  ?></option>

    <?php

    }
    
    
    ?>
</select>  
   </div>

   <div class="form-group">
        <label for="name" style="font-weight:bold;" >Product img</label>
        <input type="file" class="form-control" name="images[]" multiple>
        <?php 
        //$pro_id=$row['id'];
        $select_img="SELECT * FROM image_pro";
        $reslt_img=$conn->query($select_img);
         while($row_img=$reslt->fetch_assoc()){
//  echo "<pre>";
//  print_r($row_img['img']);
//  echo "</pre>";
 ?>
       
        <img src="imgs/<?= $row_img['img'] ?>" style="width:50px;height: 50px;">

           <?php
 

         }
        //$images=explode(",",$row['img']);
         ?>
   </div>
   <div class="form-group">
        <label for="name" style="font-weight:bold;" >Product count</label>
        <input type="number" class="form-control" name="count" value="<?= htmlspecialchars($row['count']) ?>">
   </div>
   <div class="form-group">
        <label for="name" style="font-weight:bold;" >descrbtion</label>
<textarea name="desc" id="" class="form-control" ><?=htmlspecialchars($row['desc'] ) ?></textarea>  
 </div>
<div class="form-group">
        <label for="name" style="font-weight:bold;" >view</label>
        <input type="number" class="form-control" name="view" value="<?= htmlspecialchars($row['view']) ?>">
   </div>
      <a href="do_udate.php"> 
      <button type="submit" class="btn btn-success form-control ">Update Producte</button>
</a> 
   
</form>