<?php init_head();
?>
<?php echo app_stylesheet('assets/plugins/tagsinput/css','tagsinput.css'); ?>
app_stylesheet

<!-- <link rel="stylesheet" href="http://localhost/signature/assets/plugins/tagsinput/css/tagsinput.css"> -->


<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                   <div class="panel-body">
                      <div class="row _buttons">
                         <div class="col-md-12">
                           <h2> <?php echo $title; ?></h2>
                         </div>
                      </div>
                      <hr class="hr-panel-heading hr-10" />

                      <div class="clearfix"></div>

                      <div class="col-12 col-md-12 col-lg-12">
                         <div class="card">
                            <div class="card-body">

                              <?php echo form_open_multipart('', array('role'=>'form','novalidate'=>'novalidate')); ?> 

                                <div class="row">

                                  <div class="col-md-12">
                                     <div class="form-group <?php echo form_error('title') ? ' has-error' : ''; ?>">
                                        <?php echo  form_label('Custom Task Title', 'title'); ?> 
                                        <span class="required text-danger">*</span>
                                        <?php 
                                        $populateData = $this->input->post('title') ? $this->input->post('title') : (isset($custom_task_data_array->title) ? $custom_task_data_array->title :  '' );
                                        ?>

                                        <input type="text" name="title"  value="<?php echo $populateData;?>" id="title" class="form-control">

                                        <span class="small form-error"> <?php echo strip_tags(form_error('title')); ?> </span>
                                     </div>
                                  </div>

                                  <div class="clearfix"></div>

                                  <div class="col-md-12">
                                     <div class="form-group <?php echo form_error('role_id') ? ' has-error' : ''; ?>">
                                        <?php echo  form_label('Assign Task To User Role', 'role_id'); ?> 
                                        <span class="required text-danger">*</span>
                                        
                                           <select name="role_id" class="form-control selectpicker" data-width="100%" data-none-selected-text="Nothing selected" data-live-search="true" tabindex="-98">
                                              
                                              <?php  
                                              $populateData = (!empty($custom_task_data_array->role_id) && isset($custom_task_data_array->role_id) ? $custom_task_data_array->role_id : (!empty($this->input->post('role_id')) ? $this->input->post('role_id') : '' )); 
                                              ?>  


                                              <option value="">Assign Task To User Role</option>
                                              
                                              <?php 
                                              foreach($all_role_array as $role_array_key => $role_array)
                                                    {
                                                       $selected = ($role_array->roleid == $populateData) ? "selected" : ''; 
                                                       ?>
                                                       <option <?php echo $selected;?> value="<?php echo $role_array->roleid?>"><?php echo $role_array->name;?></option>
                                                 <?php } ?>
                                           </select>

                                        <span class="small form-error"> <?php echo strip_tags(form_error('role_id')); ?> </span>
                                     </div>
                                  </div>

                                  <div class="clearfix"></div>

                                  <div class="col-md-12">
                                     <div class="form-group <?php echo form_error('parent_task_id') ? ' has-error' : ''; ?>">
                                        <?php echo  form_label('Custom Task Parent Task', 'parent_task_id'); ?> 
                                        
                                           <select name="parent_task_id" class="form-control selectpicker" data-width="100%" data-none-selected-text="Nothing selected" data-live-search="true" tabindex="-98">
                                              
                                              <?php  
                                              $populateData = (!empty($custom_task_data_array->parent_task_id) && isset($custom_task_data_array->parent_task_id) ? $custom_task_data_array->parent_task_id : (!empty($this->input->post('parent_task_id')) ? $this->input->post('parent_task_id') : '' )); 
                                              ?>  


                                              <option value="">Select Parent Task</option>
                                              
                                              <?php 
                                              foreach($all_custom_task_array as $custom_task_array_key => $custom_task_array)
                                                    {
                                                       $selected = ($custom_task_array->id == $populateData) ? "selected" : ''; 
                                                       ?>
                                                       <option <?php echo $selected;?> value="<?php echo $custom_task_array->id?>"><?php echo $custom_task_array->title;?></option>
                                                 <?php } ?>
                                           </select>

                                        <span class="small form-error"> <?php echo strip_tags(form_error('parent_task_id')); ?> </span>
                                     </div>
                                  </div>

                                  <div class="clearfix"></div>


                                  <div class="col-md-12">
                                     <div class="form-group <?php echo form_error('task_step_id') ? ' has-error' : ''; ?>">
                                        <?php echo  form_label('Task Assign To Step', 'task_step_id'); ?> 
                                        <span class="required text-danger">*</span>
                                        
                                           <select name="task_step_id" class="form-control selectpicker" data-width="100%" data-none-selected-text="Nothing selected" data-live-search="true" tabindex="-98">
                                              
                                              <?php  
                                              $populateData = (!empty($custom_task_data_array->task_step_id) && isset($custom_task_data_array->task_step_id) ? $custom_task_data_array->task_step_id : (!empty($this->input->post('task_step_id')) ? $this->input->post('task_step_id') : '' )); 
                                              ?>  


                                              <option value="">Select Task Step</option>
                                              
                                              <?php 
                                              foreach($all_task_step_array as $task_step_array_key => $task_step_array)
                                                    {
                                                       $selected = ($task_step_array->id == $populateData) ? "selected" : ''; 
                                                       ?>
                                                       <option <?php echo $selected;?> value="<?php echo $task_step_array->id?>"><?php echo $task_step_array->title;?></option>
                                                 <?php } ?>
                                           </select>

                                        <span class="small form-error"> <?php echo strip_tags(form_error('task_step_id')); ?> </span>
                                     </div>
                                  </div>

                                  <div class="clearfix"></div>


                                  <div class="col-md-12">
                                     <div class="form-group <?php echo form_error('staff_mail_templet') ? ' has-error' : ''; ?>">
                                        <?php echo  form_label('Staff Mail Templet', 'staff_mail_templet'); ?> 
                                        
                                        
                                           <select name="staff_mail_templet" class="form-control selectpicker" data-width="100%" data-none-selected-text="Nothing selected" data-live-search="true" tabindex="-98">
                                              
                                              <?php  
                                              $populateData = (!empty($custom_task_data_array->staff_mail_templet) && isset($custom_task_data_array->staff_mail_templet) ? $custom_task_data_array->staff_mail_templet : (!empty($this->input->post('staff_mail_templet')) ? $this->input->post('staff_mail_templet') : '' )); 
                                              ?>  


                                              <option value="">Select Task Step</option>
                                              
                                              <?php 
                                              foreach($all_task_mail_templets as $templet_key => $task_mail_templet)
                                                    {
                                                       $selected = ($task_mail_templet->id == $populateData) ? "selected" : ''; 
                                                       ?>
                                                       <option <?php echo $selected;?> value="<?php echo $task_mail_templet->id?>"><?php echo $task_mail_templet->mail_templet;?></option>
                                                 <?php } ?>
                                           </select>

                                        <span class="small form-error"> <?php echo strip_tags(form_error('staff_mail_templet')); ?> </span>
                                     </div>
                                  </div>

                                  <div class="clearfix"></div>



                                  <div class="col-md-12">
                                     <div class="form-group <?php echo form_error('client_mail_templet') ? ' has-error' : ''; ?>">
                                        <?php echo  form_label('Client Mail Templet', 'client_mail_templet'); ?> 
                                        
                                        
                                           <select name="client_mail_templet" class="form-control selectpicker" data-width="100%" data-none-selected-text="Nothing selected" data-live-search="true" tabindex="-98">
                                              
                                              <?php  
                                              $populateData = (!empty($custom_task_data_array->client_mail_templet) && isset($custom_task_data_array->client_mail_templet) ? $custom_task_data_array->client_mail_templet : (!empty($this->input->post('client_mail_templet')) ? $this->input->post('client_mail_templet') : '' )); 
                                              ?>  


                                              <option value="">Select Task Step</option>
                                              
                                              <?php 
                                              foreach($all_task_mail_templets as $templet_key => $task_mail_templet)
                                                    {
                                                       $selected = ($task_mail_templet->id == $populateData) ? "selected" : ''; 
                                                       ?>
                                                       <option <?php echo $selected;?> value="<?php echo $task_mail_templet->id?>"><?php echo $task_mail_templet->mail_templet;?></option>
                                                 <?php } ?>
                                           </select>

                                        <span class="small form-error"> <?php echo strip_tags(form_error('client_mail_templet')); ?> </span>
                                     </div>
                                  </div>

                                  <div class="clearfix"></div>



                                  <div class="col-md-12">

                                     <div class="form-group <?php echo form_error('input_type') ? ' has-error' : ''; ?>">
                                        <?php echo  form_label('Selet Task Action Input Type', 'input_type'); ?> 
                                        
                                           <select name="input_type" class="form-control selectpicker" id="custom_task_input_type" data-width="100%" data-none-selected-text="Nothing selected" data-live-search="true" tabindex="-98">
                                              
                                              <?php  
                                              $populateData = (!empty($custom_task_data_array->input_type) && isset($custom_task_data_array->input_type) ? $custom_task_data_array->input_type : (!empty($this->input->post('input_type')) ? $this->input->post('input_type') : '' )); 
                                              ?>  


                                              <option <?php echo $populateData == '' ? 'selected' : '';?> value="">Select Input Type </option>
                                              <option <?php echo $populateData == 'none' ? 'selected' : '';?> value="none">None </option>
                                              <option <?php echo $populateData == 'yes_no' ? 'selected' : '';?> value="yes_no">Yes Or No </option>
                                              <option <?php echo $populateData == 'dropdown' ? 'selected' : '';?> value="dropdown">Dropdown</option>
                                              <option <?php echo $populateData == 'textarea' ? 'selected' : '';?> value="textarea">Text Area</option>
                                              <option <?php echo $populateData == 'file' ? 'selected' : '';?> value="file">File </option>
                                              <option <?php echo $populateData == 'files' ? 'selected' : '';?> value="files">Multiple Files </option>
                                              
                                             
                                           </select>

                                        <span class="small form-error"> <?php echo strip_tags(form_error('input_type')); ?> </span>
                                     </div>
                                  </div>


                                  <div class="col-md-12" id="dropdown_options">

                                     <div class="form-group <?php echo form_error('dropdown_options') ? ' has-error' : ''; ?>">
                                        <?php echo  form_label('Options For Dropdown', 'dropdown_options'); ?>
                                              <?php  
                                              $populateData = (!empty($custom_task_data_array->dropdown_options) && isset($custom_task_data_array->dropdown_options) ? $custom_task_data_array->dropdown_options : (!empty($this->input->post('dropdown_options')) ? $this->input->post('dropdown_options') : '' )); 
                                              ?>  

                                              <input type="text" name="dropdown_options" class="form-control" value="<?php echo $populateData; ?>" data-role="tagsinput" >

                                        <span class="small form-error"> <?php echo strip_tags(form_error('dropdown_options')); ?> </span>
                                     </div>
                                  </div>



                                  <div class="col-md-12">

                                     <div class="form-group <?php echo form_error('input_type_label') ? ' has-error' : ''; ?>">
                                        <?php echo  form_label('Label For Input Type', 'input_type_label'); ?>
                                              <?php  
                                              $populateData = (!empty($custom_task_data_array->input_type_label) && isset($custom_task_data_array->input_type_label) ? $custom_task_data_array->input_type_label : (!empty($this->input->post('input_type_label')) ? $this->input->post('input_type_label') : '' )); 
                                              ?>  

                                              <input type="text" name="input_type_label" class="form-control" value="<?php echo $populateData; ?>">

                                        <span class="small form-error"> <?php echo strip_tags(form_error('input_type_label')); ?> </span>
                                     </div>
                                  </div>


                                  <div class="col-md-12">

                                     <div class="form-group <?php echo form_error('input_type_help_text') ? ' has-error' : ''; ?>">
                                        <?php echo  form_label('Help Text For Input Type', 'input_type_help_text'); ?>                                             
                                              <?php  
                                              $populateData = (!empty($custom_task_data_array->input_type_help_text) && isset($custom_task_data_array->input_type_help_text) ? $custom_task_data_array->input_type_help_text : (!empty($this->input->post('input_type_help_text')) ? $this->input->post('input_type_help_text') : '' )); 
                                              ?>  

                                              <input type="text" name="input_type_help_text" class="form-control" value="<?php echo $populateData; ?>">

                                        <span class="small form-error"> <?php echo strip_tags(form_error('input_type_help_text')); ?> </span>
                                     </div>
                                  </div>



                                  <hr>
                                  <div class="clearfix"></div>

                                  <div class="col-md-8"> </div>
                                   <div class="col-md-4 text-left">
                                      <?php $saveUpdate = isset($custom_task_id) ? 'Update Information' : 'Save Information'; ?>
                                      <input type="submit"  value="<?php echo ucfirst($saveUpdate);?>" class="btn btn-primary px-5">
                                      <a href="<?php echo base_url('admin/tasks/custom_task');?>" class="btn btn-danger "><?php echo 'Cancel'; ?></a>
                                   </div>
                                     
                                  <div class="clearfix"></div>
                                </div>
                              <?php echo form_close();?>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
        </div> 
    </div>          
</div>
<?php init_tail(); ?>
<?php echo app_script('assets/plugins/tagsinput/js','tagsinput.js'); ?>


<script type="text/javascript">

$(document).ready(function()
{

  if($('#custom_task_input_type').val() != 'dropdown')
  {
    $('#dropdown_options').hide();
  }

  $('#custom_task_input_type').on('change',function(e)
   {
      input_tags($(this).val());
   });
});

 function input_tags(val)
 {
   if (val == 'dropdown')
      { 
          $('#dropdown_options').slideDown();
      }
      else
      {
           $('#dropdown_options').slideUp();
      }
 }

</script>



 ?>
