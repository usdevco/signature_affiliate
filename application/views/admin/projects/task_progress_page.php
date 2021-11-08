<?php init_head();
?>
<style type="text/css">
    body .border-0{ border: 0px solid #fff !important; }
    a.btn.btn-block.btn-info.task_progress_field_action { display: inline; }
    a.btn.btn-block.btn-success.view_task_progress_action { display: inline; }
    .main_box_div { height: 400px; overflow-y: scroll; }
</style>
<div id="wrapper">
    <div class="content">
            <div class="row">

                <?php echo form_hidden('project_id',$project->id) ?>



                <div class="col-md-12 mtop20 task_progress_client">
                    <div class="alert alert-warning project-permissions-warning mbot15">
                        <h4 class="mbot15 text-success">Customer Information</h4 >
                        <hr class="m-0">
                        <div class="row">
                            <div class="col-md-3">
                                <h5 class="my-2">BASIC INFO</h5> 
                                <hr class="m-0">
                                <p >Name : <?php echo $client_db_data->company; ?></p> 
                                <p >Email : <?php echo $client_db_data->email; ?></p>
                                <p >Phone Number : <?php echo $client_db_data->phonenumber; ?></p>
                            </div>
                            <div class="col-md-3">  
                                <h5 class="my-2"> ADDRESS</h5> 
                                <hr class="m-0">
                                <p>Address : <?php echo $client_db_data->address; ?></p>
                                <p>City : <?php echo $client_db_data->city; ?></p>
                                <p>State : <?php echo $client_db_data->state; ?></p>
                                <p>Zip Code : <?php echo $client_db_data->zip; ?></p>
                            </div>
                            <div class="col-md-3"> 
                                <h5 class="my-2">BILLING ADDRESS</h5> 
                                <hr class="m-0">
                                <p>Address : <?php echo $client_db_data->billing_street; ?></p>
                                <p>City : <?php echo $client_db_data->billing_city; ?></p>
                                <p>State : <?php echo $client_db_data->billing_state; ?></p>
                                <p>Zip Code : <?php echo $client_db_data->billing_zip; ?></p>
                            </div>
                            <div class="col-md-3"> 
                                <h5 class="my-2">SHIPPING ADDRESS</h5> 
                                <hr class="m-0">
                                <p>Address : <?php echo $client_db_data->shipping_street; ?></p>
                                <p>City : <?php echo $client_db_data->shipping_city; ?></p>
                                <p>State : <?php echo $client_db_data->shipping_state; ?></p>
                                <p>Zip Code : <?php echo $client_db_data->shipping_zip; ?></p>
                            </div>
                        </div>
                        
                    </div>
                </div>



                <div class="col-md-12 mtop20">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel_s p-0 border-0 mb-0">
                                <div class="panel-body p-1 border-0">

                                    <?php
                                        $progress_step = array();
                                        $progress_step['progress_step'] = $welcome;
                                        $progress_step['task_step_slug'] = 'welcome';
                                        $progress_step['progress_step_name'] = $progress_step['progress_step_name'] = '<i class="fa fa-th mright5" aria-hidden="true"></i> 1. Sales Rep '.' : Task';
                                        $this->load->view('admin/projects/task_progress_table_new',$progress_step); 
                                    ?>
                                </div>
                            </div>

                        </div>
                        
                        <div class="col-md-6">
                            <div class="panel_s p-0 border-0 mb-0">
                                <div class="panel-body p-1 border-0">

                                    <?php
                                        $progress_step = array();
                                        $progress_step['progress_step'] = $permit;
                                        $progress_step['task_step_slug'] = 'permit';
                                        $progress_step['progress_step_name'] = $progress_step['progress_step_name'] = '<i class="fa fa-thumbs-o-up mright5" aria-hidden="true"></i> 2. Sales Support'.' : Task';
                                        $this->load->view('admin/projects/task_progress_table_new',$progress_step); 
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>



                <div class="col-md-12 mtop20">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel_s p-0 border-0 mb-0">
                                <div class="panel-body p-1 border-0">

                                    <?php
                                        $progress_step = array();
                                        $progress_step['progress_step'] = $order_processing;
                                        $progress_step['task_step_slug'] = 'order_processing';
                                        $progress_step['progress_step_name'] = '<i class="fa fa-clock-o mright5" aria-hidden="true"></i>3. Accounting'.' : Task';
                                        // $progress_step['progress_step_name'] = $task_step_name.' : Task';
                                        $this->load->view('admin/projects/task_progress_table_new',$progress_step); 
                                    ?>
                                </div>
                            </div>

                        </div>
                        
                        <div class="col-md-6">
                            <div class="panel_s p-0 border-0 mb-0">
                                <div class="panel-body p-1 border-0">

                                    <?php
                                        $progress_step = array();
                                        $progress_step['progress_step'] = $city_approved;
                                        $progress_step['task_step_slug'] = 'city_approved';
                                        $progress_step['progress_step_name'] = '<i class="fa fa-smile-o mright5" aria-hidden="true"></i>4. Permitting'.' : Task';
                                        $this->load->view('admin/projects/task_progress_table_new',$progress_step); 
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>



                <div class="col-md-12 mtop20">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel_s p-0 border-0 mb-0">
                                <div class="panel-body p-1 border-0">

                                    <?php
                                        $progress_step = array();
                                        $progress_step['progress_step'] = $order_arrived;
                                        $progress_step['task_step_slug'] = 'order_arrived';
                                        $progress_step['progress_step_name'] = '<i class="fa fa-cart-plus mright5" aria-hidden="true"></i>5. Project Manager'.' : Task';
                                        $this->load->view('admin/projects/task_progress_table_new',$progress_step); 
                                    ?>
                                </div>
                            </div>

                        </div>
                        
                        <div class="col-md-6">
                           <div class="panel_s p-0 border-0 mb-0">
                                <div class="panel-body p-1 border-0">

                                    <?php
                                        $progress_step = array();
                                        $progress_step['progress_step'] = $order_completed;
                                        $progress_step['task_step_slug'] = 'order_completed';
                                        $progress_step['progress_step_name'] = '<i class="fa fa-check-circle-o mright5" aria-hidden="true"></i>6. Warehouse Manager'.' : Task';
                                        $this->load->view('admin/projects/task_progress_table_new',$progress_step); 
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>


            </div>    
    </div>          
</div>



<div class="modal  animated fadeIn modal_task_progress" id="modal_task_progress" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="modal_progress_form">
       
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
<!-- <?php// echo app_script('assets/js','projects.js'); ?> -->

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



    // $(document).on('submit',"#task_progress_formmm",function(e)
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

    $(".task_progress_field_action").on('click',function(e){

        var task_id = $(this).data('task_id');
        var project_id = $(this).data('project_id');
        var task_step_slug = $(this).data('task_step_slug');
        var task_action = $(this).data('task_action');

        if(task_action && task_action=='update')
        {
            if(!confirm("If You Update This Task When All Dependent Tasks Will Delete"))
            {
                return false;
            }
            $('#task_progress_submit').val('Update');
            $("#task_progress_submit").html('Update');
            $('#task_submit_complete').val('Update And Complete');
            $("#task_submit_complete").html('Update And Complete');
        }
        else
        {
            $('#task_progress_submit').val('Save');
            $("#task_progress_submit").html('Save');
            $('#task_submit_complete').val('Save And Complete');
            $("#task_submit_complete").html('Save And Complete');
        }
        if(task_id)
        {
            $.ajax({
                type: 'POST',
                url: admin_url+'tasks/load_task_progress_fields/'+task_id+'/'+task_step_slug,
                data: {
                        task_id: task_id,
                        project_id: project_id,
                        task_action: task_action,
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


    $(".mark_as_complete_task_action").on('click',function(e){

        var task_id = $(this).data('task_id');
        var project_id = $(this).data('project_id');
        var task_step_slug = $(this).data('task_step_slug');

        if(task_id)
        {
            $.ajax({
                type: 'POST',
                url: admin_url+'tasks/mark_as_complete_task_action/'+project_id+'/'+task_step_slug,

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


    $(document).on('click','.mark_as_incomplete_task_action',function(e){

        var task_id = $(this).data('task_id');
        var project_id = $(this).data('project_id');
        var task_step_slug = $(this).data('task_step_slug');

        if(task_id)
        {
            $.ajax({
                type: 'POST',
                url: admin_url+'tasks/mark_as_incomplete_task_action/'+project_id+'/'+task_step_slug,

                data:   {
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


