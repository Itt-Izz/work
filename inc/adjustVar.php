
<?php require_once './php/connection.php';?>

<!-- Modal -->
<!-- Add Pages -->
<div class="modal fade" id="var" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span> </button>
        <h4 class="modal-title" id="myModalLabel2">Update Cost of tools</h4>
      </div>
      <div class="modal-body">
            <table class="table table-condensed" id="tabl">
              <form method="POST">  <?php
              $tls="SELECT * FROM tools";
              $tool=$con->query($tls); 
                  if ($tool->num_rows > 0) {
                     $i=1;
                  while($rw=$tool->fetch_assoc()){ ?>
                   <tr>
                  <td> <?php echo $rw['name']; ?></td>
                     <input type="hidden" class="tname" value="<?= $rw['name']?>">
                  <td><div class="form-group"><input type="number"class="tool"></div></td>
                  <td><input class="btn btn-success updateCost" value="Update"></td>
               </tr> <?php $i++;  } 
             } else{
                  echo "No tools to show";
                } ?>
                    </form>
          </table>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div> 