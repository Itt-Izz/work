  

<!-- Modal -->
<!-- Add Pages -->
<div class="modal fade" id="feed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="php/feed.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span> </button>
        <h3> <b> Leave your comment and sugestion below: </b></h3>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="">From: </label>
          <?php $staf=$_SESSION['name']; ?>
          <input type="" value="<?php echo $staf; ?>"  class="form-control" id="staf" disabled>
        </div>
          <textarea name="msgfeed" id="msgfeed" class="form-control" maxlength="20" minlength="5"  rows="8" data-gramm="true" data-gramm_editor="true" placeholder="Write your feedback here................" required></textarea>
        </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="sendFeed">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div> 