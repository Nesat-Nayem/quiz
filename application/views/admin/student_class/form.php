<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row page">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-body">
        <?php echo form_open('', array('role'=>'form','novalidate'=>'novalidate')); ?>
        <div class="form-group <?php echo form_error('title') ? ' has-error' : ''; ?>">
          <?php echo form_label('Title', 'title'); ?>
          <span class="required">*</span>
          <input type="text" name="title" id="title" class="form-control" value="<?php echo set_value('title', isset($student_class->title) ? $student_class->title : ''); ?>">
          <span class="small form-error"> <?php echo strip_tags(form_error('title')); ?> </span>
        </div>
        <input type="submit" value="Save" class="btn btn-primary">
        <a href="<?php echo base_url('admin/student-class'); ?>" class="btn btn-dark">Cancel</a>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
