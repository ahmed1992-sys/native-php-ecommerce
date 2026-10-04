<table class="table table-hover  table-bordered table-striped text-center">
    <thead class="table table-primary">
        <tr>
     <th>Id</th>

        <th >Name</th>
        <th >Email</th>
        <th >Phone</th>     
           
        <th >Created_Id</th>
        <th >Cotroles</th>

         <!-- <th>controls</th> -->
    </tr>
</thead>
    <?php 
    $id=1;
        $conn=new mysqli("localhost","root","","project1");
         $select="SELECT * FROM `messages`";
        $reslt=$conn->query($select);
        while($row=$reslt->fetch_assoc()){
            
            ?>
    <tr>
        <td><?=htmlspecialchars($id++)  ?></td>

<td><?=htmlspecialchars($row['name'])  ?></td>

<td>
<?=htmlspecialchars($row['email'])  ?>

</td>
<td><?=htmlspecialchars($row['phone'])  ?></td>
<td><?=htmlspecialchars($row['created_at'])  ?></td>
<td>
 <button type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#messageModal<?= $row['id'] ?>">
    View Message
</button>

<div class="modal fade"
     id="messageModal<?= $row['id'] ?>"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    View Message
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <?= htmlspecialchars($row['message']) ?>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                    Close
                </button>

            </div>

        </div>

    </div>

</div>
</td>


<?php
        }

        ?>
    </tr>

</table>
