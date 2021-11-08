<?php init_head(); 
$no_of_option = $no_of_option ? $no_of_option - 1 : 0;
$update = isset($question_id) && $question_id ? '_update' : '';
?>
<style type="text/css">
    table.table th { min-width: 180px; text-align: center; background-color: rgb(35 35 35 / 97%);     color: #fff !important; opacity: 0.9;}
    section.d-none { display: none; }
</style>
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


                              <div class="col-md-6">
                                 <div class="form-group <?php echo form_error('client_name') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Client Name', 'client_name'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('client_name') ? $this->input->post('client_name') : (isset($check_list_data->client_name) ? $check_list_data->client_name :  '' );
                                    ?>
                                    <input type="text" value="<?php echo $populateData; ?>" name="client_name" id="client_name" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('client_name')); ?> </span>
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-group <?php echo form_error('date') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Date', 'date'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('date') ? $this->input->post('date') : (isset($check_list_data->date) ? $check_list_data->date :  '' );
                                    ?>
                                    <input type="text" name="date" value="<?php echo $populateData; ?>" id="date" class="form-control datepicker" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('date')); ?> </span>
                                 </div>
                              </div>


                              <div class="clearfix"></div>

                              <div class="col-md-4">
                                 <div class="form-group <?php echo form_error('city') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('City', 'city'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('city') ? $this->input->post('city') : (isset($check_list_data->city) ? $check_list_data->city :  '' );
                                    ?>
                                    <input type="text" name="city" value="<?php echo $populateData; ?>"  id="city" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('city')); ?> </span>
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group <?php echo form_error('state') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('State', 'state'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('state') ? $this->input->post('state') : (isset($check_list_data->state) ? $check_list_data->state :  '' );
                                    ?>
                                    <input type="text" name="state" value="<?php echo $populateData; ?>"  id="state" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('state')); ?> </span>
                                 </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group <?php echo form_error('zip') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Zip', 'zip'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('zip') ? $this->input->post('zip') : (isset($check_list_data->zip) ? $check_list_data->zip :  '' );
                                    ?>
                                    <input type="number" name="zip" value="<?php echo $populateData; ?>"  id="zip" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('zip')); ?> </span>
                                 </div>
                              </div>


                              <div class="clearfix"></div>

                              <div class="col-md-12">
                                 <div class="form-group <?php echo form_error('address') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Full Address', 'address'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('address') ? $this->input->post('address') : (isset($check_list_data->address) ? $check_list_data->address :  '' );
                                    ?>

                                    <textarea name="address" rows="2" value="<?php echo $populateData; ?>"   id="address" class="form-control"><?php echo $populateData;?></textarea>
                                    <span class="small form-error"> <?php echo strip_tags(form_error('address')); ?> </span>
                                 </div>
                              </div>

                              <div class="clearfix"></div>


                              <div class="col-md-6">
                                 <div class="form-group <?php echo form_error('contact_no') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Contact No', 'contact_no'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('contact_no') ? $this->input->post('contact_no') : (isset($check_list_data->contact_no) ? $check_list_data->contact_no :  '' );
                                    ?>
                                    <input type="number" name="contact_no" value="<?php echo $populateData; ?>"  id="contact_no" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('contact_no')); ?> </span>
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-group <?php echo form_error('email') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Email', 'email'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('email') ? $this->input->post('email') : (isset($check_list_data->email) ? $check_list_data->email :  '' );
                                    ?>
                                    <input type="email" name="email" value="<?php echo $populateData; ?>"  id="email" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('email')); ?> </span>
                                 </div>
                              </div>


                              <div class="clearfix"></div>


                              <div class="col-md-6">
                                 <div class="form-group <?php echo form_error('manufacturer_1') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Manufacturer', 'manufacturer_1'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('manufacturer_1') ? $this->input->post('manufacturer_1') : (isset($check_list_data->manufacturer_1) ? $check_list_data->manufacturer_1 :  '' );
                                    ?>
                                    <input type="text" name="manufacturer_1" value="<?php echo $populateData; ?>"  id="manufacturer_1" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('manufacturer_1')); ?> </span>
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-group <?php echo form_error('po_1') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Po', 'po_1'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('po_1') ? $this->input->post('po_1') : (isset($check_list_data->po_1) ? $check_list_data->po_1 :  '' );
                                    ?>
                                    <input type="text" name="po_1" value="<?php echo $populateData; ?>"  id="po_1" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('po_1')); ?> </span>
                                 </div>
                              </div>


                              <div class="clearfix"></div>

                              <div class="col-md-6">
                                 <div class="form-group <?php echo form_error('manufacturer_2') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Manufacturer', 'manufacturer_2'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('manufacturer_2') ? $this->input->post('manufacturer_2') : (isset($check_list_data->manufacturer_2) ? $check_list_data->manufacturer_2 :  '' );
                                    ?>
                                    <input type="text" name="manufacturer_2" value="<?php echo $populateData; ?>"  id="manufacturer_2" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('manufacturer_2')); ?> </span>
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-group <?php echo form_error('po_2') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Po', 'po_2'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('po_2') ? $this->input->post('po_2') : (isset($check_list_data->po_2) ? $check_list_data->po_2 :  '' );
                                    ?>
                                    <input type="text" name="po_2" value="<?php echo $populateData; ?>"  id="po_2" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('po_2')); ?> </span>
                                 </div>
                              </div>


                              <div class="clearfix"></div>


                              <?php $checked = $this->input->post('togle_btn') ? 'checked' : (isset($check_list_data->is_hoa) && $check_list_data->is_hoa == 1 ? 'checked' : '' );
                                 $togle_value = $checked ? 1 : 0 ;
                              ?>

                              <div class="col-md-12">
                                 <div class="table-responsive">
                                 <table class="table  table-striped table-bordered no-footer dtr-inline table-responsive text-center">
                                    <thead class="table-dark text-center">
                                       <th>MARK</th>
                                       <th>OPENS & CLOSES</th>
                                       <th>LOCKS</th>
                                       <th>SCREWS</th>
                                       <th> INT. CAULKING</th>
                                       <th>STICKERS</th>
                                       <th>EXT. CAULKING</th>
                                       <th>SCREENS</th>
                                       <th>COVERS</th>
                                       <th>INITIALS</th>
                                       <th>ACTION</th>
                                    </thead>

                                    <tbody class=" text-center after_ticket_section">
                                       <tr>

                                          <td></td>

                                          <td>
                                             <?php $populateData = isset($option_array[0]['open_close']) && $option_array[0]['open_close'] ? $option_array[0]['open_close'] : 'YES';  ?>
                                             <label class="radio-inline"><input value='YES' type="radio" name="open_close[0]" <?php echo $populateData == 'YES' ? 'checked' : ''; ?>>Yes</label>
                                             <label class="radio-inline"><input value='NO' type="radio" name="open_close[0]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?>>No</label>
                                          </td>

                                          <td>
                                             <?php $populateData = isset($option_array[0]['lock']) && $option_array[0]['lock'] ? $option_array[0]['lock'] : 'YES';  ?>

                                             <label class="radio-inline"><input value='YES' type="radio" name="lock[0]" <?php echo $populateData == 'YES' ? 'checked' : ''; ?> >Yes</label>
                                             <label class="radio-inline"><input value='NO' type="radio" name="lock[0]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?>>No</label>
                                          </td>

                                          <td>
                                             <?php $populateData = isset($option_array[0]['screws']) && $option_array[0]['screws'] ? $option_array[0]['screws'] : 'YES';  ?>

                                             <label class="radio-inline"><input value='YES' type="radio" name="screws[0]" <?php echo $populateData == 'YES' ? 'checked' : ''; ?>>Yes</label>
                                             <label class="radio-inline"><input value='NO' type="radio" name="screws[0]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?>>No</label>  
                                          </td>

                                          <td>
                                             <?php $populateData = isset($option_array[0]['int_caulking']) && $option_array[0]['int_caulking'] ? $option_array[0]['int_caulking'] : 'YES';  ?>

                                             <label class="radio-inline"><input value='YES' type="radio" name="int_caulking[0]" <?php echo $populateData == 'YES' ? 'checked' : ''; ?>>Yes</label>
                                             <label class="radio-inline"><input value='NO' type="radio" name="int_caulking[0]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?>>No</label>
                                          </td>

                                          <td>
                                             <?php $populateData = isset($option_array[0]['stickers']) && $option_array[0]['stickers'] ? $option_array[0]['stickers'] : 'YES';  ?>

                                             <label class="radio-inline"><input value='YES' type="radio" name="stickers[0]" <?php echo $populateData == 'YES' ? 'checked' : ''; ?>>Yes</label>

                                             <label class="radio-inline"><input value='NO' type="radio" name="stickers[0]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?>>No</label>
                                          </td>

                                          <td>
                                             <?php $populateData = isset($option_array[0]['ext_caulking']) && $option_array[0]['ext_caulking'] ? $option_array[0]['ext_caulking'] : 'YES';  ?>

                                             <label class="radio-inline"><input value='YES' type="radio" name="ext_caulking[0]" <?php echo $populateData == 'YES' ? 'checked' : ''; ?> >Yes</label>
                                             <label class="radio-inline"><input value='NO' type="radio" name="ext_caulking[0]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?> >No</label>
                                          </td>

                                          <td>
                                             <?php $populateData = isset($option_array[0]['screens']) && $option_array[0]['screens'] ? $option_array[0]['screens'] : 'YES';  ?>

                                             <label class="radio-inline"><input value='YES' type="radio" name="screens[0]" <?php echo $populateData == 'YES' ? 'checked' : ''; ?> >Yes</label>

                                             <label class="radio-inline"><input value='NO' type="radio" name="screens[0]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?> >No</label>
                                             <label class="radio-inline"><input value='NA' type="radio" name="screens[0]" <?php echo $populateData == 'NA' ? 'checked' : ''; ?> >N/A</label>
                                          </td>

                                          <td>
                                             <?php $populateData = isset($option_array[0]['covers']) && $option_array[0]['covers'] ? $option_array[0]['covers'] : 'YES';  ?>

                                             <label class="radio-inline"><input value='YES' type="radio" name="covers[0]" <?php echo $populateData == 'YES' ? 'checked' : ''; ?> >Yes</label>
                                             <label class="radio-inline"><input value='NO' type="radio" name="covers[0]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?> >No</label>
                                             <label class="radio-inline"><input value='NA' type="radio" name="covers[0]" <?php echo $populateData == 'NA' ? 'checked' : ''; ?> >N/A</label>
                                          </td>

                                          <td></td>
                                          <td> - </td>

                                       </tr>



                                      <?php 
                                      if($option_array)
                                      { 
                                          unset($option_array[0]);
                                          $i = 0;
                                       
                                          foreach ($option_array as  $value_array) 
                                          { 
                                             $i++;

                                             ?>

                                             <tr>

                                                <td></td>

                                                <td>
                                                   <?php $populateData = isset($value_array['open_close']) && $value_array['open_close'] ? $option_array[$i]['open_close'] : 'YES';  ?>

                                                   <label class="radio-inline"><input value='YES' type="radio" name="open_close[<?php echo $i; ?>]"  <?php echo $populateData == 'YES' ? 'checked' : ''; ?> >Yes</label>
                                                   <label class="radio-inline"><input value='NO' type="radio" name="open_close[<?php echo $i; ?>]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?> >No</label>
                                                </td>

                                                <td>
                                                   <?php $populateData = isset($value_array['lock']) && $value_array['lock'] ? $value_array['lock'] : 'YES';  ?>

                                                   <label class="radio-inline"><input value='YES' type="radio" name="lock[<?php echo $i; ?>]"  <?php echo $populateData == 'YES' ? 'checked' : ''; ?> >Yes</label>
                                                   <label class="radio-inline"><input value='NO' type="radio" name="lock[<?php echo $i; ?>]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?> >No</label>
                                                </td>

                                                <td>
                                                   <?php $populateData = isset($value_array['screws']) && $value_array['screws'] ? $value_array['screws'] : 'YES';  ?>

                                                   <label class="radio-inline"><input value='YES' type="radio" name="screws[<?php echo $i; ?>]"  <?php echo $populateData == 'YES' ? 'checked' : ''; ?> >Yes</label>
                                                   <label class="radio-inline"><input value='NO' type="radio" name="screws[<?php echo $i; ?>]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?> >No</label>  
                                                </td>

                                                <td>
                                                   <?php $populateData = isset($value_array['int_caulking']) && $value_array['int_caulking'] ? $value_array['int_caulking'] : 'YES';  ?>

                                                   <label class="radio-inline"><input value='YES' type="radio" name="int_caulking[<?php echo $i; ?>]"  <?php echo $populateData == 'YES' ? 'checked' : ''; ?> >Yes</label>
                                                   <label class="radio-inline"><input value='NO' type="radio" name="int_caulking[<?php echo $i; ?>]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?> >No</label>
                                                </td>

                                                <td>
                                                   <?php $populateData = isset($value_array['stickers']) && $value_array['stickers'] ? $value_array['stickers'] : 'YES';  ?>

                                                   <label class="radio-inline"><input value='YES' type="radio" name="stickers[<?php echo $i; ?>]"  <?php echo $populateData == 'YES' ? 'checked' : ''; ?> >Yes</label>
                                                   <label class="radio-inline"><input value='NO' type="radio" name="stickers[<?php echo $i; ?>]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?> >No</label>
                                                </td>

                                                <td>
                                                   <?php $populateData = isset($value_array['ext_caulking']) && $value_array['ext_caulking'] ? $value_array['ext_caulking'] : 'YES';  ?>

                                                   <label class="radio-inline"><input value='YES' type="radio" name="ext_caulking[<?php echo $i; ?>]"  <?php echo $populateData == 'YES' ? 'checked' : ''; ?> >Yes</label>
                                                   <label class="radio-inline"><input value='NO' type="radio" name="ext_caulking[<?php echo $i; ?>]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?> >No</label>
                                                </td>

                                                <td>
                                                   <?php $populateData = isset($value_array['screens']) && $value_array['screens'] ? $value_array['screens'] : 'YES';  ?>

                                                   <label class="radio-inline"><input value='YES' type="radio" name="screens[<?php echo $i; ?>]"  <?php echo $populateData == 'YES' ? 'checked' : ''; ?> >Yes</label>
                                                   <label class="radio-inline"><input value='NO' type="radio" name="screens[<?php echo $i; ?>]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?> >No</label>
                                                   <label class="radio-inline"><input value='NA' type="radio" name="screens[<?php echo $i; ?>]" <?php echo $populateData == 'NA' ? 'checked' : ''; ?> >N/A</label>
                                                </td>

                                                <td>
                                                   <?php $populateData = isset($value_array['covers']) && $value_array['covers'] ? $value_array['covers'] : 'YES';  ?>

                                                   <label class="radio-inline"><input value='YES' type="radio" name="covers[<?php echo $i; ?>]"  <?php echo $populateData == 'YES' ? 'checked' : ''; ?> >Yes</label>
                                                   <label class="radio-inline"><input value='NO' type="radio" name="covers[<?php echo $i; ?>]" <?php echo $populateData == 'NO' ? 'checked' : ''; ?> >No</label>
                                                   <label class="radio-inline"><input value='NA' type="radio" name="covers[<?php echo $i; ?>]" <?php echo $populateData == 'NA' ? 'checked' : ''; ?> >N/A</label>
                                                </td>

                                                <td></td>
                                                <td> 
                                                   <a href="javascript:void(0)" class="btn btn-danger  btn-block remove_block_btn<?php echo $update; ?>"><i class="fa fa-times-circle mr-2"></i>Remove</a> 
                                                </td>

                                             </tr>
                                             <?php
                                          }
                                       }
                                       ?>

                                    </tbody>
                                 </table>
                                 </div>

                              </div>
                              <div class="col-md-12 mb-5">

                                 <a href="javascript:void(0)" class="btn btn-primary btn-block add-more"  data-index="<?php echo $no_of_option; ?>">Add More Row</a>
                              </div>


                              <div class="col-md-12">
                                 <div class="form-group <?php echo form_error('pr_notes') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Project Notes', 'pr_notes'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('pr_notes') ? $this->input->post('pr_notes') : (isset($check_list_data->pr_notes) ? $check_list_data->pr_notes :  '' );
                                    ?>

                                    <textarea name="pr_notes" rows="2"  id="pr_notes" class="form-control"><?php echo $populateData;?></textarea>
                                    <span class="small form-error"> <?php echo strip_tags(form_error('pr_notes')); ?> </span>
                                 </div>
                              </div>


                              <div class="clearfix"></div>


                              <div class="col-md-6">
                                 <div class="form-group <?php echo form_error('project_manager') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Project Manager', 'project_manager'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('project_manager') ? $this->input->post('project_manager') : (isset($check_list_data->project_manager) ? $check_list_data->project_manager :  '' );
                                    ?>
                                    <input type="text" name="project_manager" value="<?php echo $populateData; ?>"  id="project_manager" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('project_manager')); ?> </span>
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-group <?php echo form_error('sign_client_name') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Client', 'sign_client_name'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('sign_client_name') ? $this->input->post('sign_client_name') : (isset($check_list_data->sign_client_name) ? $check_list_data->sign_client_name :  '' );
                                    ?>
                                    <input type="text" name="sign_client_name" value="<?php echo $populateData; ?>"  id="sign_client_name" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('sign_client_name')); ?> </span>
                                 </div>
                              </div>


                              <div class="clearfix"></div>

                              <!--<?php /**
                              <div class="col-md-6">
                                 <div class="form-group <?php echo form_error('manager_signature') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Signature', 'manager_signature'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('manager_signature') ? $this->input->post('manager_signature') : (isset($check_list_data->manager_signature) ? $check_list_data->manager_signature :  '' );
                                    ?>
                                    <input type="text" name="manager_signature" value="<?php echo $populateData; ?>"  id="manager_signature" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('manager_signature')); ?> </span>
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-group <?php echo form_error('client_signature') ? ' has-error' : ''; ?>">
                                    <?php echo  form_label('Signature', 'client_signature'); ?> 
                                    <span class="required text-danger">*</span>
                                    <?php 
                                    $populateData = $this->input->post('client_signature') ? $this->input->post('client_signature') : (isset($check_list_data->client_signature) ? $check_list_data->client_signature :  '' );
                                    ?>
                                    <input type="text" name="client_signature" value="<?php echo $populateData; ?>"  id="client_signature" class="form-control" value="<?php echo $populateData;?>">

                                    <span class="small form-error"> <?php echo strip_tags(form_error('client_signature')); ?> </span>
                                 </div>
                              </div> */?> -->


                              <div class="clearfix"></div>


                              <hr>
                              <div class="clearfix"></div>

                              <div class="col-md-8"> </div>

                              <div class="col-md-4 text-left">
                                 <?php $saveUpdate = isset($check_list_id) ? 'Update Information' : 'Save Information'; ?>
                                 <input type="submit"  value="<?php echo ucfirst($saveUpdate);?>" class="btn btn-primary px-4">
                                 <a href="<?php echo base_url('admin/tasks/hoa_details_for_task');?>" class="btn btn-danger px-5"><?php echo 'Cancel'; ?></a>
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


   <section class=" d-none">
      <table class="table table-bordered table-striped">
         <tbody class="copy_ticket_section">
            <tr class="copied_ticket_section">

               <td></td>

               <td class="open_close">
                  <label class="radio-inline"><input type="radio" value='YES' class="yes" name="open_close[1]" checked>Yes</label>
                  <label class="radio-inline"><input type="radio" value='NO' class="no" name="open_close[1]">No</label>
               </td>
               <td class="lock">
                  <label class="radio-inline"><input type="radio" value='YES' class="yes" name="lock[1]" checked>Yes</label>
                  <label class="radio-inline"><input type="radio" value='NO' class="no" name="lock[1]">No</label>
               </td>
               <td class="screws">
                  <label class="radio-inline"><input type="radio" value='YES' class="yes" name="screws[1]" checked>Yes</label>
                  <label class="radio-inline"><input type="radio" value='NO' class="no" name="screws[1]">No</label>  
               </td>
               <td class="int_caulking">
                  <label class="radio-inline"><input type="radio" value='YES' class="yes" name="int_caulking[1]" checked>Yes</label>
                  <label class="radio-inline"><input type="radio" value='NO' class="no" name="int_caulking[1]">No</label>
               </td>

               <td class="stickers">
                  <label class="radio-inline"><input type="radio" value='YES' class="yes" name="stickers[1]" checked>Yes</label>
                  <label class="radio-inline"><input type="radio" value='NO' class="no" name="stickers[1]">No</label>
               </td>

               <td class="ext_caulking">
                  <label class="radio-inline"><input type="radio" value='YES' class="yes" name="ext_caulking[1]" checked>Yes</label>
                  <label class="radio-inline"><input type="radio" value='NO' class="no" name="ext_caulking[1]">No</label>
               </td>
               <td class="screens">
                  <label class="radio-inline"><input type="radio" value='YES' class="yes" name="screens[1]" checked>Yes</label>
                  <label class="radio-inline"><input type="radio" value='NO' class="no"  name="screens[1]">No</label>
                  <label class="radio-inline"><input type="radio" value='NA' class="na"name="screens[1]">N/A</label>
               </td>
               <td class="covers">
                  <label class="radio-inline"><input type="radio" value='YES' class="yes" name="covers[1]" checked>Yes</label>
                  <label class="radio-inline"><input type="radio" value='NO' class="no" name="covers[1]">No</label>
                  <label class="radio-inline"><input type="radio" value='NA' class="na" name="covers[1]">N/A</label>
               </td>

               <td></td>
               <td>
                  <a href="javascript:void(0)" class="btn btn-danger  btn-block remove_block_btn"><i class="fa fa-times-circle mr-2"></i>Remove</a> 
               </td>

            </tr>         
         </tbody>
      </table>

   </section> 


