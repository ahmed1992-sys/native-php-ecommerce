<?php
$conn=new mysqli("localhost","root","","project1");


?>
<?php
include('include/masseg.php');


?>
<form action="fun/do_addproduct.php" method="post" enctype="multipart/form-data">
   <div class="form-group">
        <label for="name" style="font-weight:bold;" >Product Name</label>
        <input type="text" class="form-control" name="name">
   </div>

<div class="form-group">
        <label for="name" style="font-weight:bold;" >Product price</label>
        <input type="number" class="form-control" name="price">
   </div>
   
  

   <div class="form-group">
        <label for="name" style="font-weight:bold;" >brand</label>
    <select name="brand" id="" class="form-control">
 <?php 
    $select_brand="SELECT * FROM brand";
    $reslt_brand=$conn->query($select_brand);
    while($row_brand=$reslt_brand->fetch_assoc()){?>

    <option value="<?= $row_brand['id'] ?>"><?= htmlspecialchars($row_brand['name']) ?></option>

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

    <option value="<?= $row_cat['id'] ?>"><?=htmlspecialchars($row_cat['name'])  ?></option>

    <?php

    }
    
    
    ?>
</select>  
   </div>

   <div class="form-group">
        <label for="name" style="font-weight:bold;" >Product img</label>
        <input type="file" class="form-control" name="imgs[]" multiple>
   </div>
   <div class="form-group">
        <label for="name" style="font-weight:bold;" >Product count</label>
        <input type="number" class="form-control" name="count">
   </div>
   <div class="form-group">
        <label for="name" style="font-weight:bold;" >descrbtion</label>
<textarea name="desc" id="" class="form-control" ></textarea>  
 </div>
<div class="form-group">
        <label for="name" style="font-weight:bold;" >view</label>
        <input type="number" class="form-control" name="view">
   </div>
      <a href="do_addproduct.php"> 
      <button type="submit" class="btn btn-success form-control ">Add Producte</button>
</a> 
   
</form>