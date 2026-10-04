<?php
include('include/masseg.php');
?>
<form action="fun/multi_delete.php" method="POST">

<table class="table table-bordered table-striped text-center">
<tr>
        
        <th>
            <input type="checkbox" id="select_all" >    
id</th>
        <th>name</th>
        <th>price</th>
        <th>brand</th>
        <th>cat</th>
        <th class="w-25">img</th>
        <th>count</th>
        <th>desc</th>
         <th>controls</th>
    </tr>
    <?php 
        $conn=new mysqli("localhost","root","","project1");
         $select="SELECT * FROM `product`";
        $reslt=$conn->query($select);
        while($row=$reslt->fetch_assoc()){
            
            ?>
    <tr>
        
<td>
    <input type="checkbox" class="check_item"  name="selectall[]" value="<?= htmlspecialchars($row['id']) ?>">    
<?=htmlspecialchars($row['id'])  ?></td>
<td><?=htmlspecialchars($row['name'])  ?></td>
<td><?= htmlspecialchars($row['price']) ?></td>
<?php 
$id_brand=htmlspecialchars($row['brand'])  ;
$select_brand="SELECT * FROM brand where id='$id_brand'";
$reslt_brand=$conn->query($select_brand);
while($row_brand=$reslt_brand->fetch_assoc()){?>

<td><?=htmlspecialchars($row_brand['name'])?></td>
<?php
}

?>
<?php
$id_cat=htmlspecialchars($row['cat'])  ;
$select_cat="SELECT * FROM cat where id='$id_cat'";
$reslt_cat=$conn->query($select_cat);
while($row_cat=$reslt_cat->fetch_assoc()){?>

<td><?=htmlspecialchars($row_cat['name'])?></td>
<?php
}

?>
<td>
<?php
$pro_id=$row["id"];
//echo $pro_id;
$select_img="SELECT * FROM `image_pro` WHERE producte_id='$pro_id' ";
//echo $select_img;
$result_img=$conn->query($select_img);
//var_dump($result_img->num_rows);
while($row_img=$result_img->fetch_assoc()){
//     echo "<pre>";
// print_r($row_img['img']);
// echo "</pre>";
    ?>
 <img src="imgs/<?= $row_img['img'] ?>" style="width: 50px;height: 50px; display:inline-block">

<?php
};

//$images=explode(",",$row_img['img']);
//print_r($images);

    ?>

    

   
</td>
<td><?=htmlspecialchars($row['count'])  ?></td>
<td><?= $row['desc'] ?></td>

<td>  <?php
if(role=='owner'||role=='admin'){?>
    <a href="?name=update&id=<?=htmlspecialchars($row['id'])  ?>">
    <button type="button" class="btn btn-primary">UPDET</button>
    </a>
    <?php 
    }
     ?>
    <?php

    if(role=='owner'){?>
     <a href="fun/delet.php?id=<?= htmlspecialchars($row['id'])  ?>">
        <button type="button" class="btn btn-danger">DELET</button>
</a>
<?php
    }
    ?>
   

</td>

<?php
        }

        ?>
    </tr>

</table>   

     <a href="fun/multi_delete.php">

        <button type="submit" class="btn btn-danger" >Delete All Select</button>
</a>
</form>

<?php
if(role=='owner'||role=='admin'||role=='user'){?>



<div >
<a href="?name=add"><button class="btn btn-success" >Add Producte</button></a>
</div>
<?php
}
?>
<script>

</script>