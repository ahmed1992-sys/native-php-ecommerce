<?php
include('include/masseg.php');
?>
<table class="table table-bordered table-striped text-center">
    <tr>
     <th>producte_id</th>

        <th >img</th>

         <!-- <th>controls</th> -->
    </tr>
    <?php 
        $conn=new mysqli("localhost","root","","project1");
         $select="SELECT * FROM `image_pro`";
        $reslt=$conn->query($select);
        while($row=$reslt->fetch_assoc()){
            
            ?>
    <tr>
        
<td><?=htmlspecialchars($row['producte_id'])  ?></td>

<td>

 <img src="imgs/<?= $row['img'] ?>" style="width: 150px;height: 75px; display:inline-block">

</td>

<!-- <td>
    <a href="?name=update&id=<?=htmlspecialchars($row['id'])  ?>">
    <button class="btn btn-primary">UPDET</button>
    </a>
    <a href="fun/delet.php?id=<?= htmlspecialchars($row['id'])  ?>">
        <button class="btn btn-danger">DELET</button>
</a>

</td> -->

<?php
        }

        ?>
    </tr>

</table>
<!-- <div >
<a href="?name=add"><button class="btn btn-success" >Add Producte</button></a>
</div> -->