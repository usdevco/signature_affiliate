<?php init_head();
?>
<div id="wrapper">
    <div class="content">
        <div class="row">

            <?php echo form_hidden('project_id',$project->id) ?>
            <div class="panel_s" id="myWizard">
                <div class="panel-body">

                    <div class="progresss">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="6" style="width: 16.6667%;">Step 1 of 6
                        </div>
                    </div>
                    <hr>


                    <div class="navbar">
                        <div class="navbar-inner">
                            <ul class="nav nav-pills nav-wizard" id="myTab">
                                <li class="active">
                                    <a class="hidden-xs" href="#welcome" data-toggle="tab" data-step="1" aria-expanded="true">1. Welcome</a>
                                    <a class="visible-xs" href="#welcome" data-toggle="tab" data-step="1" aria-expanded="true">1.</a>
                                    <div class="nav-arrow"></div>
                                </li>
                                <li class="">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#permit" data-toggle="tab" data-step="2">2. Permit</a>
                                    <a class="visible-xs" href="#permit" data-toggle="tab" data-step="2">2.</a>
                                    <div class="nav-arrow"></div>
                                </li>
                                <li class="">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#order_processing" data-toggle="tab" data-step="3">3. Order Processing</a>
                                    <a class="visible-xs" href="#order_processing" data-toggle="tab" data-step="3">3.</a>
                                    <div class="nav-arrow"></div>
                                </li>
                                <li class="">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#city_approved" data-toggle="tab" data-step="4">4. City Approved</a>
                                    <a class="visible-xs" href="#city_approved" data-toggle="tab" data-step="4">4.</a>
                                    <div class="nav-arrow"></div>
                                </li>
                                <li class="">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#order_arrived" data-toggle="tab" data-step="5">5. Order Arrived</a>
                                    <a class="visible-xs" href="#order_arrived" data-toggle="tab" data-step="5">5.</a>
                                    <div class="nav-arrow"></div>
                                </li>
                                <li class="">
                                    <div class="nav-wedge"></div>
                                    <a class="hidden-xs" href="#order_completed" data-toggle="tab" data-step="6">6. Order Completed</a>
                                    <a class="visible-xs" href="#order_completed" data-toggle="tab" data-step="6">6.</a>
                                    
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php
                    $progress_step = array();
                    $progress_step['progress_step'] = $welcome;
                    $progress_step['progress_step_name'] = '1. Welcome: Task';
                    ?>
                    <div class="tab-content">

                        <div class="tab-pane fade active in" id="welcome">
                            <?php $this->load->view('admin/projects/task_progress_table',$progress_step); ?>
                        </div>

                        <div class="tab-pane fade" id="permit">

                            <?php
                                $progress_step = array();
                                $progress_step['progress_step'] = $permit;
                                $progress_step['progress_step_name'] = '2. Permit: Task';
                                $this->load->view('admin/projects/task_progress_table',$progress_step);
                            ?>

                        </div>

                        <div class="tab-pane fade" id="order_processing">

                            <?php
                                $progress_step = array();
                                $progress_step['progress_step'] = $order_processing;
                                $progress_step['progress_step_name'] = '3. Order Processing: Task';
                                $this->load->view('admin/projects/task_progress_table',$progress_step);
                            ?>

                        </div>

                        <div class="tab-pane fade" id="city_approved">

                            <?php
                                $progress_step = array();
                                $progress_step['progress_step'] = $city_approved;
                                $progress_step['progress_step_name'] = '4. City Approved: Task';
                                $this->load->view('admin/projects/task_progress_table',$progress_step);
                            ?>

                        </div>

                        <div class="tab-pane fade" id="order_arrived">

                            <?php
                                $progress_step = array();
                                $progress_step['progress_step'] = $order_arrived;
                                $progress_step['progress_step_name'] = '5. Order Arrived: Task';
                                $this->load->view('admin/projects/task_progress_table',$progress_step);
                            ?>

                        </div>

                        <div class="tab-pane fade" id="order_completed">


                            <?php
                                $progress_step = array();
                                $progress_step['progress_step'] = $promotions;
                                $progress_step['progress_step_name'] = '6. Order Completed: Task';
                                $this->load->view('admin/projects/task_progress_table',$progress_step);
                            ?>

                        </div>

                    </div>
                </div>    
            </div>
            <div id="push"></div>
        </div>    
    </div>          
</div>



