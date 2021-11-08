<?php init_head(); ?>
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
                           <?php
                           if(empty($hoa_task_detail_id)) 
                           { ?>

                              <?php echo form_open_multipart('', array('role'=>'form','novalidate'=>'novalidate')); ?> 
                              <?php
                           } ?>
                           <div class="row">

                              <?php 
                              if(empty($task_id))
                              { ?>

                              <div class="col-md-10">
                                 <div class="form-group <?php echo form_error('task_id') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Task List', 'task_id'); ?> 
                                    <span class="required text-danger">*</span>
                                    
                                       <select name="task_id" class="form-control selectpicker" data-width="100%" data-none-selected-text="Nothing selected" data-live-search="true" tabindex="-98">
                                          
                                          <?php  
                                          $populateData = (!empty($task_hoa_data_array->task_id) && isset($task_hoa_data_array->task_id) ? $task_hoa_data_array->task_id : (!empty($this->input->post('task_id')) ? $this->input->post('task_id') : '' )); 
                                          ?>  


                                          <option value="">Select Task</option>
                                          
                                          <?php 
                                          foreach($all_task_array as $task_data_key => $task_array)
                                                {
                                                   $selected = ($task_array->id == $populateData) ? "selected" : ''; 
                                                   ?>
                                                   <option <?php echo $selected;?> value="<?php echo $task_array->id?>"><?php echo $task_array->name;?></option>
                                             <?php } ?>
                                       </select>

                                    <span class="small form-error"> <?php echo strip_tags(form_error('task_id')); ?> </span>
                                 </div>
                              </div>
                              <?php 
                              }
                              else
                              { ?>

                                 <div class="col-md-10">
                                    <div class="form-group <?php echo form_error('task_id') ? ' has-error' : ''; ?>">
                                       <?php echo  form_label('Task Name', 'task_id'); ?> 
                                       <label class="form-control"> <?php echo $task_data_array->name; ?> </label>
                                    </div>
                                 </div>
                                 <?php
                                 
                                 echo "<input type='hidden' name='task_id' value='".$task_id."'>";
                              } ?>



                              <div class="col-md-2">
                                 <div class="form-group">
                                   <label>HOA</label>
                                    <div class="form-control hoa_detail_togle">
                                       <?php $checked = $this->input->post('is_hoa') ? 'checked' : (isset($task_hoa_data_array->is_hoa) && $task_hoa_data_array->is_hoa == 1 ? 'checked' : '' );
                                          $togle_value = $checked ? 1 : 0 ;
                                       ?>
                                       <input type="checkbox"  name="is_hoa" value="<?php echo $togle_value; ?>" id="hoa"  data-toggle="toggle" class="hoa" <?php echo $checked;?> data-on="YES" data-off="NO" data-size="small">
                                      
                                    </div>
                                 </div>
                              </div>

                              

                              <div class="col-md-12 architectural_modification_div">
                                 <div class="form-group <?php echo form_error('architectural_modification') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Upload Architectural Modification', 'architectural_modification'); ?>

                                    <span class="required">*</span>

                                    <?php 
                                       $populateData = isset($task_hoa_data_array->architectural_modification) && $task_hoa_data_array->architectural_modification ? $task_hoa_data_array->architectural_modification :  ''; 
                                    ?> 

                                   <input type="file" name="architectural_modification" id="architectural_modification" class="form-control" value="<?php echo $populateData;?>">
                                   <span class="small form-error"> <?php echo strip_tags(form_error('architectural_modification')); ?> </span> 
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

                              <div class="clearfix"></div>

                              <div class="col-md-12">
                                 <div class="form-group <?php echo form_error('hoa_contact_info') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('HOA contact information', 'hoa_contact_info'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('hoa_contact_info') ? $this->input->post('hoa_contact_info') : (isset($task_hoa_data_array->hoa_contact_info) ? $task_hoa_data_array->hoa_contact_info :  '' );
                                    ?>

                                    <textarea name="hoa_contact_info" rows="5"  id="hoa_contact_info" class="form-control"><?php echo $populateData;?></textarea>

                                    <span class="small form-error"> <?php echo strip_tags(form_error('hoa_contact_info')); ?> </span>
                                 </div>
                              </div>

                              <div class="clearfix"></div>

                              <div class="col-md-3">
                                 <div class="form-group <?php echo form_error('hoa_payment') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Hoa Payment','hoa_payment'); ?>
                                    <select name="hoa_payment" class="form-control">
                                       <?php $populateData = (!empty($task_hoa_data_array->hoa_payment) && isset($task_hoa_data_array->hoa_payment) ? $task_hoa_data_array->hoa_payment : (!empty($this->input->post('hoa_payment')) ? $this->input->post('hoa_payment') : '' )); ?> 

                                       <option value="">Select One</option>
                                       <?php $selected = ($populateData == 'Ygrene') ? "selected" : ''; ?>
                                       <option <?php echo $selected;?> value="Ygrene">Ygrene </option>
                                       
                                       <?php $selected = ($populateData == 'Pace Funding') ? "selected" : ''; ?>
                                       <option <?php echo $selected;?> value="Pace Funding">Pace Funding </option>
                                       
                                       <?php $selected = ($populateData == 'Check') ? "selected" : ''; ?>
                                       <option <?php echo $selected;?> value="Check">Check  </option>
                                       
                                    </select>
                                 </div> 
                              </div>

                              <div class="col-md-3">
                                 <div class="form-group">
                                   <label for="permit">Permit</label>
                                    <div class="form-control hoa_detail_togle">
                                       <?php $checked = $this->input->post('permit') ? 'checked' : (isset($task_hoa_data_array->permit) && $task_hoa_data_array->permit == 1 ? 'checked' : '' );
                                        $togle_value = $checked ? 1 : 0 ;
                                       ?>
                                       <input type="checkbox"  name="permit" value="<?php echo $togle_value;?>" id="permit"  data-toggle="toggle" class="permit" <?php echo $checked;?> data-on="YES" data-off="NO" data-size="small">
                                    </div>
                                 </div>
                              </div>


                              <div class="col-md-3">
                                 <div class="form-group">
                                   <label for="modification">Modification</label>
                                    <div class="form-control hoa_detail_togle">
                                       <?php $checked = $this->input->post('modification') ? 'checked' : (isset($task_hoa_data_array->modification) && $task_hoa_data_array->modification == 1 ? 'checked' : '' );
                                          $togle_value = $checked ? 1 : 0 ;
                                       ?>
                                       <input type="checkbox"  name="modification" value="<?php echo $togle_value;?>" id="modification"  data-toggle="toggle" class="modification" <?php echo $checked;?> data-on="YES" data-off="NO" data-size="small">
                                    </div>
                                 </div>
                              </div>


                              <div class="col-md-3">
                                 <div class="form-group">
                                   <label for="engineering">Engineering</label>
                                    <div class="form-control hoa_detail_togle">
                                       <?php $checked = $this->input->post('engineering') ? 'checked' : (isset($task_hoa_data_array->engineering) && $task_hoa_data_array->engineering == 1 ? 'checked' : '' );
                                       $togle_value = $checked ? 1 : 0 ;
                                       ?>
                                       <input type="checkbox"  name="engineering" value="<?php echo $togle_value;?>" id="engineering"  data-toggle="toggle" class="engineering" <?php echo $checked;?> data-on="YES" data-off="NO" data-size="small">
                                    </div>
                                 </div>
                              </div>

                              <div class="clearfix"></div>


                              <div class="col-md-12 information_to_engineer_div">
                                 <div class="form-group <?php echo form_error('information_to_engineer') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Prep information & package to be sent to the engineer', 'information_to_engineer'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('information_to_engineer') ? $this->input->post('information_to_engineer') : (isset($task_hoa_data_array->information_to_engineer) ? $task_hoa_data_array->information_to_engineer :  '' );
                                    ?>

                                    <textarea name="information_to_engineer" rows="5"  id="information_to_engineer" class="form-control"><?php echo $populateData;?></textarea>

                                    <span class="small form-error"> <?php echo strip_tags(form_error('information_to_engineer')); ?> </span>
                                 </div>
                              </div>

                              <div class="clearfix"></div>

                              <hr>
                              <div class="clearfix"></div>
                              <?php
                              if(empty($hoa_task_detail_id)) 
                              {
                                 ?>
                                 <div class="col-md-9"> </div>
                                 <div class="col-md-3 text-left">
                                    <?php $saveUpdate = isset($id) ? 'Update Information' : 'Save Information'; ?>
                                    <input type="submit"  value="<?php echo ucfirst($saveUpdate);?>" class="btn btn-primary px-5">
                                    <a href="<?php echo base_url('admin/tasks/hoa_details_for_task');?>" class="btn btn-danger px-5"><?php echo 'Cancel'; ?></a>
                                 </div>
                                 
                                 <?php
                              } ?>


                              <div class="clearfix"></div>
                           </div>
                           <?php
                           if(empty($hoa_task_detail_id)) 
                           { ?>
                              <?php echo form_close();?>
                           <?php 
                           } ?>
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
<script>