<?php init_tail(); ?>
<script>


$(document).ready(function() 
{

  $(".add-more").click(function()
  { 
    var addmore_index = parseFloat($(this).attr('data-index'));
    var add_next = addmore_index + 1;

    $(this).attr('data-index',add_next);

    $(".copy_ticket_section .open_close .yes").attr('name','open_close['+ add_next +']');
    $(".copy_ticket_section .open_close .no").attr('name','open_close['+ add_next +']');

    $(".copy_ticket_section .lock .yes").attr('name','lock['+ add_next +']');
    $(".copy_ticket_section .lock .no").attr('name','lock['+ add_next +']');

    $(".copy_ticket_section .screws .yes").attr('name','screws['+ add_next +']');
    $(".copy_ticket_section .screws .no").attr('name','screws['+ add_next +']');

    $(".copy_ticket_section .int_caulking .yes").attr('name','int_caulking['+ add_next +']');
    $(".copy_ticket_section .int_caulking .no").attr('name','int_caulking['+ add_next +']');
    
    $(".copy_ticket_section .stickers .yes").attr('name','stickers['+ add_next +']');
    $(".copy_ticket_section .stickers .no").attr('name','stickers['+ add_next +']');
    
    $(".copy_ticket_section .ext_caulking .yes").attr('name','ext_caulking['+ add_next +']');
    $(".copy_ticket_section .ext_caulking .no").attr('name','ext_caulking['+ add_next +']');
    
    $(".copy_ticket_section .screens .yes").attr('name','screens['+ add_next +']');
    $(".copy_ticket_section .screens .no").attr('name','screens['+ add_next +']');
    $(".copy_ticket_section .screens .na").attr('name','screens['+ add_next +']');

    $(".copy_ticket_section .covers .yes").attr('name','covers['+ add_next +']');
    $(".copy_ticket_section .covers .no").attr('name','covers['+ add_next +']');
    $(".copy_ticket_section .covers .na").attr('name','covers['+ add_next +']');

    var html = '';
    html = $(".copy_ticket_section").html();
    $(".after_ticket_section").append(html);
  });

  $(document).on("click",".remove_block_btn",function(){ 
      $(this).parents(".copied_ticket_section").remove();
  });



      $(document).on("click",".remove_block_btn_update",function()
      { 
        var parent_div = $(this).parents(".copied_ticket_section")

         parent_div.remove();    
      });
});


</script>
</body>
</html>
