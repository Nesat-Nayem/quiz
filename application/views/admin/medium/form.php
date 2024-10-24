<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <?php echo form_open_multipart('', array('role'=>'form')); ?>
            <div class="form-group <?php echo form_error('title') ? ' has-error' : ''; ?>">
               <?php echo form_label('Title', 'title'); ?>
               <span class="required">*</span>
               <?php 
               $populateData = $this->input->post('title') ? $this->input->post('title') : (isset($editData['title']) ? $editData['title'] : '');
               ?>
               <input type="text" name="title" id="title" class="form-control" value="<?php echo xss_clean($populateData);?>">
               <span class="small form-error"> <?php echo strip_tags(form_error('title')); ?> </span>
            </div>

            <?php 
            $populateData = isset($editData['id']) ? 'Update' : 'Save';
            ?>
            <input type="submit" name="<?php echo $populateData;?>" value="<?php echo $populateData;?>" class="btn btn-primary btn-lg">
            <a href="<?php echo base_url('admin/medium');?>" class="btn btn-dark btn-lg">Cancel</a>
            <?php echo form_close(); ?>
         </div>
      </div>
   </div>
</div>