$(document).ready(function()
{
   var hoa_value = parseInt($('#hoa').val());
   var engineering_value = parseInt($('#engineering').val());

   if(hoa_value !== 1){ $('.architectural_modification_div').hide(); }
   if(engineering_value !== 1){ $('.information_to_engineer_div').hide(); }

   $('#hoa').on('change',function(e)
   {
      if ($(this).prop('checked')==true)
      { 
         $(this).val(1);  
         $('.architectural_modification_div').slideDown();
      }
      else
      {
          $(this).val(0);  
          $('.architectural_modification_div').slideUp();
      }

   });

   $('#engineering').on('change',function(e)
   {
      if ($(this).prop('checked')==true)
      { 
         $(this).val(1);  
         $('.information_to_engineer_div').slideDown();
      }
      else
      {
          $(this).val(0);  
          $('.information_to_engineer_div').slideUp();
      }

   });

   $('#permit').on('change',function(e)
   {
      if ($(this).prop('checked')==true)
      { 
         $(this).val(1);  
      }
      else
      {
          $(this).val(0);  
      }
   });

   $('#modification').on('change',function(e)
   {
      if ($(this).prop('checked')==true)
      { 
         $(this).val(1);  
      }
      else
      {
          $(this).val(0);  
      }

   });

});

</script>
</body>
</html>
