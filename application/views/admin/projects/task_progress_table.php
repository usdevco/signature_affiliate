<h3> <?php echo $progress_step_name; ?></h3>
<div class="well">
    <div class="panel-body">
        <table id="table" class="display table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>Task Time</th>
                    <th>Assigned To</th>
                    <th>Action On Task</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                 $staff_id = get_staff_user_id();
                 $role_id = staff_role($staff_id);

                foreach ($progress_step as $key => $task_progress_data) 
                { ?>
                    <tr>
                        <td><?php echo $task_progress_data->name;?></td>
                        <td><?php echo date('d/m/Y',strtotime($task_progress_data->startdate));?></td>
                        <?php $duedate = $task_progress_data->duedate ? date('d/m/Y',strtotime($task_progress_data->duedate)) : "";?>
                            <td>
                            <?php
                            if($task_progress_data->is_complete == 1)
                            {
                                $datefinished = new DateTime($task_progress_data->datefinished);
                                $startdate = new DateTime($task_progress_data->dateadded);

                                $interval = $datefinished->diff($startdate);

                                $year =  $interval->y > 0 ? $interval->y * 12 : 0;

                                $month =  $interval->m > 0 ?  $interval->m + $year : 0;
                                $day = $interval->d; 
                                $hour = $interval->h; 
                                $minute = $interval->i; 

                                echo "<span class='text-success'>";
                                echo $month > 0 ? $month. ' Months ' : NULL;
                                echo $day > 0 ? $day. ' Day ' : NULL;
                                // echo $hour > 0 || $day > 0  ? $hour. ' Hour ' : NULL;
                                echo $hour > 0  ? $hour. ' Hour ' : NULL;
                                echo $minute > 0 ? $minute. ' Minute ' : NULL;
                                echo "</span>"; 

                                // $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
                                // echo "<span class='text-success'>". $elapsed."</span>";                         
                            }
                            else
                            {
                                $datefinished = date('Y-m-d H:i:s');
                                $datefinished = new DateTime($datefinished);
                                $startdate = $task_progress_data->startdate;
                                $startdate = new DateTime($startdate);
                                
                                $interval = $datefinished->diff($startdate);
                                $year =  $interval->y > 0 ? $interval->y * 12 : 0;

                                $month =  $interval->m > 0 ?  $interval->m + $year : 0;
                                $day = $interval->d; 
                                $hour = $interval->h; 
                                $minute = $interval->i; 

                                echo "<span class='text-danger'>";
                                echo $month > 0 ? $month. ' Months ' : NULL;
                                echo $day > 0 ? $day. ' Day ' : NULL;
                                echo $minute > 0 ? $minute. ' Minute ' : NULL;
                                echo "</span>";                   
                                // $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
                            }
                                     
                            ?>
                                
                            </td>
                        <td>
                            <?php $staff = get_user_assignee($task_progress_data->id);
                                foreach ($staff as $staff_key => $staff_value) {
                                $staff_image = $staff_value->profile_image ? base_url('assets/images/'.$staff_value->profile_image) : base_url('assets/images/user-placeholder.jpg');
                                $staff_name = $staff_value->firstname . " " .$staff_value->lastname;    
                            ?>

                                 <a href="<?php base_url("admin/profile/$staff_value->staffid") ?>" class="btn-link"><?php echo $staff_name.', ';  ?> </a>
                            <?php 
                                }
                            ?>
                                
                        </td>
                        <td>
                            <?php
                            $disabled =  ($task_progress_data->role_id == $role_id OR is_admin($staff_id) == 1) ? '' : 'disabled';
                            // $disabled = '';

                            if($task_progress_data->is_complete == 1 && $task_progress_data->task_status == 5)
                            {                               
                                    // $cl_view_task_progress_action = $disabled ? 'other_user' : ' view_task_progress_action';
                                    $cl_view_task_progress_action = $disabled ? 'view_task_progress_action' : ' view_task_progress_action';
                                    $cl_task_progress_field_action = $disabled ? 'other_user' : ' task_progress_field_action'; 
                                    ?>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <a href="javascript:void(0)" <?php //echo $disabled; ?> class="btn btn-block btn-info <?php echo $cl_task_progress_field_action; ?>" data-task_step_slug="<?php echo $task_step_slug; ?>" data-task_id="<?php echo $task_progress_data->id; ?>" data-project_id="<?php echo $project_id; ?>" data-task_action='update'>Update Details</a>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <a href="javascript:void(0)" <?php //echo $disabled; ?> class="btn btn-block btn-success <?php echo $cl_view_task_progress_action; ?>" data-task_step_slug="<?php echo $task_step_slug; ?>" data-task_id="<?php echo $task_progress_data->id; ?>" data-project_id="<?php echo $project_id; ?>">View Details</a>
                                        </div>
                                    </div>
                                     

                                <?php
                            }
                            else if($task_progress_data->is_complete != 1 && $task_progress_data->task_status == 5)
                            { 
                                    $cl_mark_as_complete_task_action = $disabled ? 'other_user' : ' mark_as_complete_task_action';
                                    ?>

                                    <a href="javascript:void(0)" <?php echo $disabled; ?> class="btn btn-block  btn-default <?php echo $cl_mark_as_complete_task_action; ?>" data-task_id="<?php echo $task_progress_data->id; ?>" data-task_step_slug="<?php echo $task_step_slug; ?>"  data-project_id="<?php echo $project_id; ?>">Mark As Complete</a>
                               
                                <?php
                            }
                            else
                            {
                                if($task_progress_data->input_type == 'none' OR $task_progress_data->input_type =='')
                                { 

                                    $cl_mark_as_complete_task_action = $disabled ? 'other_user' : ' mark_as_complete_task_action';
                                    ?>

                                    <a href="javascript:void(0)" <?php echo $disabled; ?> class="btn btn-block  btn-default <?php echo $cl_mark_as_complete_task_action; ?>" data-task_step_slug="<?php echo $task_step_slug; ?>" data-task_id="<?php echo $task_progress_data->id; ?>"  data-project_id="<?php echo $project_id; ?>">Mark As Complete</a>


                                    <?php
                                }
                                else
                                {

                                    $cl_task_progress_field_action = $disabled ? 'other_user' : ' task_progress_field_action';  ?>
                                   
                                   <a href="javascript:void(0)" <?php echo $disabled; ?> class="btn btn-block btn-warning <?php echo $cl_task_progress_field_action; ?>" data-task_step_slug="<?php echo $task_step_slug; ?>" data-task_id="<?php echo $task_progress_data->id; ?>" data-project_id="<?php echo $project_id; ?>" data-task_action='save'>Take Action</a>

                                <?php
                                }
                            
                            }
                                ?>
                           
                        </td>
                    </tr>

                    <?php 
                } ?>

            </tbody>
        </table>

    </div>    
</div>