<div class="modal  animated fadeIn modal_task_progress" id="modal_task_progress" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="POST" action="<?php echo admin_url('tasks/task_progress_action/'.$project_id); ?>" id="task_progress_form"  enctype="multipart/form-data">
            <input type="hidden" name="project_id" value="<?php echo $project_id ?>">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Action On Task Progress</h4>
          </div>
          <div class="modal-body">
                <div class="row"  id="modal_progress_form">

                </div>
            
          </div>
          <div class="modal-footer">
             <button type="submit" name="save" value="Save"  class="btn btn-info" id="task_progress_submit">Save </button>
             <button type="submit" name="save_and_complete" value="Save And Complete"  class="btn btn-success" id="task_submit_complete">Save And Complete </button>
            <!-- <a href="javascript:void(0)" id="task_progress_submit"  class="btn btn-info">Submit</a> -->
          </div>
        </form>
    </div>
  </div>
</div>


<div class="modal  animated fadeIn modal_task_progress" id="modal_view_task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modal_progress_data_title"></h4>
          </div>
          <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" id="modal_progress_data"></div>
                </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
       
    </div>
  </div>
</div>



<?php init_tail(); ?>
<?php  echo app_stylesheet('assets/css','progress_bar.css');
    $discussion_lang = get_project_discussions_language_array();
    echo app_script('assets/js','progress_bar.js');
 ?>
<!-- <?php echo app_script('assets/js','projects.js'); ?> -->

<script type="text/javascript">

$(document).ready(function()
{

   $(document).on('change','.hoa',function(e)
   {

    var hoa_value = $(this).val();

    if (hoa_value=='YES')
    { 
        $('.hoa_task_div').slideDown();
    }
    else
    {
        $('.hoa_task_div').slideUp();
    }

   });

});



    // $("#task_progress_formmm").on('submit',function(e)
    // {
    //     if(confirm("are You Sure"))
    //     {
    //        return true;
    //     }
    //     else
    //     {
    //         return false;
    //     }
    // });

    $(".task_progress_action").on('click',function(e){

        var task_id = $(this).data('task_id');
        var project_id = $(this).data('project_id');

        if(task_id)
        {
            $.ajax({
                type: 'POST',
                url: admin_url+'tasks/update_task_progress_status/'+task_id,
                data: {
                        task_id: task_id,
                        project_id: project_id,
                        },

                    success: function (response)
                    {
                        if(response)
                        {
                            response = JSON.parse(response);
                            if(response.status != 'error')
                            {
                                $('#modal_progress_form').html(response.data);
                                $('#modal_task_progress').modal('show');
                            }
                            else
                            {   
                                alert(response.msg);
                                // location.reload();
                            }

                            
                        }
                        else
                        {
                            alert('Server Response Error');
                        }

                    },
                    error: function(e) {
                        console.log(e)
                    }
            });
        }

    });


    $(".mark_as_complete_task_action").on('click',function(e){

        var task_id = $(this).data('task_id');
        var project_id = $(this).data('project_id');

        if(task_id)
        {
            $.ajax({
                type: 'POST',
                url: admin_url+'tasks/mark_as_complete_task_action/'+project_id,

                data: {
                        task_id: task_id,
                        project_id: project_id,
                        },
                beforeSend: function() 
                {
                  $(".loaderrr").show();
                },

                success: function (response)
                {
                    if(response)
                    {
                        $(".loaderrr").hide();
                        response = JSON.parse(response);
                        if(response.status != 'error')
                        {
                            location.reload();
                        }
                        else
                        {   
                            // alert(response.msg);
                            location.reload();
                        }

                        
                    }
                    else
                    {
                        alert('Server Response Error');
                    }

                },
                error: function(e) {
                    console.log(e)
                }
            });
        }

    });


    $(".view_task_progress_action").on('click',function(e){

        var task_id = $(this).data('task_id');
        var project_id = $(this).data('project_id');

        if(task_id)
        {
            $.ajax({
                type: 'POST',
                url: admin_url+'tasks/view_custom_task_value/'+project_id,

                data: {
                        task_id: task_id,
                        project_id: project_id,
                        },
                beforeSend: function() 
                {
                  $(".loaderrr").show();
                },

                success: function (response)
                {
                    if(response)
                    {
                        $(".loaderrr").hide();
                        response = JSON.parse(response);
                        if(response.status != 'error')
                        {
                            if(response.html !='')
                            {
                                $('#modal_progress_data_title').html(response.title);
                                $('#modal_progress_data').html(response.html);
                                $('#modal_view_task').modal('show');
                            }
                            else
                            {
                                alert(response.msg);
                            }
                        }
                        else
                        {   
                            alert(response.msg);
                        }

                    }
                    else
                    {
                        alert('Server Response Error');
                    }

                },
                error: function(e) {
                    console.log(e)
                }
            });
        }

    });


$('#myTab a').click(function(e) {
  e.preventDefault();
  $(this).tab('show');
});

// store the currently selected tab in the hash value
$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
  var id = $(e.target).attr("href").substr(1);
  window.location.hash = id;
});

// on load of the page: switch to the currently selected tab
var hash = window.location.hash;
$('#myTab a[href="' + hash + '"]').tab('show');


</script>


