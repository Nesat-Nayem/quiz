<?php defined('BASEPATH') OR exit('No direct script access allowed');
   if($this->session->flashdata('success')) {
      echo '<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" aria-label="close" data-dismiss="alert">&times;</button>
      <strong>Success!</strong> '.$this->session->flashdata("success").'
      </div>';
   }
?>
<div class="panel panel-default">
   <a href="<?php echo base_url('admin/medium/form');?>" class="btn btn-primary float-right">Add Medium</a>
   <div class="clearfix"></div>
   <hr>
   <table id="table" class="display table table-striped table-bordered" cellspacing="0" width="100%">
   <thead>
    <tr>
        <th>No</th>
        <th>Title</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Action</th>
    </tr>
</thead>

      <tbody>
      </tbody>
   </table>
</div>


<script>
$(document).ready(function() {
    $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('admin/medium/medium_list')?>",
            "dataType": "json",
            "type": "POST"
        },
        "columns": [
            {"data": "0"},
            {"data": "1"},
            {"data": "2"},
            {"data": "3"},
            {"data": "4"}
        ],
        "order": [[0, 'desc']]
    });
});
</script>



