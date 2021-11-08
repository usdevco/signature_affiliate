<form method="POST" action="<?php echo admin_url('tasks/task_progress_action/'.$project_id.'/'.$task_step_slug); ?>" id="task_progress_form"  enctype="multipart/form-data">
    
    <input type="hidden" name="project_id" value="<?php echo $project_id ?>">
    
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Action On Task Progress</h4>
    </div>
    
    <div class="modal-body">
      <div class="row"  id="modal_progress_form_old">
        <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
        <?php
          $custom_input_value =  isset($custom_task_data_array->custom_input_value) ? $custom_task_data_array->custom_input_value : NULL;
          $populateData =  $custom_input_value ? $custom_input_value : NULL; 

          if(isset($action_update) && $action_update)
          {
            echo '<input type="hidden" name="task_update" value="task_update">';
          }

        	if($custom_task_data->input_type == 'yes_no')
        	{
        		?>

                  <div class="col-md-12">

                     <div class="form-group <?php echo form_error('yes_no') ? ' has-error' : ''; ?>">
                        <?php echo  form_label($custom_task_data->name, 'yes_no'); ?> 
                        
                           <select name="yes_no" required class="form-control">
                              
                              <?php  
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
                        <?php echo  form_label($custom_task_data->name, 'dropdown'); ?> 
                        <span class="required text-danger">*</span>
                        
                           <select name="dropdown" required class="form-control " >
                              
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
                        <?php echo  form_label($custom_task_data->name, 'textarea'); ?> 
                        <span class="required text-danger">*</span>
                        
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
                        <?php echo  form_label($custom_task_data->name, 'file'); ?>

                        <span class="required">*</span>

                       <input type="file" required name="file" id="file" class="form-control" value="<?php echo $populateData;?>">
                       <span class="small form-error"> <?php echo strip_tags(form_error('file')); ?> </span> 
                       <?php 
                       if($populateData)
                       {
                       ?> 
                       <div class="">
                         <img class="image_preview popup" src="<?php echo base_url('uploads/tasks/').$task_id.'/'.$populateData; ?>">
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
                        <?php echo  form_label($custom_task_data->name, 'files'); ?>

                        <span class="required">*</span>

                        <?php 
                           $populateData = isset($task_hoa_data_array->files) && $task_hoa_data_array->files ? $task_hoa_data_array->files :  ''; 
                        ?> 

                       <input type="file" required name="files[]" id="files" class="form-control" multiple value="<?php echo $populateData;?>">
                       <span class="small form-error"> <?php echo strip_tags(form_error('files')); ?> </span> 
                       <?php 
                       if($populateData)
                       {
                        $populateData_array = json_decode($populateData);
                        foreach ($populateData_array as $key => $value) 
                          {
                            
                            ?> 
                          <div class="">
                            <img class="image_preview popup" src="<?php echo base_url('uploads/tasks/').$task_id.'/'.$value; ?>">
                          </div>
                            <?php
                          }
                       }
                       ?>

                     </div>
                  </div>

        		<?php
        	}
          else if($custom_task_data->input_type == 'ci_view')
          {
            $contact_name = NULL;
            $contact_email = NULL;
            $contact_number = NULL;
            $approval_latter = NULL;
            $is_hoa = NULL;

            if($populateData)
            {

              $populateData_array = json_decode($populateData);
              $is_hoa = $populateData_array['is_hoa'];
              if($is_hoa = 'yes')
              {
                 $hoa_details = $populateData_array['hoa_details'];

                  $contact_name = $hoa_details['contact_name'];
                  $contact_email = $hoa_details['contact_email'];
                  $contact_number = $hoa_details['contact_number'];
                  $approval_latter = $hoa_details['approval_latter'];

              }
          

            }
            ?>
                  <div class="col-md-12 ">
                    
                    <div class="form-group <?php echo form_error('is_hoa') ? ' has-error' : ''; ?> hoa_detail_togle">
                      <?php echo  form_label('HOA Approval', 'contact_name'); ?> 
                       <span class="required text-danger">*</span>
                      <select name="is_hoa" required class="form-control hoa">
                        <option <?php echo $is_hoa == 'no' ? 'selected' : '';?>  value="NO"> NO</option>
                        <option <?php echo $is_hoa == 'yes' ? 'selected' : '';?>  value="YES"> YES</option>
                      </select>
                    </div>

                    <div class="w-100 hoa_task_div" style="display: none;">
                      <div class="form-group <?php echo form_error('contact_name') ? ' has-error' : ''; ?>">
                        <?php echo  form_label('HOA contact Name', 'contact_name'); ?> 
                        <span class="required text-danger">*</span>
                        <input type="text"  name="contact_name" value="<?php echo $contact_name; ?>" class="form-control">
                      </div>

                      <div class="form-group <?php echo form_error('contact_email') ? ' has-error' : ''; ?>">
                        <?php echo  form_label('HOA contact Email', 'contact_email'); ?> 
                        <span class="required text-danger">*</span>
                        <input type="email"  name="contact_email" value="<?php echo $contact_email; ?>" class="form-control">
                      </div>

                      <div class="form-group <?php echo form_error('contact_number') ? ' has-error' : ''; ?>">
                        <?php echo  form_label('HOA contact Number', 'contact_number'); ?> 
                        <span class="required text-danger">*</span>
                        <input type="text"  name="contact_number" value="<?php echo $contact_number; ?>" class="form-control">
                      </div>

                      <div class="form-group <?php echo form_error('architectural_modification') ? ' has-error' : ''; ?>">
                        <?php echo  form_label('Submit Forms To HOA For Approval', 'approval_latter'); ?>
                        <span class="required">*</span>
                        <input type="file"  name="approval_latter" id="approval_latter" class="form-control">
                      </div>

                      <?php 
                       if($approval_latter)
                       {
                       ?> 
                       <div class="">
                         <img class="image_preview popup" src="<?php echo base_url('uploads/tasks/').$task_id.'/'.$approval_latter; ?>">
                       </div>
                       <?php
                       }
                       ?>

                    </div>
                  </div>

            <?php
          }
        	else if($custom_task_data->input_type == 'none' OR empty($custom_task_data->input_type))
        	{

           $staff_id = get_staff_user_id();
           $role_id = staff_role($staff_id);

           $disabled =  $custom_task_data->role_id == $role_id OR is_admin($staff_id) == 1 ? '' : 'disabled';
           $disabled = '';
           $cl_mark_as_complete_task_action = $disabled ? 'other_user' : ' mark_as_complete_task_action';
              
            if(isset($action_update) && $action_update)
            {  
              $cl_mark_as_incomplete_task_action = $disabled ? 'other_user' : ' mark_as_incomplete_task_action';
              ?> 
                <input type="hidden" name="update_task" value="update_task">
               <a href="javascript:void(0)" <?php echo $disabled; ?> class="btn btn-block  btn-danger <?php echo $cl_mark_as_incomplete_task_action; ?>" data-task_step_slug="<?php echo $task_step_slug; ?>"  data-task_id="<?php echo $task_id; ?>"  data-project_id="<?php echo $project_id; ?>">Mark As Incomplete</a>

              <?php
            }
            else
            { ?>
              <a href="javascript:void(0)" <?php echo $disabled; ?> class="btn btn-block  btn-default <?php echo $cl_mark_as_complete_task_action; ?>" data-task_step_slug="<?php echo $task_step_slug; ?>"  data-task_id="<?php echo $task_id; ?>"  data-project_id="<?php echo $project_id; ?>">Mark As Complete</a>

        		  <?php
            }
        	}
        ?>
      </div>
    </div>
    
    <div class="modal-footer">
       <button type="submit" name="save" value="Save"  class="btn btn-info modal_progress_btn_save" id="task_progress_submit">Save </button>
       <button type="submit" name="save_and_complete" value="Save And Complete"  class="btn btn-success modal_btn_save_and_complete" id="task_submit_complete">Save And Complete </button>
      <!-- <a href="javascript:void(0)" id="task_progress_submit"  class="btn btn-info">Submit</a> -->
    </div>
</form>