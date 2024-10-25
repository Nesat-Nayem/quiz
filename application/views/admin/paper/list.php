<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="panel panel-default">
  <a href="<?php echo base_url("admin/paper/add"); ?>" class="btn btn-primary float-right">Add Paper</a>
  <div class="clearfix"></div>
  <hr>
  <table id="table" class="display table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Title</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($papers as $paper): ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $paper->title; ?></td>
        <td>
          <a href="<?php echo base_url("admin/paper/update/" . $paper->id); ?>" class="btn btn-primary btn-action mr-1">Edit</a>
          <a href="<?php echo base_url("admin/paper/delete/" . $paper->id); ?>" class="btn btn-danger btn-action mr-1 common_delete">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
