	<input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
<?php
	if($custom_task_data->input_type == 'yes_no')
	{
		?>

          <div class="col-md-12">

             <div class="form-group <?php echo form_error('yes_no') ? ' has-error' : ''; ?>">
                <?php echo  form_label('Selet Task Action Input Type', 'yes_no'); ?> 
                
                   <select name="yes_no" required class="form-control">
                      
                      <?php  
                      $populateData = (!empty($custom_task_data_array->yes_no) && isset($custom_task_data_array->yes_no) ? $custom_task_data_array->yes_no : (!empty($this->input->post('yes_no')) ? $this->input->post('yes_no') : '' )); 
                      ?>  
                      <option <?php echo $populateData == 'yes' ? 'selected' : '';?> value="yes">YES </option>
                      <option <?php echo $populateData == 'no' ? 'selected' : '';?> value="no">NO </option>
                   </select>

                <span class="small form-error"> <?php echo strip_tags(form_error('yes_no')); ?> </span>
             </div>
          </div>

		<?php
	}
	else if($custom_task_data->input_type == 'dropdown')
	{
		$dropdown_options = $custom_task_data->dropdown_options ? explode(',',$custom_task_data->dropdown_options) : array();
		?>

          <div class="col-md-12">
             <div class="form-group <?php echo form_error('dropdown') ? ' has-error' : ''; ?>">
                <?php echo  form_label('Staff Mail Templet', 'dropdown'); ?> 
                <span class="required text-danger">*</span>
                
                   <select name="dropdown" required class="form-control " >
                      
                      <?php  
                      $populateData = (!empty($custom_task_data_array->dropdown) && isset($custom_task_data_array->dropdown) ? $custom_task_data_array->dropdown : (!empty($this->input->post('dropdown')) ? $this->input->post('dropdown') : '' )); 
                      ?>  
                      
                      <?php 
                      foreach($dropdown_options as $templet_key => $dropdown_option)
                            {
                               $selected = ($dropdown_option == $populateData) ? "selected" : ''; 
                               ?>
                               <option <?php echo $selected;?> value="<?php echo $dropdown_option?>"><?php echo $dropdown_option;?></option>
                         <?php } ?>
                   </select>

                <span class="small form-error"> <?php echo strip_tags(form_error('dropdown')); ?> </span>
             </div>
          </div>


		<?php
	}
	else if($custom_task_data->input_type == 'textarea')
	{
		?>

        <div class="col-md-12">
             <div class="form-group <?php echo form_error('textarea') ? ' has-error' : ''; ?>">
                <?php echo  form_label('HOA contact information', 'textarea'); ?> 
                <span class="required text-danger">*</span>
                <?php 
                $populateData = $this->input->post('textarea') ? $this->input->post('textarea') : (isset($task_hoa_data_array->textarea) ? $task_hoa_data_array->textarea :  '' );
                ?>

                <textarea required name="textarea" rows="5"  id="textarea" class="form-control"><?php echo $populateData;?></textarea>

                <span class="small form-error"> <?php echo strip_tags(form_error('textarea')); ?> </span>
             </div>
         </div>

		<?php
	}
	else if($custom_task_data->input_type == 'file')
	{
		?>


          <div class="col-md-12 ">
             <div class="form-group <?php echo form_error('file') ? ' has-error' : ''; ?>">
                <?php echo  form_label('Upload Architectural Modification', 'file'); ?>

                <span class="required">*</span>

                <?php 
                   $populateData = isset($task_hoa_data_array->file) && $task_hoa_data_array->file ? $task_hoa_data_array->file :  ''; 
                ?> 

               <input type="file" required name="file" id="file" class="form-control" value="<?php echo $populateData;?>">
               <span class="small form-error"> <?php echo strip_tags(form_error('file')); ?> </span> 
               <?php 
               if($populateData)
               {
               ?> 
               <div class="">
                 <img class="image_preview popup" src="<?php echo base_url('assets/images/').$populateData; ?>">
               </div>
               <?php
               }
               ?>

             </div>
          </div>

		<?php
	}
	else if($custom_task_data->input_type == 'files')
	{
		?>

          <div class="col-md-12 ">
             <div class="form-group <?php echo form_error('files') ? ' has-error' : ''; ?>">
                <?php echo  form_label('Upload Architectural Modification', 'files'); ?>

                <span class="required">*</span>

                <?php 
                   $populateData = isset($task_hoa_data_array->files) && $task_hoa_data_array->files ? $task_hoa_data_array->files :  ''; 
                ?> 

               <input type="file" required name="files[]" id="files" class="form-control" multiple value="<?php echo $populateData;?>">
               <span class="small form-error"> <?php echo strip_tags(form_error('files')); ?> </span> 
               <?php 
               if($populateData)
               {
               ?> 
               <div class="">
                 <img class="image_preview popup" src="<?php echo base_url('assets/images/').$populateData; ?>">
               </div>
               <?php
               }
               ?>

             </div>
          </div>

		<?php
	}
  else if($custom_task_data->input_type == 'ci_view')
  {
    ?>
          <div class="col-md-12 ">
            
            <div class="form-group <?php echo form_error('is_hoa') ? ' has-error' : ''; ?> hoa_detail_togle">
              <?php echo  form_label('HOA Approval', 'contact_name'); ?> 
               <span class="required text-danger">*</span>
              <select name="is_hoa" required class="form-control hoa">
                <option selected value="NO"> NO</option>
                <option value="YES"> YES</option>
              </select>
            </div>

            <div class="w-100 hoa_task_div" style="display: none;">
              <div class="form-group <?php echo form_error('contact_name') ? ' has-error' : ''; ?>">
                <?php echo  form_label('HOA contact Name', 'contact_name'); ?> 
                <span class="required text-danger">*</span>
                <input type="text"  name="contact_name" value="" class="form-control">
              </div>

              <div class="form-group <?php echo form_error('contact_email') ? ' has-error' : ''; ?>">
                <?php echo  form_label('HOA contact Email', 'contact_email'); ?> 
                <span class="required text-danger">*</span>
                <input type="email"  name="contact_email" value="" class="form-control">
              </div>

              <div class="form-group <?php echo form_error('contact_number') ? ' has-error' : ''; ?>">
                <?php echo  form_label('HOA contact Number', 'contact_number'); ?> 
                <span class="required text-danger">*</span>
                <input type="text"  name="contact_number" value="" class="form-control">
              </div>

              <div class="form-group <?php echo form_error('architectural_modification') ? ' has-error' : ''; ?>">
                <?php echo  form_label('Submit Forms To HOA For Approval', 'approval_latter'); ?>
                <span class="required">*</span>
                <input type="file"  name="approval_latter" id="approval_latter" class="form-control">
              </div>
            </div>
          </div>

    <?php
  }
	else if($custom_task_data->input_type == 'none' OR $custom_task_data->input_type='')
	{

     $staff_id = get_staff_user_id();
     $role_id = staff_role($staff_id);

     $disabled =  $custom_task_data->role_id == $role_id OR is_admin($staff_id) == 1 ? '' : 'disabled';
     $disabled = '';
     $cl_mark_as_complete_task_action = $disabled ? 'other_user' : ' mark_as_complete_task_action';
                                    
		?>

      <a href="javascript:void(0)" <?php echo $disabled; ?> class="btn btn-block  btn-default <?php echo $cl_mark_as_complete_task_action; ?>" data-task_step_slug="<?php echo $task_step_slug; ?>"  data-task_id="<?php echo $task_id; ?>"  data-project_id="<?php echo $project_id; ?>">Mark As Complete</a>

		<?php
	}
?>